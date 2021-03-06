<?php 
/**
 * emove "Select options" button from (variable) products on the main WooCommerce shop page.
 *
 * @param Object $product
 * @return void
 */
function remove_select_options_btn($product) {
	global $product;

	if (is_shop() && 'variable' === $product->get_type()) {
		return '';
	} else {
		sprintf('<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
			esc_url( $product->add_to_cart_url() ),
			esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
			esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
			isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
			esc_html( $product->add_to_cart_text())
		);
	}
}
add_filter('woocommerce_loop_add_to_cart_link', 'remove_select_options_btn', 10, 1);

// Remove sorting list.
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
// Remove results count.
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
// Remove product meta.
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
// Remove the product description title.
add_filter( 'woocommerce_product_description_heading', '__return_null' );

/**
 * Remove product data tabs.
 *
 * @param  array $tabs
 * @return array
 */
function woo_remove_product_tabs( $tabs ) {
	unset( $tabs['additional_information'] );   
	return $tabs; 
}
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 ); 

/**
 * Adds product title to single product page.
 *
 * @return void
 */
function add_single_product_title() {
	global $product;
    echo '<h2 class="woocommerce-product-title">'.$product->get_title().'</h2>';
}
add_filter( 'woocommerce_single_product_summary', 'add_single_product_title', 5);

/**
 * Removes menu items from my account page.
 *
 * @param  array $items
 * @return array
 */
function custom_my_account_menu_items( $items ) {
    unset($items['downloads']);
    return $items;
}
add_filter( 'woocommerce_account_menu_items', 'custom_my_account_menu_items' );

/**
 * Display custom registration fields in registration form.
 *
 * @return void
 */
function add_fields_to_register_form() {
    ?>
  
    <p class="form-row form-row-first">
    <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="woocommerce-Input input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
    </p>
  
    <p class="form-row form-row-last">
    <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="woocommerce-Input input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
    </p>
  
    <div class="clear"></div>
  
    <?php
}
add_action( 'woocommerce_register_form_start', 'add_fields_to_register_form' );

/**
 * Validate custom registration fields.
 *
 * @param [type] $errors
 * @param [type] $username
 * @param [type] $email
 * @return void
 */
function validate_custom_register_fields( $errors, $username, $email ) {
	if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
		$errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: First name is required!', 'woocommerce' ) );
    }
    if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
		$errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Last name is required!.', 'woocommerce' ) );
    }
    return $errors;
}
add_filter( 'woocommerce_registration_errors', 'validate_custom_register_fields', 10, 3 );

/**
 * Save the custom registration fields values.
 *
 * @param  int $customer_id
 * @return void
 */
function save_custom_register_fields( $customer_id ) {
	if ( isset( $_POST['billing_first_name'] ) ) {
		update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
        update_user_meta( $customer_id, 'first_name', sanitize_text_field($_POST['billing_first_name']) );
    }
    if ( isset( $_POST['billing_last_name'] ) ) {
		update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
        update_user_meta( $customer_id, 'last_name', sanitize_text_field($_POST['billing_last_name']) );
    }
}
add_action( 'woocommerce_created_customer', 'save_custom_register_fields' );

/**
 * Remove required fields
 *
 * @param  array $required_fields
 * @return void
 */
function wc_save_account_details_required_fields( $required_fields ){
	unset( $required_fields['account_display_name'] );
    return $required_fields;
}
add_filter('woocommerce_save_account_details_required_fields', 'wc_save_account_details_required_fields' );

// Removes Order Notes Title
add_filter( 'woocommerce_enable_order_notes_field', '__return_false', 9999 );

/**
 * Remove fields from checkout page.
 *
 * @param  array $fields
 * @return void
 */
function remove_checkout_fields( $fields ) {
	unset($fields['order']['order_comments']);
	return $fields;
}
add_filter( 'woocommerce_checkout_fields' , 'remove_checkout_fields' );

// Remove coupon form field.
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form');
// Display coupon form notice.
add_action( 'woocommerce_after_checkout_billing_form', 'woocommerce_checkout_coupon_form' );

// Enable the login form by default for unlogged users.
function display_checkout_login_form() {
	if( ! is_user_logged_in() ) {
		remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
        add_action( 'woocommerce_before_checkout_form', 'custom_checkout_login_form');
    }
}
add_action( 'woocommerce_before_checkout_form', 'display_checkout_login_form', 4 );

function custom_checkout_login_form() {
    wc_get_template( 'global/form-login.php', array(
        'message'  => __( 'If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing &amp; Shipping section.', 'woocommerce' ),
        'redirect' => wc_get_page_permalink( 'checkout' ),
        'hidden'   => false,
    ) );
}
function add_breadcrumb() {
	woocommerce_breadcrumb();
}
add_action('woocommerce_before_cart', 'add_breadcrumb', 1);
add_action('woocommerce_before_checkout_form','add_breadcrumb');
// Remove empty cart message.
remove_action( 'woocommerce_cart_is_empty', 'wc_empty_cart_message', 10 );

/**
 * Puts all errors into one message.
 *
 * @param string $fields
 * @param object $errors
 * @return void
 */
function compact_checkout_errors( $fields, $errors ){
	// if any validation errors
	if( !empty( $errors->get_error_codes() ) ) {
 
		// remove all of them
		foreach( $errors->get_error_codes() as $code ) {
			$errors->remove( $code );
		}
 
		// add our custom one
		$errors->add( 'validation', 'Please fill all the required fields.' );
	}
}
add_action( 'woocommerce_after_checkout_validation', 'compact_checkout_errors', 9999, 2);
