<?php
/**
 * Dokan Register Add-ons
 *
 * @author            Jason Vanstone
 * @copyright         Chamleon Creative
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Dokan Register Add-ons
 * Plugin URI:        
 * Description:       Add extra fileds to the product page
 * Version:           1.6.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Jason Vanstone
 * Author URI:        
 * Text Domain:       dkp-addons
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        
 *
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}



add_action( 'dokan_new_product_after_product_tags', 'new_product_field', 10 );
/**
 * Adding extra field on New product popup/without popup form
 */
function new_product_field(){ ?>

	<div class="dokan-form-group">

		<!-- Price Paid -->
		<input type="text" class="dokan-form-control" name="item_price_paid" placeholder="<?php esc_attr_e( 'Price paid', 'dokan-lite' ); ?>">

		<!-- Item Colour -->
		<input type="text" class="dokan-form-control" name="item_colour" placeholder="<?php esc_attr_e( 'Item Colour', 'dokan-lite' ); ?>">

		<!-- Measurements -->
		<input type="text" class="dokan-form-control" name="item_length" placeholder="<?php esc_attr_e( 'Item Length', 'dokan-lite' ); ?>">
		<input type="text" class="dokan-form-control" name="item_width" placeholder="<?php esc_attr_e( 'Item Width', 'dokan-lite' ); ?>">
		<input type="text" class="dokan-form-control" name="item_waist" placeholder="<?php esc_attr_e( 'Item Waist', 'dokan-lite' ); ?>">
		<input type="text" class="dokan-form-control" name="item_bust" placeholder="<?php esc_attr_e( 'Item Bust', 'dokan-lite' ); ?>">
		<input type="text" class="dokan-form-control" name="item_hips" placeholder="<?php esc_attr_e( 'Item Hips', 'dokan-lite' ); ?>">
		<input type="text" class="dokan-form-control" name="item_sleeves_length" placeholder="<?php esc_attr_e( 'Item Sleeves Length', 'dokan-lite' ); ?>">
		<input type="text" class="dokan-form-control" name="item_sleeves_width" placeholder="<?php esc_attr_e( 'Item Sleeves Width', 'dokan-lite' ); ?>">

		<!-- Fabric for Alteration -->
		<input type="checkbox" id="item_fabric" name="item_fabric" value="Yes">
		<label for="item_fabric"> I have fabric for Alterations</label>
	<?php
}


add_action( 'dokan_new_product_added', 'save_add_product_meta', 10, 2 );
add_action( 'dokan_product_updated', 'save_add_product_meta', 10, 2 );
/**
 * Saving product field data for edit and update
 */
function save_add_product_meta( $product_id, $postdata ) {

	if ( ! dokan_is_user_seller( get_current_user_id() ) ) {
			return;
	}

	if ( ! empty( $postdata['item_price_paid'] ) ) {
		update_post_meta( $product_id, 'item_price_paid', $postdata['item_price_paid'] );
	}

	if ( ! empty( $postdata['item_colour'] ) ) {
		update_post_meta( $product_id, 'item_colour', $postdata['item_colour'] );
	}
	if ( ! empty( $postdata['item_length'] ) ) {
		update_post_meta( $product_id, 'item_length', $postdata['item_length'] );
	}

	if ( ! empty( $postdata['item_width'] ) ) {
		update_post_meta( $product_id, 'item_width', $postdata['item_width'] );
	}

	if ( ! empty( $postdata['item_waist'] ) ) {
		update_post_meta( $product_id, 'item_waist', $postdata['item_waist'] );
	}

	if ( ! empty( $postdata['item_bust'] ) ) {
		update_post_meta( $product_id, 'item_bust', $postdata['item_bust'] );
	}
	if ( ! empty( $postdata['item_hips'] ) ) {
		update_post_meta( $product_id, 'item_hips', $postdata['item_hips'] );
	}

	if ( ! empty( $postdata['item_sleeves_length'] ) ) {
		update_post_meta( $product_id, 'item_sleeves_length', $postdata['item_sleeves_length'] );
	}
	if ( ! empty( $postdata['item_sleeves_width'] ) ) {
		update_post_meta( $product_id, 'item_sleeves_width', $postdata['item_sleeves_width'] );
	}

	if ( ! empty( $postdata['item_fabric'] ) ) {
		update_post_meta( $product_id, 'item_fabric', $postdata['item_fabric'] );
	}

}

