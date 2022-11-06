<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'woocommerce_checkout_create_order', 'add_order_meta', 10, 2 );
add_action( 'woocommerce_after_order_itemmeta', 'show_admin_shipping_infos', 10, 3 );
add_action( 'woocommerce_after_shipping_rate', 'show_shipping_time_on_cart', 10, 2 );
add_action( 'woocommerce_order_details_after_customer_details', 'show_client_additional_infos' );
add_action( 'wp_ajax_get_shipping', 'get_shipping_callback' );
add_action( 'wp_ajax_nopriv_get_shipping', 'get_shipping_callback' );
add_action( 'woocommerce_after_add_to_cart_form', 'show_rte_shipping_in_product_page' );
add_shortcode( 'rte_shipping_in_product_page', 'add_rte_shipping_shipping_simulator' );



function add_order_meta( $order, $data ) {
    $shipping_method = $order->get_shipping_method();

    if ( $shipping_method === 'RTE Rodonaves Shipping' ) {
        $have_meta      = WC()->session->get( 'rte_extra_meta' );
        $delivery_time  = WC()->session->get( 'delivery_time' );
        $weight         = WC()->cart->get_cart_contents_weight();
    
        $order->update_meta_data( '_rte_extra_meta', $have_meta );
        $order->update_meta_data( '_cart_weight', $weight );
        $order->update_meta_data( '_delivery_time', $delivery_time );
    }
}

function show_shipping_time_on_cart( $method, $index ) {
    $delivery_time = WC()->session->get( 'delivery_time' );
    echo __( '<p id="show-estimated-shipping-time">Estimated time: <strong>', 'woocommerce-rte-rodonaves-shipping' ) . $delivery_time . __( ' working day(s)</strong>.</p>', 'woocommerce-rte-rodonaves-shipping');
}

function show_admin_shipping_infos( $item_id, $item, $product ) {
    $order              = wc_get_order( $item['order_id'] );
    $shipping_method    = $order->get_shipping_method();

    if ( $shipping_method === 'RTE Rodonaves Shipping' ) {
        $extra_meta         = $order->get_meta('_rte_extra_meta');
        $total_weight       = $order->get_meta('_cart_weight');
        $delivery_time      = $order->get_meta('_delivery_time');

        if ( is_null( $extra_meta ) || $extra_meta != true ) {
            $total_weight       = 'No information.';
            $delivery_time      = 'No information.';
        } else {
            $total_weight = get_post_meta( $order->get_id(), '_cart_weight', true ) . get_option('woocommerce_weight_unit');
            $delivery_time = get_post_meta( $order->get_id(), '_delivery_time', true ) . ' day(s)';
        }

        include( RTE_SHIPPING_BASE_PATH . '/views/wc-rte-shipping-extra-meta-admin.php');

    }
}

function show_client_additional_infos( $order ) {
    $shipping_method    = $order->get_shipping_method();
    $delivery_time      = $order->get_meta('_delivery_time');

    if ( $shipping_method === 'RTE Rodonaves Shipping' ) {

        include_once( RTE_SHIPPING_BASE_PATH . '/views/wc-rte-shipping-user-order-infos.php');
    }
}

function add_rte_shipping_shipping_simulator() {
    global $product;

    $should_display_rte = $product instanceof \WC_Product && $product->is_virtual() === false;

    if ( $should_display_rte ) {
        if ( $product->is_type( 'variable' ) ) {
            wp_localize_script('rte-shipping-scripts', 'rteShippingProduct', array(
                'variable' => true,
            ));
            $product = wc_get_product( $product->get_children()[0] );
        }
        else {
            wp_localize_script('rte-shipping-scripts', 'rteShippingProduct', array(
                'variable' => false,
            ));
        }

        wp_localize_script('rte-shipping-scripts', 'rteShippingProductData', array(
            'data' => array(
                'weight' => $product->get_weight(),
                'dimensions' => array(
                    'length'    =>  $product->get_length(),
                    'height'    =>  $product->get_height(),
                    'width'     =>  $product->get_width(),      
                ),
                'display_price' =>  $product->get_price(),
                )          
            )
        );
    }

    include_once( RTE_SHIPPING_BASE_PATH . '/views/wc-rte-shipping-product-page.php');
}

function get_shipping_callback() {
    if (isset($_POST)) {

        $shipping_method = get_current_id();

        $data = $_POST['data'];

        $response = $shipping_method->calculate_shipping( $data );

        echo json_encode( $response );
        wp_die(); 
    }
}

function func_get_last_order_id(){
    if ( is_user_logged_in() ){
        $customer_user_id = get_current_user_id(); 
        $last_order = wc_get_customer_last_order( $customer_user_id );
        if ( !empty( $last_order ) ) {
            $postcode = $last_order->get_billing_postcode();
            return $postcode;
        }
    }
    return null;
}

function show_rte_shipping_in_product_page() {
    $shipping_method = get_current_id();
    if (  $shipping_method->show_simulator == 'yes') {
        add_rte_shipping_shipping_simulator();
    }
}

function get_current_id() {
    if ( ! class_exists( 'WC_Shipping_Zones' ) ) {
        return null;
    }

    $zones = WC_Shipping_Zones::get_zones();

    if ( ! is_array( $zones ) ) {
        return null;
    }

    $shipping_methods = array_column( $zones, 'shipping_methods' );

    $flatten = array_merge( ...$shipping_methods );

    foreach ( $flatten as $key => $class ) {
        if ( $class->id == 'rte-rodonaves' ) {
            $instance_id = $class->get_instance_id();
            $class = new RteShippingMethod( $instance_id );
            return $class;
        }
    }

    return null;
}