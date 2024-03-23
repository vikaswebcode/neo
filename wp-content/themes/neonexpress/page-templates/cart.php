<?php
/**
 * Template Name: Cart
 *
 * @package Neon_Express
 */

 global $woocommerce;

 // Получение объекта корзины
 $cart = $woocommerce->cart;
get_header();


// Получение данных о товаре

?>
<main class="ne-main default-page">
	<?php
        foreach ($cart->get_cart() as $cart_item_key => $cart_item) :
            // Получение ID товара
            $product_id = $cart_item['product_id'];

            // Получение объекта товара
            $product = wc_get_product($product_id);

            // Получение данных о товаре
            $product_name = $product->get_name();
            $product_price = $product->get_price();
     ?>
     <div class="container">
        <div class="design-proof-window">
            <div class="product-thumb">
                <img style="width: auto;" src="<?php echo get_the_post_thumbnail_url( $product_id ); ?>" alt=""/>
            </div>
            <div class="product-dimensions">
                <h2>Dimensions</h2>
                <p>Width: <?php echo $product->get_width(); ?></p>
                <p>Height: <?php echo $product->get_height(); ?></p>
                <p>Cut to shape: The backboard adds a margin of about 2cm around the text</p>
                <p>Hollow out: No note</p>
                <p>Rectangular or stand: The backboard adds a margin of about 5cm around the text.</p>
            </div>
            <div class="product-box">
                <div class="product-thumb">
                    <h2>What’s in the box:</h2>
                    <p>Placement: <?php echo get_post_meta( $product_id, 'placement', true ); ?></p>
                    <p>Cable color: 2m <?php echo get_post_meta( $product_id, 'cable_color', true ); ?></p>
                    <p>Electrical plug: European standard plug 220V</p>
                    <p>Mounting kit:  <?php echo get_post_meta( $product_id, 'mounting', true ); ?> <?php echo get_post_meta( $product_id, 'mounting_color', true ); ?></p>
                    <p>Free remote control and dimmer provided</p>
                    <p>Total Price: <?php echo $product_price . ' €'; ?></p>
                </div>
            </div>
            <div>
                <a href="<?php echo wc_get_checkout_url(); ?>" class="button">Make My Sign</a>
            </div>
        <div>
        </div>
     </div>
     <?php endforeach; ?>
</main>
 <?php
 get_footer();

// Вывод данных