add_action( 'dokan_product_edit_after_product_tags', 'show_on_edit_page', 99, 2 );
/**
 * Showing field data on product edit page
 */
function show_on_edit_page( $post, $post_id ) {
	$item_price_paid     = get_post_meta( $post_id, 'item_price_paid', true );
	$item_colour         = get_post_meta( $post_id, 'item_colour', true );
	$item_width          = get_post_meta( $post_id, 'item_width', true );
	$item_length         = get_post_meta( $post_id, 'item_length', true );
	$item_waist          = get_post_meta( $post_id, 'item_waist', true );
	$item_bust           = get_post_meta( $post_id, 'item_bust', true );
	$item_hips           = get_post_meta( $post_id, 'item_hips', true );
	$item_sleeves_length = get_post_meta( $post_id, 'item_sleeves_length', true );
	$item_sleeves_width  = get_post_meta( $post_id, 'item_sleeves_width', true );
	$item_fabric         = get_post_meta( $post_id, 'item_fabric', true );
	?>
	<div class="dokan-form-group">
		<!-- Price Paid -->
		<input type="hidden" name="item_price_paid" id="dokan-edit-product-id" value="<?php echo esc_attr( $post_id ); ?>"/>
		<label for="item_price_paid" class="form-label"><?php esc_html_e( 'Price paid', 'dokan-lite' ); ?></label>
		<?php dokan_post_input_box( $post_id, 'item_price_paid', array( 'placeholder' => __( 'Price paid', 'dokan-lite' ), 'value' => $item_price_paid ) ); ?>
		<div class="dokan-product-title-alert dokan-hide">
			<?php esc_html_e( 'Please enter Price paid!', 'dokan-lite' ); ?>
		</div>

		<!-- Item Colour -->
		<input type="hidden" name="item_colour" id="dokan-edit-product-id" value="<?php echo esc_attr( $post_id ); ?>"/>
		<label for="item_colour" class="form-label"><?php esc_html_e( 'Item Colour', 'dokan-lite' ); ?></label>
		<?php dokan_post_input_box( $post_id, 'item_colour', array( 'placeholder' => __( 'Item Colour', 'dokan-lite' ), 'value' => $item_colour ) ); ?>
		<div class="dokan-product-title-alert dokan-hide">
			<?php esc_html_e( 'Please enter Colour of the item!', 'dokan-lite' ); ?>
		</div>


		<!-- Measurements -->
		<input type="hidden" class="dokan-form-control" name="item_length" value="<?php echo esc_attr( $post_id ); ?>"/>
		<label for="item_length" class="form-label"><?php esc_html_e( 'Item Length', 'dokan-lite' ); ?></label>
		<?php dokan_post_input_box( $post_id, 'item_length', array( 'placeholder' => __( 'Item Length', 'dokan-lite' ), 'value' => $item_length ) ); ?>
		<div class="dokan-product-title-alert dokan-hide">
			<?php esc_html_e( 'Please enter Item Length!', 'dokan-lite' ); ?>
		</div>
		
		<input type="hidden" class="dokan-form-control" name="item_width" value="<?php echo esc_attr( $post_id ); ?>"/>
		<label for="item_width" class="form-label"><?php esc_html_e( 'Item Width', 'dokan-lite' ); ?></label>
		<?php dokan_post_input_box( $post_id, 'item_width', array( 'placeholder' => __( 'Item Width', 'dokan-lite' ), 'value' => $item_width ) ); ?>
		<div class="dokan-product-title-alert dokan-hide">
			<?php esc_html_e( 'Please enter Item Width!', 'dokan-lite' ); ?>
		</div>
		
		<input type="hidden" class="dokan-form-control" name="item_waist" value="<?php echo esc_attr( $post_id ); ?>"/>
		<label for="item_waist" class="form-label"><?php esc_html_e( 'Item Waist', 'dokan-lite' ); ?></label>
		<?php dokan_post_input_box( $post_id, 'item_waist', array( 'placeholder' => __( 'Item Waist', 'dokan-lite' ), 'value' => $item_waist ) ); ?>
		<div class="dokan-product-title-alert dokan-hide">
			<?php esc_html_e( 'Please enter Item Waist!', 'dokan-lite' ); ?>
		</div>

		<input type="hidden" class="dokan-form-control" name="item_bust" value="<?php echo esc_attr( $post_id ); ?>"/>
		<label for="item_bust" class="form-label"><?php esc_html_e( 'Item Bust', 'dokan-lite' ); ?></label>
		<?php dokan_post_input_box( $post_id, 'item_bust', array( 'placeholder' => __( 'Item Bust', 'dokan-lite' ), 'value' => $item_bust ) ); ?>
		<div class="dokan-product-title-alert dokan-hide">
			<?php esc_html_e( 'Please enter Item Bust!', 'dokan-lite' ); ?>
		</div>

		<input type="hidden" class="dokan-form-control" name="item_hips" value="<?php echo esc_attr( $post_id ); ?>"/>
		<label for="item_hips" class="form-label"><?php esc_html_e( 'Item Hips', 'dokan-lite' ); ?></label>
		<?php dokan_post_input_box( $post_id, 'item_hips', array( 'placeholder' => __( 'Item Hips', 'dokan-lite' ), 'value' => $item_hips ) ); ?>
		<div class="dokan-product-title-alert dokan-hide">
			<?php esc_html_e( 'Please enter Item Hips!', 'dokan-lite' ); ?>
		</div>
		
		<input type="hidden" class="dokan-form-control" name="item_sleeves_length" value="<?php echo esc_attr( $post_id ); ?>"/>
		<label for="item_sleeves_length" class="form-label"><?php esc_html_e( 'Item Sleeves Length', 'dokan-lite' ); ?></label>
		<?php dokan_post_input_box( $post_id, 'item_sleeves_length', array( 'placeholder' => __( 'Item Sleeves Length', 'dokan-lite' ), 'value' => $item_sleeves_length ) ); ?>
		<div class="dokan-product-title-alert dokan-hide">
			<?php esc_html_e( 'Please enter Item Sleeves Length!', 'dokan-lite' ); ?>
		</div>

		<input type="hidden" class="dokan-form-control" name="item_sleeves_width" value="<?php echo esc_attr( $post_id ); ?>"/>
		<label for="item_sleeves_width" class="form-label"><?php esc_html_e( 'Item Sleeves Width', 'dokan-lite' ); ?></label>
		<?php dokan_post_input_box( $post_id, 'item_sleeves_width', array( 'placeholder' => __( 'Item Sleeves Width', 'dokan-lite' ), 'value' => $item_sleeves_width ) ); ?>
		<div class="dokan-product-title-alert dokan-hide">
			<?php esc_html_e( 'Please enter Item Sleeves Width!', 'dokan-lite' ); ?>
		</div>

		<!-- Fabric for Alteration -->
		<input type="hidden" id="item_fabric" name="item_fabric" value="<?php echo esc_attr( $post_id ); ?>"/>
		<label for="item_fabric" class="form-label"><?php esc_html_e( 'Fabric for Alterations', 'dokan-lite' ); ?></label>
		<?php dokan_post_input_box( $post_id, 'item_fabric', array( 'placeholder' => __( 'Fabric for Alterations', 'dokan-lite' ), 'value' => $item_fabric ) ); ?>
		<div class="dokan-product-title-alert dokan-hide">
			<?php esc_html_e( 'Please enter if you have Fabric for Alterations!', 'dokan-lite' ); ?>
		</div>
		
	</div> 
	<?php

}


