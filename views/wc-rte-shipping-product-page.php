<div id="rte-shipping-calc">
        <div id="rte-chipping-calc-form">
            <span id="rte-label"><?php echo __( 'Simulate your shipping: ', 'woocommerce-rte-rodonaves-shipping' ) ?></span><br>
            <input id="user-postcode" type="hidden" value="<?php echo func_get_last_order_id() ?>">
            <input id="rte-postcode" type="text" maxlength="9" placeholder="00000-000">
            <button id="rte-shipping-request"><?php echo __( 'Calculate', 'woocommerce-rte-rodonaves-shipping' ) ?></button>
        </div>            
    <div id="rte-shipping-result"></div>
</div>