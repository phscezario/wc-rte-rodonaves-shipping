<?php

if ( ! is_null( $product ) ) {
    ?>

    <div id="rte-meta_<?php echo $product->get_id()?>">
        <table class="rte-meta-table">
            <tbody>
                <tr>
                    <th><?php echo __( 'Weight:', 'woocommerce-rte-rodonaves-shipping' ) ?></th>
                    <td><?php echo $product->get_weight() . get_option('woocommerce_weight_unit') ?> </td>
                </tr>
                <tr>
                    <th><?php echo __( 'Length:', 'woocommerce-rte-rodonaves-shipping' ) ?></th>
                    <td><?php echo $product->get_length() . get_option('woocommerce_dimension_unit') ?></td>
                </tr>
                <tr>
                    <th><?php echo __( 'Width:', 'woocommerce-rte-rodonaves-shipping' ) ?></th>
                    <td><?php echo $product->get_width() . get_option('woocommerce_dimension_unit') ?></td>
                </tr>
                <tr>
                    <th><?php echo __( 'Height:', 'woocommerce-rte-rodonaves-shipping' ) ?></th>
                    <td><?php echo $product->get_height() . get_option('woocommerce_dimension_unit') ?></td>
                </tr>
            </tbody>
        </table>
</div>

    <?php

} else {
    ?>

    <div id="rte-meta_">
        <table class="rte-meta-table">
            <tbody>
                <tr>
                    <th><?php echo __( 'Total Weight:', 'woocommerce-rte-rodonaves-shipping' ) ?></th>
                    <td><?php echo $total_weight ?></td>
                </tr>
                <tr>
                    <th><?php echo __( 'Delivery Time:', 'woocommerce-rte-rodonaves-shipping' ) ?></th>
                    <td><?php echo $delivery_time ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <?php
}