add_action( 'woocommerce_single_product_summary', 'show_product_code', 13 );
/**
 * Showing on single product page
 */
function show_product_code() {
	global $product;

	if ( empty( $product ) ) {
		return;
	}

	$item_price_paid     = get_post_meta( $product->get_id(), 'item_price_paid', true );
	$item_colour         = get_post_meta( $product->get_id(), 'item_colour', true );
/* 	$item_width          = get_post_meta( $product->get_id(), 'item_width', true );
	$item_length         = get_post_meta( $product->get_id(), 'item_length', true );
	$item_waist          = get_post_meta( $product->get_id(), 'item_waist', true );
	$item_bust           = get_post_meta( $product->get_id(), 'item_bust', true );
	$item_hips           = get_post_meta( $product->get_id(), 'item_hips', true );
	$item_sleeves_length = get_post_meta( $product->get_id(), 'item_sleeves_length', true );
	$item_sleeves_width  = get_post_meta( $product->get_id(), 'item_sleeves_width', true );
	$item_fabric         = get_post_meta( $product->get_id(), 'item_fabric', true ); */

	if ( ! empty( $item_price_paid ) ) {
		?>
			<page><span class="details"><?php echo esc_attr__( 'Price paid: £', 'dokan-lite' ); ?> <?php echo esc_attr( $item_price_paid ); ?></span></ap>
		<?php
	}

	if ( ! empty( $item_colour ) ) {
		?>
			<p><span class="details"><?php echo esc_attr__( 'Colour:', 'dokan-lite' ); ?> <?php echo esc_attr( $item_colour ); ?></span></p>
		<?php
	}
/* 
	if ( ! empty( $item_length ) ) {
		?>
			<span class="details"><?php echo esc_attr__( 'Item Length:', 'dokan-lite' ); ?> <?php echo esc_attr( $item_length ); ?></span>
		<?php
	}
	if ( ! empty( $item_width ) ) {
		?>
			<span class="details"><?php echo esc_attr__( 'Item Width:', 'dokan-lite' ); ?> <?php echo esc_attr( $item_width ); ?></span>
		<?php
	}
	if ( ! empty( $item_waist ) ) {
		?>
			<span class="details"><?php echo esc_attr__( 'Item Waist:', 'dokan-lite' ); ?> <?php echo esc_attr( $item_waist ); ?></span>
		<?php
	}
	if ( ! empty( $item_bust ) ) {
		?>
			<span class="details"><?php echo esc_attr__( 'Item Bust:', 'dokan-lite' ); ?> <?php echo esc_attr( $item_bust ); ?></span>
		<?php
	}
	if ( ! empty( $item_hips ) ) {
		?>
			<span class="details"><?php echo esc_attr__( 'Item Hips:', 'dokan-lite' ); ?> <?php echo esc_attr( $item_hips ); ?></span>
		<?php
	}
	if ( ! empty( $item_sleeves_length ) ) {
		?>
			<span class="details"><?php echo esc_attr__( 'Item Sleeves Length:', 'dokan-lite' ); ?> <?php echo esc_attr( $item_sleeves_length ); ?></span>
		<?php
	}
	if ( ! empty( $item_sleeves_width ) ) {
		?>
			<span class="details"><?php echo esc_attr__( 'Item Sleeves Width:', 'dokan-lite' ); ?> <?php echo esc_attr( $item_sleeves_width ); ?></span>
		<?php
	}
	if ( ! empty( $item_fabric ) ) {
		?>
			<span class="details"><?php echo esc_attr__( 'Fabric for Alterations:', 'dokan-lite' ); ?> <?php echo esc_attr( $item_fabric ); ?></span>
		<?php
	} */

}


add_action( 'woocommerce_product_additional_information', 'show_product_code_additional', 13 );
/**
 * Showing on single product page
 */
function show_product_code_additional() {
	global $product;

	if ( empty( $product ) ) {
		return;
	}

	//$item_price_paid     = get_post_meta( $product->get_id(), 'item_price_paid', true );
	//$item_colour         = get_post_meta( $product->get_id(), 'item_colour', true );
	$item_width          = get_post_meta( $product->get_id(), 'item_width', true );
	$item_length         = get_post_meta( $product->get_id(), 'item_length', true );
	$item_waist          = get_post_meta( $product->get_id(), 'item_waist', true );
	$item_bust           = get_post_meta( $product->get_id(), 'item_bust', true );
	$item_hips           = get_post_meta( $product->get_id(), 'item_hips', true );
	$item_sleeves_length = get_post_meta( $product->get_id(), 'item_sleeves_length', true );
	$item_sleeves_width  = get_post_meta( $product->get_id(), 'item_sleeves_width', true );
	$item_fabric         = get_post_meta( $product->get_id(), 'item_fabric', true );

/* 	if ( ! empty( $item_price_paid ) ) {
		?>
			<span class="details"><?php echo esc_attr__( 'Price paid: £', 'dokan-lite' ); ?> <?php echo esc_attr( $item_price_paid ); ?></span>
		<?php
	}

	if ( ! empty( $item_colour ) ) {
		?>
			<span class="details"><?php echo esc_attr__( 'Colour:', 'dokan-lite' ); ?> <?php echo esc_attr( $item_colour ); ?></span>
		<?php
	} */

	?>
	<table class="woocommerce-product-attributes shop_attributes">
			<tbody>
	<?php
	if ( ! empty( $item_length ) ) {
		?>
		<tr class="woocommerce-product-attributes-item item_length; ?>">
			<th class="woocommerce-product-attributes-item__label"><?php echo esc_attr__( 'Item Length:', 'dokan-lite' ); ?> </th>
			<td class="woocommerce-product-attributes-item__value"><p><?php echo esc_attr( $item_length ); ?></p></td>
		</tr>
		<?php
	}
	if ( ! empty( $item_width ) ) {
		?>
		<tr class="woocommerce-product-attributes-item item_width; ?>">
			<th class="woocommerce-product-attributes-item__label"><?php echo esc_attr__( 'Item Width:', 'dokan-lite' ); ?> </th>
			<td class="woocommerce-product-attributes-item__value"><p><?php echo esc_attr( $item_width ); ?></p></td>
		</tr>
				<?php
	}
	if ( ! empty( $item_waist ) ) {
		?>
		<tr class="woocommerce-product-attributes-item  item_waist">
			<th class="woocommerce-product-attributes-item__label"><?php echo esc_attr__( 'Item Waist:', 'dokan-lite' ); ?> </th>
			<td class="woocommerce-product-attributes-item__value"><p><?php echo esc_attr( $item_waist ); ?></p></td>
		</tr>
	
		<?php
	}
	if ( ! empty( $item_bust ) ) {
		?>
		<tr class="woocommerce-product-attributes-item item_bust">
			<th class="woocommerce-product-attributes-item__label"><?php echo esc_attr__( 'Item Bust:', 'dokan-lite' ); ?> </th>
			<td class="woocommerce-product-attributes-item__value"><p><?php echo esc_attr( $item_bust ); ?></p></td>
		</tr>
		<?php
	}
	if ( ! empty( $item_hips ) ) {
		?>
		<tr class="woocommerce-product-attributes-item item_hips">
			<th class="woocommerce-product-attributes-item__label"><?php echo esc_attr__( 'Item Hips:', 'dokan-lite' ); ?> </th>
			<td class="woocommerce-product-attributes-item__value"><p><?php echo esc_attr( $item_hips ); ?></p></td>
		</tr>
		<?php
	}
	if ( ! empty( $item_sleeves_length ) ) {
		?>
		<tr class="woocommerce-product-attributes-item item_sleeves_length">
			<th class="woocommerce-product-attributes-item__label"><?php echo esc_attr__( 'Item Sleeves Length:', 'dokan-lite' ); ?> </th>
			<td class="woocommerce-product-attributes-item__value"><p><?php echo esc_attr( $item_sleeves_length ); ?></p></td>
		</tr>
			<?php
	}
	if ( ! empty( $item_sleeves_width ) ) {
		?>
		<tr class="woocommerce-product-attributes-item item_sleeves_width">
			<th class="woocommerce-product-attributes-item__label"><?php echo esc_attr__( 'Item Sleeves Width:', 'dokan-lite' ); ?> </th>
			<td class="woocommerce-product-attributes-item__value"><p><?php echo esc_attr( $item_sleeves_width ); ?></p></td>
		</tr>
		<?php
	}
	if ( ! empty( $item_fabric ) ) {
		?>
		<tr class="woocommerce-product-attributes-item item_fabric">
			<th class="woocommerce-product-attributes-item__label"><?php echo esc_attr__( 'Fabric for Alterations:', 'dokan-lite' ); ?> </th>
			<td class="woocommerce-product-attributes-item__value"><p><?php echo esc_attr( $item_fabric ); ?></p></td>
		</tr>
		<?php
	}
	?>
	</tbody></table>
	<?php

}
