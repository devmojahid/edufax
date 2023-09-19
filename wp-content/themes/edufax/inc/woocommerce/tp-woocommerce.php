<?php

// shop page hooks
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// content-product hooks--
// action remove
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

// single product 
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);


add_action('woocommerce_single_product_summary', 'edufax_product_single_features', 60);

add_action('woocommerce_archive_description', 'woocommerce_breadcrumb', 20);

add_filter('edufax_woo_compare_filter', 'edufax_woo_compare_func');

// coupon
function edufax_woo_compare_func()
{
    $all_products = get_user_meta(get_current_user_id(), 'woosc_products', true);

    if (!is_user_logged_in()) {
        $cookie = 'woosc_products_' . md5('woosc' . get_current_user_id());
        $all_products = !empty($_COOKIE[$cookie]) ? $_COOKIE[$cookie] : '';
    }

    $new_products = explode(',', sanitize_text_field($all_products));

    $product_count =  array_filter($new_products, function ($ex) {
        return !empty($ex);
    });

    $total_compared_product = count($product_count);

    return $total_compared_product;
}

function edufax_product_single_features()
{

    $features_list = function_exists('tpmeta_field') ? tpmeta_field('edufax_product_single_fea_meta') : '';

    $payment_switch = get_theme_mod('edufax_product_single_payment_switch', false);
    $payment_text = get_theme_mod('edufax_product_single_payment_text', 'Guaranteed safe & secure checkout');
    $payment_img = get_theme_mod('edufax_product_single_payment_img');


?>

    <?php if (!empty($features_list[0]['edufax_product_signle_fea'])) : ?>
        <div class="tp-product-details-msg mb-15">
            <ul>
                <?php foreach ($features_list as $feature) : ?>
                    <li><?php echo edufax_kses($feature['edufax_product_signle_fea']); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($payment_switch == true) : ?>
        <div class="tp-product-details-payment d-flex align-items-center flex-wrap justify-content-between">
            <?php if (!empty($payment_text)) : ?>
                <p><?php echo esc_html($payment_text); ?></p>
            <?php endif; ?>

            <?php if (!empty($payment_img)) : ?>
                <img src="<?php echo esc_url($payment_img); ?>" alt="<?php echo esc_attr__('payment-img', 'edufax'); ?>">
            <?php endif; ?>
        </div>
    <?php endif; ?>

<?php
}


// compare_false
add_filter('woosc_button_position_archive', '__return_false');
add_filter('woosc_button_position_single', '__return_false');

// wishlist false
add_filter('woosw_button_position_archive', '__return_false');
add_filter('woosw_button_position_single', '__return_false');


/*************************************************
## Free shipping progress bar.
 *************************************************/
function edufax_shipping_progress_bar()
{

    $enable_free_shipping_bar = get_theme_mod('enable_free_shipping_bar', false);

    $total           = WC()->cart->get_displayed_subtotal();
    $limit           = get_theme_mod('shipping_progress_bar_amount', '100');
    $percent         = 100;


    if ($total < $limit) {
        $percent = floor(($total / $limit) * 100);
        $message = str_replace('[remainder]', wc_price($limit - $total), get_theme_mod('shipping_progress_bar_message_initial', 'Add [remainder] to cart and get free shipping!'));
    } else {
        $message = get_theme_mod('shipping_progress_bar_message_success', 'Your order qualifies for free shipping!');
    }

?>

    <?php if ($enable_free_shipping_bar) : ?>
        <div class="cartmini__shipping">
            <p><?php echo wp_kses($message, 'post'); ?></p>
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo esc_attr($percent); ?>%"></div>
            </div>
        </div>
    <?php endif; ?>

<?php
}

if (get_theme_mod('shipping_progress_bar_location_card_page', false) == true) {
    add_action('woocommerce_before_cart_table',  'edufax_shipping_progress_bar');
}

if (get_theme_mod('shipping_progress_bar_location_mini_cart', false) == true) {
    add_action('woocommerce_before_mini_cart_contents', 'edufax_shipping_progress_bar');
}

if (get_theme_mod('shipping_progress_bar_location_checkout', false) == true) {
    add_action('woocommerce_checkout_before_customer_details', 'edufax_shipping_progress_bar');
}


/*************************************************
## sale percentage
 *************************************************/

function edufax_sale_percentage()
{
    global $product;
    $output = '';
    $icon = esc_html__("-", 'edufax');

    if ($product->is_on_sale() && $product->is_type('variable')) {
        $percentage = ceil(100 - ($product->get_variation_sale_price() / $product->get_variation_regular_price('min')) * 100);
        $output .= '<div class="product-percentage-badges"><span class="tp-product-details-offer">' . $icon . $percentage . '%</span></div>';
    } elseif ($product->is_on_sale() && $product->get_regular_price()  && !$product->is_type('grouped')) {
        $percentage = ceil(100 - ($product->get_sale_price() / $product->get_regular_price()) * 100);
        $output .= '<div class="product-percentage-badges">';
        $output .= '<span class="tp-product-details-offer">' . $icon . $percentage . '%</span>';
        $output .= '</div>';
    }
    return $output;
}


// woocommerce mini cart content
add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    ob_start();
?>
    <div class="mini_shopping_cart_box">
        <?php woocommerce_mini_cart(); ?>
    </div>
    <?php $fragments['.mini_shopping_cart_box'] = ob_get_clean();
    return $fragments;
});

// woocommerce mini cart count icon
if (!function_exists('edufax_header_add_to_cart_fragment')) {
    function edufax_header_add_to_cart_fragment($fragments)
    {
        ob_start();
    ?>
        <span class="cart__count tp-header-action-badge" id="tp-cart-item">
            <?php echo esc_html(WC()->cart->cart_contents_count); ?>
        </span>
    <?php
        $fragments['#tp-cart-item'] = ob_get_clean();

        return $fragments;
    }
}
add_filter('woocommerce_add_to_cart_fragments', 'edufax_header_add_to_cart_fragment');

// edufax_shopping_cart
function edufax_shopping_cart()
{
    if (is_null(WC()->cart)) {
        return;
    }
    ob_start();
    ?>
    <!-- cart mini area start -->
    <div class="cartmini__area">
        <div class="cartmini__wrapper d-flex justify-content-between flex-column">
            <div class="cartmini__top-wrapper">
                <div class="cartmini__top p-relative">
                    <div class="cartmini__top-title">
                        <h4><?php print esc_html__('Shopping cart', 'edufax'); ?></h4>
                    </div>
                    <div class="cartmini__close">
                        <button type="button" class="cartmini__close-btn cartmini-close-btn"><i class="fal fa-times"></i></button>
                    </div>
                </div>

                <div class="mini_shopping_cart_box"><?php woocommerce_mini_cart(); ?></div>

            </div>

        </div>
        <div class="header-mini-cart"></div>
    </div>
    <!-- cart mini area end -->

<?php
    return ob_get_clean();
}


// edufax_bottom_menu


function edufax_bottom_menu()
{
?>
    <div id="tp-bottom-menu-sticky" class="tp-mobile-menu d-lg-none">
        <div class="container">
            <div class="row row-cols-5">
                <?php if (class_exists('WooCommerce')) : ?>
                    <div class="col">
                        <div class="tp-mobile-item text-center">
                            <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_shop_page_id'))); ?>" class="tp-mobile-item-btn">
                                <i class="edufaxicon-store"></i>
                                <span><?php echo esc_html__('Store', 'edufax'); ?></span>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col">
                    <div class="tp-mobile-item text-center">
                        <button class="tp-mobile-item-btn tp-search-open-btn">
                            <i class="edufaxicon-magnifying-glass"></i>
                            <span><?php echo esc_html__('Search', 'edufax'); ?></span>
                        </button>
                    </div>
                </div>

                <?php if (class_exists('WPCleverWoosw')) :
                    $wishlist_data = new WPCleverWoosw();

                    $key        = $wishlist_data::get_key();
                    $products   = $wishlist_data::get_ids($key);
                    $count      = count($products);
                ?>
                    <div class="col">
                        <div class="tp-mobile-item text-center">
                            <a href="<?php echo esc_url($wishlist_data::get_url($key, true)); ?>" class="tp-mobile-item-btn">
                                <i class="edufaxicon-heart"></i>
                                <span><?php echo esc_html__('Wishlist', 'edufax'); ?></span>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (class_exists('WooCommerce')) : ?>
                    <div class="col">
                        <div class="tp-mobile-item text-center">
                            <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" class="tp-mobile-item-btn">
                                <i class="edufaxicon-user"></i>
                                <span><?php echo esc_html__('Account', 'edufax'); ?></span>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col">
                    <div class="tp-mobile-item text-center">
                        <button class="tp-mobile-item-btn tp-offcanvas-open-btn">
                            <i class="edufaxicon-menu-1"></i>
                            <span><?php echo esc_html__('Menu', 'edufax'); ?></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- mobile menu area end -->
    <?php
}

add_filter('woocommerce_single_product_image_thumbnail_html', 'edufax_product_img', 10, 2);
function edufax_product_img($html, $id)
{

    $video_url = function_exists('tpmeta_field') ? tpmeta_field('edufax_product_signle__video') : '';


    $alt_text = trim(wp_strip_all_tags(get_post_meta($id, '_wp_attachment_image_alt', true)));
    $full_src = wp_get_attachment_image_src($id, "full");


    if (empty($video_url)) {
        return $html;
    } else {
        $output  = '<div class="woocommerce-product-gallery__image" data-thumb="' . esc_url($full_src[0]) . '" data-thumb-alt="' . esc_attr($alt_text) . '">';
        $output  .= '<a href="' . esc_url($full_src[0]) . '"> ' . $html . ' </a>';
        $output .= '<div class="tp-product-details-thumb-video">';
        $output .= '<a href="' . esc_url($video_url) . '" class="tp-product-details-thumb-video-btn popup-video"><i class="fas fa-play"></i></a>';
        $output .= '</div>';
        $output .= '</div>';

        return $output;
    }
}


// product-content single
if (!function_exists('edufax_content_single_details')) {
    function edufax_content_single_details()
    {
        global $product;
        global $post;
        global $woocommerce;
        $rating = wc_get_rating_html($product->get_average_rating());
        $ratingcount = $product->get_review_count();
        $regularPrice = $product->get_regular_price();

        $attachment_ids = $product->get_gallery_image_ids();

        foreach ($attachment_ids as $attachment_id) {
            $image_link = wp_get_attachment_url($attachment_id);
        }

        $stock_quantity = $product->get_stock_quantity();

        $rating_count = $product->get_rating_count();
        $review_count = $product->get_review_count();
        $average      = $product->get_average_rating();
        $availability = $product->is_in_stock();

        $class = $availability  ? 'in-stock' : 'out-of-stock';
        $stockClass = $availability ? 'In Stock ' : 'Out Of Stock';
        $terms = get_the_terms(get_the_ID(), 'product_cat');

        if (!is_null($product->get_date_on_sale_to())) {
            $_sale_date_end = $product->get_date_on_sale_to()->date("M d Y h:m:i");
        }


        // data come from customizer

        $enable_category = get_theme_mod('edufax_product_single_category_switch', true);
        $enable_stock = get_theme_mod('edufax_product_single_in_stock_switch', true);
        $enable_flash_sale = get_theme_mod('edufax_product_single_flash_sale_switch', false);
        $enable_flash_sale_text = get_theme_mod('edufax_product_single_flash_sale_text', 'Flash Sale Ends in:');
        $enable_stock_left = get_theme_mod('edufax_product_single_stock_left_switch', '49');
        $enable_stock_left_count = get_theme_mod('edufax_product_single_stock_left_count', '49');

    ?>

        <?php if (!empty($enable_category)) : ?>
            <div class="tp-woo-single-category">
                <?php foreach ($terms as $key => $term) :
                    $count = count($terms) - 1;
                    $name = ($count > $key) ? $term->name . ', ' : $term->name
                ?>

                    <a href="<?php echo get_term_link($term->slug, 'product_cat'); ?> "> <?php echo esc_html($name); ?></a>

                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <h3 class="tp-product-details-title"><?php the_title(); ?></h3>

        <div class="tp-product-details-inventory d-flex align-items-center mb-10">
            <?php if (!empty($enable_stock)) : ?>
                <div class="tp-product-details-stock mb-10">
                    <span class="stock <?php echo esc_attr($class); ?>"><?php echo esc_html($stockClass); ?></span>
                </div>
            <?php endif; ?>

            <?php if ($rating_count > 0) : ?>
                <div class="tp-product-details-rating-wrapper d-flex align-items-center mb-10">
                    <div class="tp-product-details-rating">
                        <?php echo wc_get_rating_html($average, $rating_count); ?>
                    </div>

                    <div class="woocommerce-product-rating tp-product-details-reviews">

                        <?php if (comments_open()) : ?>
                            <?php //phpcs:disable 
                            ?>
                            <a href="#reviews" class="woocommerce-review-link" rel="nofollow"><?php printf(_n('( %s Review )', '( %s Reviews )', $review_count, 'edufax'), '<span class="count">' . esc_html($review_count) . '</span>'); ?></a>
                            <?php // phpcs:enable 
                            ?>
                        <?php endif; ?>
                    </div>
                </div>

            <?php endif; ?>
        </div>


        <?php if (!empty(woocommerce_template_single_excerpt())) : ?>
            <p><?php woocommerce_template_single_excerpt(); ?></p>
        <?php endif; ?>

        <!-- price -->
        <div class="tp-product-details-price-wrapper mb-20">
            <?php woocommerce_template_single_price(); ?>
        </div>


        <?php if (!empty($enable_flash_sale)) : ?>
            <?php if (!is_null($product->get_date_on_sale_to())) : ?>
                <!-- produc count down start -->
                <div class="tp-product-details-countdown d-flex align-items-center justify-content-between flex-wrap mt-25 mb-25">
                    <h4 class="tp-product-details-countdown-title"><i class="fa-solid fa-fire-flame-curved"></i> <?php echo esc_html($enable_flash_sale_text); ?> </h4>
                    <div class="tp-product-details-countdown-time" data-countdown data-date="<?php echo esc_attr($_sale_date_end); ?>">
                        <ul>
                            <li><span data-days><?php echo esc_html__('0', 'edufax'); ?></span><?php echo esc_html__('D', 'edufax'); ?></li>
                            <li><span data-hours><?php echo esc_html__('0', 'edufax'); ?></span><?php echo esc_html__('H', 'edufax'); ?></li>
                            <li><span data-minutes><?php echo esc_html__('0', 'edufax'); ?></span><?php echo esc_html__('M', 'edufax'); ?></li>
                            <li><span data-seconds><?php echo esc_html__('0', 'edufax'); ?></span><?php echo esc_html__('S', 'edufax'); ?></li>
                        </ul>
                    </div>
                </div>
                <!-- produc count down end -->
            <?php endif; ?>
        <?php endif; ?>


        <?php if (!empty($enable_stock_left)) : ?>
            <?php if ($enable_stock_left_count > $stock_quantity && !empty($stock_quantity)) :

                $width = (100  - $stock_quantity) . "%";
            ?>
                <div class="tp-product-details-stock-bar mb-25">
                    <p><?php echo esc_html__('Hurry! Only', 'edufax'); ?> <span><?php echo esc_html($stock_quantity); ?></span> <?php echo esc_html__('units left in stock!', 'edufax'); ?> </p>

                    <div class="tp-product-details-stock-bar-line" data-bg-color="#D3DAE1" style="background-color: rgb(211, 218, 225);">
                        <span class="tp-product-details-stock-bar-line-inner" data-width="<?php echo esc_attr($width); ?>"></span>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <!-- actions -->
        <div class="tp-product-details-action-wrapper tp-woo-single-variation">
            <div class="tp-product-details-action-item-wrapper ">
                <?php woocommerce_template_single_add_to_cart(); ?>
            </div>
        </div>

        <?php woocommerce_template_single_meta(); ?>
    <?php
    }
}
add_action('woocommerce_single_product_summary', 'edufax_content_single_details', 4);



// product-content archive
if (!function_exists('edufax_content_product_grid')) {
    function edufax_content_product_grid()
    {


        if (get_theme_mod('shop_grid_layout') === "2") {
            edufax_product_grid_type_2();
        } elseif (get_theme_mod('shop_grid_layout') === "3") {
            edufax_product_grid_type_3();
        } elseif (get_theme_mod('shop_grid_layout') === "4") {
            edufax_product_grid_type_4();
        } elseif (get_theme_mod('shop_grid_layout') === "5") {
            edufax_product_grid_type_5();
        } elseif (get_theme_mod('shop_grid_layout') === "6") {
            edufax_product_grid_type_6();
        } else {
            edufax_product_grid_type_1();
        }
    }
}
add_action('woocommerce_before_shop_loop_item', 'edufax_content_product_grid', 10);


add_action('edufax_product_badge_action', 'edufax_product_badges');

function edufax_product_badges()
{
    global $product;
    global $post;
    global $woocommerce;
    $rating = wc_get_rating_html($product->get_average_rating());
    $terms = get_the_terms(get_the_ID(), 'product_cat');

    $enable_trending_badge = get_theme_mod('enable_trending_badge', false);
    $enable_hot_badge = get_theme_mod('enable_hot_badge', false);

    $is_product_on_trending = function_exists('tpmeta_field') ? tpmeta_field('edufax_product_on_trending') : '';
    $is_product_on_hot = function_exists('tpmeta_field') ? tpmeta_field('edufax_product_on_hot') : '';

    $product_bage_from_meta = function_exists('tpmeta_field') ? tpmeta_field('edufax_product_bage_type') : '';

    $product_badge_type = !empty($product_bage_from_meta) ?  $product_bage_from_meta : get_theme_mod('trending_badge_showing_condition');

    $sale_count_to_show = get_theme_mod('sale_count_to_show', 2);
    $rating_count_to_show = get_theme_mod('rating_count_to_show', 4);
    $review_count_to_show = get_theme_mod('review_count_to_show', 3);
    $view_count_to_show = get_theme_mod('view_count_to_show', 5);
    $date_diff_to_show = get_theme_mod('date_diff_to_show', 10);

    $sale_count = get_post_meta($product->get_id(), 'total_sales', true);
    $view_count = get_post_meta($product->get_id(), 'view_count', true);
    $product_rating_count = $product->get_average_rating();
    $review_count = $product->get_review_count();


    $count_time = new DateTime($product->get_date_created()->date("y-m-d"));
    $current_time = new DateTime(date('y-m-d'));

    $date_diff = date_diff($count_time, $current_time, true)->days;

    ?>

    <ul class="d-flex">
        <?php if ($product->is_on_sale()) : ?>
            <li>
                <?php woocommerce_show_product_loop_sale_flash(); ?>
            </li>
        <?php endif; ?>


        <?php if ($enable_trending_badge || $is_product_on_trending === "on") : ?>


            <?php if ($is_product_on_trending === "on") : ?>
                <li>
                    <span class="onsale on-trending"><?php echo esc_html__('Trending', 'edufax'); ?></span>
                </li>

            <?php elseif ($product_badge_type === "sales") : ?>
                <!-- it depends on sales -->
                <?php if ($sale_count > $sale_count_to_show) : ?>
                    <li>
                        <span class="onsale on-trending"><?php echo esc_html__('Trending', 'edufax'); ?></span>
                    </li>
                    <!-- it depends on sales end -->
                <?php endif; ?>

            <?php elseif ($product_badge_type === "rating") : ?>

                <!-- it depends on rating -->
                <?php if (floatval($product_rating_count) >= floatval($rating_count_to_show)) : ?>
                    <li>
                        <span class="onsale on-trending"><?php echo esc_html__('Trending', 'edufax'); ?></span>
                    </li>
                    <!-- it depends on rating end -->
                <?php endif; ?>

            <?php elseif ($product_badge_type === "review") : ?>

                <!-- it depends on review -->
                <?php if ($review_count >= $review_count_to_show) : ?>
                    <li>
                        <span class="onsale on-trending"><?php echo esc_html__('Trending', 'edufax'); ?></span>
                    </li>
                    <!-- it depends on review end -->
                <?php endif; ?>

            <?php elseif ($product_badge_type === "views") : ?>

                <!-- it depends on views -->
                <?php if ($view_count >= $view_count_to_show) : ?>
                    <li>
                        <span class="onsale on-trending"><?php echo esc_html__('Trending', 'edufax'); ?></span>
                    </li>
                    <!-- it depends on views end -->
                <?php endif; ?>


            <?php endif; ?>


        <?php endif; ?>

        <?php if ($is_product_on_hot === "on") : ?>
            <li>
                <span class="onsale on-hot"><?php echo esc_html__('Hot', 'edufax'); ?></span>
            </li>
        <?php elseif ($enable_hot_badge) : ?>
            <?php if ($date_diff <= $date_diff_to_show) : ?>
                <li>
                    <span class="onsale on-hot"><?php echo esc_html__('Hot', 'edufax'); ?></span>
                </li>
            <?php endif; ?>
        <?php endif; ?>
    </ul>


<?php
}

add_action('edufax_product_countdown_action', 'edufax_product_countdown');

function edufax_product_countdown()
{
    global $product;
    global $post;
    global $woocommerce;

    $enable_flash_sale = get_theme_mod('edufax_product_sale_countdown_switch', true);

    if (!is_null($product->get_date_on_sale_to())) {
        $_sale_date_end = $product->get_date_on_sale_to()->date("M d Y h:m:i");
    }

?>

    <?php if ($enable_flash_sale == true) : ?>
        <?php if (!is_null($product->get_date_on_sale_to())) : ?>
            <div class="tp-product-countdown-time" data-countdown="" data-date="<?php echo esc_attr($_sale_date_end); ?>">
                <ul>
                    <li><span data-days><?php echo esc_html__('0', 'edufax'); ?></span><?php echo esc_html__('D', 'edufax'); ?></li>
                    <li><span data-hours><?php echo esc_html__('0', 'edufax'); ?></span><?php echo esc_html__('H', 'edufax'); ?></li>
                    <li><span data-minutes><?php echo esc_html__('0', 'edufax'); ?></span><?php echo esc_html__('M', 'edufax'); ?></li>
                    <li><span data-seconds><?php echo esc_html__('0', 'edufax'); ?></span><?php echo esc_html__('S', 'edufax'); ?></li>
                </ul>
            </div>
        <?php endif; ?>
    <?php endif; ?>

<?php
}

function edufax_product_grid_type_1()
{

    global $product;
    global $post;
    global $woocommerce;
    $rating = wc_get_rating_html($product->get_average_rating());
    $terms = get_the_terms(get_the_ID(), 'product_cat');


?>
    <div class="tp-product-item-2 mb-40">

        <?php if (has_post_thumbnail()) : ?>
            <div class="tp-product-thumb-2 p-relative z-index-1 fix w-img">

                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail(); ?>
                </a>

                <!-- product sale -->
                <div class="tp-product-badge-2 d-flex">
                    <?php do_action('edufax_product_badge_action'); ?>
                </div>

                <!-- product countdown -->
                <div class="tp-product-countdown is-center-bottom">
                    <?php do_action('edufax_product_countdown_action'); ?>
                </div>

                <!-- product action -->
                <div class="tp-product-action-2 tp-product-action-blackStyle tp-woo-action">

                    <div class="tp-product-action-item-2 d-flex flex-column">

                        <div class="tp-product-action-btn-2 tp-woo-add-cart-btn tp-woo-action-btn">
                            <?php woocommerce_template_loop_add_to_cart(); ?>
                        </div>
                        <!-- quick view button -->
                        <?php if (class_exists('WPCleverWoosq')) : ?>
                            <div class="tp-product-action-btn-2 tp-woo-quick-view-btn tp-woo-action-btn">
                                <?php echo do_shortcode('[woosq]'); ?>
                            </div>
                        <?php endif; ?>


                        <?php if (function_exists('woosw_init')) : ?>
                            <!-- wishlist button -->
                            <div class="tp-product-action-btn-2 tp-woo-add-to-wishlist-btn tp-woo-action-btn">
                                <?php echo do_shortcode('[woosw]'); ?>
                            </div>
                        <?php endif; ?>


                        <?php if (function_exists('woosc_init')) : ?>
                            <!-- compare button -->
                            <div class="tp-product-action-btn-2 tp-woo-add-to-compare-btn tp-woo-action-btn">
                                <?php echo do_shortcode('[woosc]'); ?>
                                <span class="tp-product-tooltip tp-product-tooltip-right tp-woo-tooltip"> <?php echo esc_html__('Add To Compare', 'edufax'); ?></span>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>


            </div>
        <?php endif; ?>
        <div class="tp-product-content-2 pt-15">

            <div class="tp-product-tag-2">
                <?php foreach ($terms as $key => $term) :
                    $count = count($terms) - 1;

                    $name = ($count > $key) ? $term->name . ', ' : $term->name
                ?>
                    <a href="<?php echo get_term_link($term->slug, 'product_cat'); ?> "> <?php echo esc_html($name); ?></a>

                <?php endforeach; ?>
            </div>

            <h3 class="tp-product-title-2">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>

            <?php if (!empty($rating)) : ?>
                <div class="tp-product-rating-icon tp-product-rating-icon-2">
                    <?php echo edufax_kses($rating); ?>
                </div>
            <?php endif; ?>

            <div class="tp-product-price-wrapper-2 tp-woo-price">
                <?php echo woocommerce_template_loop_price(); ?>
            </div>
        </div>
    </div>
<?php
}

function edufax_product_grid_type_2()
{
    global $product;
    global $post;
    global $woocommerce;
    $rating = wc_get_rating_html($product->get_average_rating());
    $terms = get_the_terms(get_the_ID(), 'product_cat');

    $rating_count = $product->get_rating_count();
    $review_count = $product->get_review_count();
    $average      = $product->get_average_rating();

    $enable_trending_badge = get_theme_mod('enable_trending_badge', false);
    $enable_hot_badge = get_theme_mod('enable_hot_badge', false);

    $is_product_on_trending = function_exists('tpmeta_field') ? tpmeta_field('edufax_product_on_trending') : '';
    $is_product_on_hot = function_exists('tpmeta_field') ? tpmeta_field('edufax_product_on_hot') : '';

?>


    <div class="tp-product-item transition-3 mb-25">
        <?php if (has_post_thumbnail()) : ?>
            <div class="tp-product-thumb p-relative fix m-img">

                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail(); ?>
                </a>

                <!-- product badge -->
                <div class="tp-product-badge ">
                    <?php do_action('edufax_product_badge_action'); ?>
                </div>


                <!-- product action -->
                <div class="tp-product-action tp-woo-action tp-woo-action-2">
                    <div class="tp-product-action-item d-flex flex-column">

                        <div class="tp-product-action-btn tp-product-add-cart-btn tp-woo-add-cart-btn tp-woo-action-btn">
                            <?php woocommerce_template_loop_add_to_cart(); ?>
                        </div>

                        <!-- quick view button -->
                        <?php if (class_exists('WPCleverWoosq')) : ?>
                            <div class="tp-product-action-btn tp-woo-quick-view-btn tp-woo-action-btn">
                                <?php echo do_shortcode('[woosq]'); ?>
                            </div>
                        <?php endif; ?>


                        <?php if (function_exists('woosw_init')) : ?>
                            <!-- wishlist button -->
                            <div class="tp-product-action-btn tp-woo-add-to-wishlist-btn tp-woo-action-btn">
                                <?php echo do_shortcode('[woosw]'); ?>
                            </div>
                        <?php endif; ?>


                        <?php if (function_exists('woosc_init')) : ?>
                            <!-- compare button -->
                            <div class="tp-product-action-btn tp-woo-add-to-compare-btn tp-woo-action-btn">
                                <?php echo do_shortcode('[woosc]'); ?>
                                <span class="tp-product-tooltip tp-woo-tooltip"> <?php echo esc_html__('Add To Compare', 'edufax'); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <!-- product content -->
        <div class="tp-product-content">
            <div class="tp-product-category">
                <?php foreach ($terms as $key => $term) :
                    $count = count($terms) - 1;

                    $name = ($count > $key) ? $term->name . ', ' : $term->name
                ?>
                    <a href="<?php echo get_term_link($term->slug, 'product_cat'); ?> "> <?php echo esc_html($name); ?></a>
                <?php endforeach; ?>
            </div>

            <h3 class="tp-product-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>

            <?php if ($rating_count > 0) : ?>
                <div class="tp-product-rating d-flex align-items-center">
                    <div class="tp-product-rating-icon">
                        <?php echo edufax_kses($rating); ?>
                    </div>
                    <div class="tp-product-rating-text">
                        <?php if (comments_open()) : ?>
                            <?php //phpcs:disable 
                            ?>
                            <a href="#reviews" class="woocommerce-review-link" rel="nofollow"><?php printf(_n('( %s Review )', '( %s Reviews )', $review_count, 'edufax'), '<span class="count">' . esc_html($review_count) . '</span>'); ?></a>
                            <?php // phpcs:enable 
                            ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="tp-product-price-wrapper tp-woo-price tp-woo-price-2">
                <?php echo woocommerce_template_loop_price(); ?>
            </div>
        </div>
    </div>
<?php
}

function edufax_product_grid_type_3()
{
    global $product;
    global $post;
    global $woocommerce;
    $rating = wc_get_rating_html($product->get_average_rating());
    $terms = get_the_terms(get_the_ID(), 'product_cat');

    $rating_count = $product->get_rating_count();
    $review_count = $product->get_review_count();
    $average      = $product->get_average_rating();

    $enable_trending_badge = get_theme_mod('enable_trending_badge', false);
    $enable_hot_badge = get_theme_mod('enable_hot_badge', false);

    $is_product_on_trending = function_exists('tpmeta_field') ? tpmeta_field('edufax_product_on_trending') : '';
    $is_product_on_hot = function_exists('tpmeta_field') ? tpmeta_field('edufax_product_on_hot') : '';

    $has_rating = $rating_count > 0 ? 'has-rating' : '';
?>

    <div class="tp-product-item-3 mb-50">
        <?php if (has_post_thumbnail()) : ?>
            <div class="tp-product-thumb-3 mb-15 fix p-relative z-index-1">

                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail(); ?>
                </a>


                <!-- product badge -->
                <div class="tp-product-badge-2 ">
                    <?php do_action('edufax_product_badge_action'); ?>
                </div>




                <!-- product action -->
                <div class="tp-product-action-3 tp-product-action-blackStyle tp-woo-action tp-woo-action-2 tp-woo-action-3">
                    <div class="tp-product-action-item-3 d-flex flex-column">


                        <!-- quick view button -->
                        <?php if (class_exists('WPCleverWoosq')) : ?>
                            <div class="tp-product-action-btn-3 tp-woo-quick-view-btn tp-woo-action-btn">
                                <?php echo do_shortcode('[woosq]'); ?>
                            </div>
                        <?php endif; ?>


                        <?php if (function_exists('woosw_init')) : ?>
                            <!-- wishlist button -->
                            <div class="tp-product-action-btn-3 tp-woo-add-to-wishlist-btn tp-woo-action-btn">
                                <?php echo do_shortcode('[woosw]'); ?>
                            </div>
                        <?php endif; ?>


                        <?php if (function_exists('woosc_init')) : ?>
                            <!-- compare button -->
                            <div class="tp-product-action-btn-3 tp-woo-add-to-compare-btn tp-woo-action-btn">
                                <?php echo do_shortcode('[woosc]'); ?>
                                <span class="tp-product-tooltip tp-woo-tooltip"> <?php echo esc_html__('Add To Compare', 'edufax'); ?></span>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

                <div class="tp-woo-action tp-woo-action-3">
                    <div class="tp-product-add-cart-btn-large-3 tp-woo-add-cart-btn tp-woo-action-btn">
                        <?php woocommerce_template_loop_add_to_cart(); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="tp-product-content-3">
            <div class="tp-product-tag-3">
                <?php foreach ($terms as $key => $term) :
                    $count = count($terms) - 1;

                    $name = ($count > $key) ? $term->name . ', ' : $term->name
                ?>
                    <a href="<?php echo get_term_link($term->slug, 'product_cat'); ?> "> <?php echo esc_html($name); ?></a>
                <?php endforeach; ?>
            </div>

            <h3 class="tp-product-title-3 <?php echo esc_attr($has_rating); ?>">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>

            <?php if ($rating_count > 0) : ?>
                <div class="tp-product-rating tp-product-rating-3 d-flex align-items-center <?php echo esc_attr($has_rating); ?>">
                    <div class="tp-product-rating-icon">
                        <?php echo edufax_kses($rating); ?>
                    </div>
                    <div class="tp-product-rating-text">
                        <?php if (comments_open()) : ?>
                            <?php //phpcs:disable 
                            ?>
                            <a href="#reviews" class="woocommerce-review-link" rel="nofollow"><?php printf(_n('( %s Review )', '( %s Reviews )', $review_count, 'edufax'), '<span class="count">' . esc_html($review_count) . '</span>'); ?></a>
                            <?php // phpcs:enable 
                            ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="tp-product-price-wrapper-3 tp-woo-price">
                <?php echo woocommerce_template_loop_price(); ?>
            </div>
        </div>
    </div>

<?php
}

function edufax_product_grid_type_4()
{
    global $product;
    global $post;
    global $woocommerce;
    $rating = wc_get_rating_html($product->get_average_rating());
    $terms = get_the_terms(get_the_ID(), 'product_cat');

    $rating_count = $product->get_rating_count();
    $review_count = $product->get_review_count();
    $average      = $product->get_average_rating();

    $enable_trending_badge = get_theme_mod('enable_trending_badge', false);
    $enable_hot_badge = get_theme_mod('enable_hot_badge', false);

    $is_product_on_trending = function_exists('tpmeta_field') ? tpmeta_field('edufax_product_on_trending') : '';
    $is_product_on_hot = function_exists('tpmeta_field') ? tpmeta_field('edufax_product_on_hot') : '';

    $has_rating = $rating_count > 0 ? 'has-rating' : '';
?>

    <div class="tp-product-item-4 p-relative mb-40">
        <?php if (has_post_thumbnail()) : ?>
            <div class="tp-product-thumb-4 w-img fix">

                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail(); ?>
                </a>

                <!-- product badge -->
                <div class="tp-product-badge-2 ">
                    <?php do_action('edufax_product_badge_action'); ?>
                </div>

                <!-- product action -->
                <div class="tp-product-action-3 tp-product-action-4 has-shadow tp-product-action-blackStyle tp-product-action-brownStyle tp-woo-action tp-woo-action-4">
                    <div class="tp-product-action-item-3 d-flex flex-column">

                        <!-- quick view button -->
                        <?php if (class_exists('WPCleverWoosq')) : ?>
                            <div class="tp-product-action-btn-3 tp-woo-quick-view-btn tp-woo-action-btn">
                                <?php echo do_shortcode('[woosq]'); ?>
                            </div>
                        <?php endif; ?>


                        <?php if (function_exists('woosw_init')) : ?>
                            <!-- wishlist button -->
                            <div class="tp-product-action-btn-3 tp-woo-add-to-wishlist-btn tp-woo-action-btn">
                                <?php echo do_shortcode('[woosw]'); ?>
                            </div>
                        <?php endif; ?>


                        <?php if (function_exists('woosc_init')) : ?>
                            <!-- compare button -->
                            <div class="tp-product-action-btn-3 tp-woo-add-to-compare-btn tp-woo-action-btn">
                                <?php echo do_shortcode('[woosc]'); ?>
                                <span class="tp-product-tooltip tp-woo-tooltip"> <?php echo esc_html__('Add To Compare', 'edufax'); ?></span>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

            </div>
        <?php endif; ?>
        <div class="tp-product-content-4">
            <h3 class="tp-product-title-4">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <div class="tp-product-info-4">
                <?php foreach ($terms as $key => $term) :
                    $count = count($terms) - 1;

                    $name = ($count > $key) ? $term->name . ', ' : $term->name
                ?>
                    <a href="<?php echo get_term_link($term->slug, 'product_cat'); ?> "> <?php echo esc_html($name); ?></a>
                <?php endforeach; ?>
            </div>
            <?php if ($rating_count > 0) : ?>
                <div class="tp-product-rating tp-product-rating-3 d-flex align-items-center <?php echo esc_attr($has_rating); ?>">
                    <div class="tp-product-rating-icon">
                        <?php echo edufax_kses($rating); ?>
                    </div>
                    <div class="tp-product-rating-text">
                        <?php if (comments_open()) : ?>
                            <?php //phpcs:disable 
                            ?>
                            <a href="#reviews" class="woocommerce-review-link" rel="nofollow"><?php printf(_n('( %s Review )', '( %s Reviews )', $review_count, 'edufax'), '<span class="count">' . esc_html($review_count) . '</span>'); ?></a>
                            <?php // phpcs:enable 
                            ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="tp-product-price-inner-4">
                <div class="tp-product-price-wrapper-4 tp-woo-price tp-woo-price-4">
                    <?php echo woocommerce_template_loop_price(); ?>
                </div>

                <div class="tp-product-price-add-to-cart tp-woo-action tp-woo-action-4">
                    <div class="tp-product-add-to-cart-4 tp-woo-add-cart-btn tp-woo-action-btn">
                        <?php woocommerce_template_loop_add_to_cart(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
}
function edufax_product_grid_type_5()
{
    global $product;
    global $post;
    global $woocommerce;
    $rating = wc_get_rating_html($product->get_average_rating());
    $terms = get_the_terms(get_the_ID(), 'product_cat');

    $rating_count = $product->get_rating_count();
    $review_count = $product->get_review_count();
    $average      = $product->get_average_rating();

    $enable_trending_badge = get_theme_mod('enable_trending_badge', false);
    $enable_hot_badge = get_theme_mod('enable_hot_badge', false);

    $is_product_on_trending = function_exists('tpmeta_field') ? tpmeta_field('edufax_product_on_trending') : '';
    $is_product_on_hot = function_exists('tpmeta_field') ? tpmeta_field('edufax_product_on_hot') : '';

    $has_rating = $rating_count > 0 ? 'has-rating' : '';
?>

    <div class="tp-category-item-4 p-relative z-index-1 fix text-center mb-40 black-bg">

        <?php if (has_post_thumbnail()) : ?>
            <div class="tp-category-thumb-4 include-bg black-bg" data-background="<?php the_post_thumbnail_url(); ?>"></div>
        <?php endif; ?>


        <!-- product badge -->
        <div class="tp-product-badge-2 ">
            <?php do_action('edufax_product_badge_action'); ?>
        </div>

        <!-- product action -->
        <div class="tp-product-action-3 tp-product-action-4 tp-product-action-blackStyle tp-product-action-brownStyle tp-woo-action tp-woo-action-4 tp-woo-action-5">
            <div class="tp-product-action-item-3 d-flex flex-column">

                <!-- quick view button -->
                <?php if (class_exists('WPCleverWoosq')) : ?>
                    <div class="tp-product-action-btn-3 tp-woo-quick-view-btn tp-woo-action-btn">
                        <?php echo do_shortcode('[woosq]'); ?>
                    </div>
                <?php endif; ?>


                <?php if (function_exists('woosw_init')) : ?>
                    <!-- wishlist button -->
                    <div class="tp-product-action-btn-3 tp-woo-add-to-wishlist-btn tp-woo-action-btn">
                        <?php echo do_shortcode('[woosw]'); ?>
                    </div>
                <?php endif; ?>


                <?php if (function_exists('woosc_init')) : ?>
                    <!-- compare button -->
                    <div class="tp-product-action-btn-3 tp-woo-add-to-compare-btn tp-woo-action-btn">
                        <?php echo do_shortcode('[woosc]'); ?>
                        <span class="tp-product-tooltip tp-woo-tooltip"> <?php echo esc_html__('Add To Compare', 'edufax'); ?></span>
                    </div>
                <?php endif; ?>

            </div>
        </div>
        <div class="tp-category-content-4">
            <h3 class="tp-category-title-4">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <div class="tp-category-price-wrapper-4 tp-woo-price tp-woo-price-4 tp-woo-price-5">

                <?php echo woocommerce_template_loop_price(); ?>

                <div class="tp-category-add-to-cart ">
                    <div class="tp-category-add-to-cart-4 tp-woo-action tp-woo-action-4 tp-woo-action-5">
                        <div class="tp-woo-add-cart-btn tp-woo-action-btn">
                            <?php woocommerce_template_loop_add_to_cart(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?php
}
function edufax_product_grid_type_6()
{
    global $product;
    global $post;
    global $woocommerce;
    $rating = wc_get_rating_html($product->get_average_rating());
    $terms = get_the_terms(get_the_ID(), 'product_cat');

    $rating_count = $product->get_rating_count();
    $review_count = $product->get_review_count();
    $average      = $product->get_average_rating();

    $enable_trending_badge = get_theme_mod('enable_trending_badge', false);
    $enable_hot_badge = get_theme_mod('enable_hot_badge', false);

    $is_product_on_trending = function_exists('tpmeta_field') ? tpmeta_field('edufax_product_on_trending') : '';
    $is_product_on_hot = function_exists('tpmeta_field') ? tpmeta_field('edufax_product_on_hot') : '';

    $has_rating = $rating_count > 0 ? 'has-rating' : '';
?>


    <div class="tp-product-item-5 p-relative white-bg mb-40">

        <?php if (has_post_thumbnail()) : ?>
            <div class="tp-product-thumb-5 w-img fix mb-15">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail(); ?>
                </a>

                <div class="tp-product-badge-2 tp-product-badge-5 d-flex">
                    <ul class="d-flex">
                        <?php if ($product->is_on_sale()) : ?>
                            <li>
                                <?php woocommerce_show_product_loop_sale_flash(); ?>
                            </li>
                        <?php endif; ?>

                        <?php if (($is_product_on_trending === "on") && $enable_trending_badge) : ?>
                            <li>
                                <span class="onsale on-trending"><?php echo esc_html__('Trending', 'edufax'); ?></span>
                            </li>
                        <?php endif; ?>

                        <?php if (($is_product_on_hot === "on") && $enable_hot_badge) : ?>
                            <li>
                                <span class="onsale on-hot"><?php echo esc_html__('Hot', 'edufax'); ?></span>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- product action -->
                <div class="tp-product-action-2 tp-product-action-5 tp-product-action-greenStyle tp-woo-action tp-woo-action-6">
                    <div class="tp-product-action-item-2 d-flex flex-column">

                        <div class="tp-product-action-btn-2 tp-woo-add-cart-btn tp-woo-action-btn">
                            <?php woocommerce_template_loop_add_to_cart(); ?>
                        </div>
                        <!-- quick view button -->
                        <?php if (class_exists('WPCleverWoosq')) : ?>
                            <div class="tp-product-action-btn-2 tp-woo-quick-view-btn tp-woo-action-btn">
                                <?php echo do_shortcode('[woosq]'); ?>
                            </div>
                        <?php endif; ?>


                        <?php if (function_exists('woosw_init')) : ?>
                            <!-- wishlist button -->
                            <div class="tp-product-action-btn-2 tp-woo-add-to-wishlist-btn tp-woo-action-btn">
                                <?php echo do_shortcode('[woosw]'); ?>
                            </div>
                        <?php endif; ?>


                        <?php if (function_exists('woosc_init')) : ?>
                            <!-- compare button -->
                            <div class="tp-product-action-btn-2 tp-woo-add-to-compare-btn tp-woo-action-btn">
                                <?php echo do_shortcode('[woosc]'); ?>
                                <span class="tp-product-tooltip tp-product-tooltip-right tp-woo-tooltip"> <?php echo esc_html__('Add To Compare', 'edufax'); ?></span>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="tp-product-content-5">
            <div class="tp-product-tag-5">
                <?php foreach ($terms as $key => $term) :
                    $count = count($terms) - 1;

                    $name = ($count > $key) ? $term->name . ', ' : $term->name
                ?>
                    <a href="<?php echo get_term_link($term->slug, 'product_cat'); ?> "> <?php echo esc_html($name); ?></a>
                <?php endforeach; ?>
            </div>

            <h3 class="tp-product-title-5">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>

            <?php if ($rating_count > 0) : ?>
                <div class="tp-product-rating-5">
                    <?php echo edufax_kses($rating); ?>
                </div>
            <?php endif; ?>


            <div class="tp-product-price-wrapper-5 tp-woo-price tp-woo-price-6">
                <?php echo woocommerce_template_loop_price(); ?>
            </div>
        </div>

    </div>

    <?php
}



// wpc function
function tp_smart_functions()
{
    // smart quick view
    add_filter('woosq_button_html', 'edufax_woosq_button_html', 10, 2);
    function edufax_woosq_button_html($output, $prodid)
    {
        $btntext = esc_html__("Quick View", 'edufax');

        $action_layout = get_theme_mod('shop_grid_layout');
        if ($action_layout === "2" ||  $action_layout === "3" || $action_layout === "4" || $action_layout === "5") {
            $tooltip_position = '';
        } else {
            $tooltip_position = 'tp-product-tooltip-right';
        }

        return $output = '<a href="#" class="icon-btn woosq-btn woosq-btn-' . esc_attr($prodid) . ' ' . get_option('woosq_button_class') . '" data-id="' . esc_attr($prodid) . '" data-effect="mfp-3d-unfold">
                <svg width="19" height="16" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.49943 5.34978C8.23592 5.34978 7.20896 6.37595 7.20896 7.63732C7.20896 8.89774 8.23592 9.92296 9.49943 9.92296C10.7629 9.92296 11.7908 8.89774 11.7908 7.63732C11.7908 6.37595 10.7629 5.34978 9.49943 5.34978M9.49941 11.3456C7.45025 11.3456 5.78394 9.68213 5.78394 7.63738C5.78394 5.59169 7.45025 3.92725 9.49941 3.92725C11.5486 3.92725 13.2158 5.59169 13.2158 7.63738C13.2158 9.68213 11.5486 11.3456 9.49941 11.3456" fill="currentColor"/>
                    
                    <path d="M1.49145 7.63683C3.25846 11.5338 6.23484 13.8507 9.50001 13.8517C12.7652 13.8507 15.7416 11.5338 17.5086 7.63683C15.7416 3.7408 12.7652 1.42386 9.50001 1.42291C6.23579 1.42386 3.25846 3.7408 1.49145 7.63683V7.63683ZM9.50173 15.2742H9.49793H9.49698C5.56775 15.2714 2.03943 12.5219 0.0577129 7.91746C-0.0192376 7.73822 -0.0192376 7.53526 0.0577129 7.35601C2.03943 2.75248 5.5687 0.00306822 9.49698 0.000223018C9.49888 -0.000725381 9.49888 -0.000725381 9.49983 0.000223018C9.50173 -0.000725381 9.50173 -0.000725381 9.50268 0.000223018C13.4319 0.00306822 16.9602 2.75248 18.942 7.35601C19.0199 7.53526 19.0199 7.73822 18.942 7.91746C16.9612 12.5219 13.4319 15.2714 9.50268 15.2742H9.50173Z" fill="currentColor"/>

                    </svg>
                    <span class="tp-product-tooltip ' . $tooltip_position . ' tp-woo-tooltip"> ' . $btntext . '</span>
            </a>';
    }

    // smart wishlist
    add_filter('woosw_button_html', 'edufax_woosw_button_html', 10, 3);

    function edufax_woosw_button_html($output, $id, $attrs)
    {

        global $product;
        $product = wc_get_product($id);
        $product_name = $product ? $product->get_name() : '';

        $output = '<button class="woosw-btn woosw-btn-' . $id . '" data-id="' . $id . '" data-product_name="' . esc_attr($product_name) . '"></button>';

        return $output;
    }

    add_filter('woosw_button_text', 'edufax_woosw_button_text', 10, 1);
    function edufax_woosw_button_text($output)
    {
        $btntext = esc_html__("Add To Wishlist", 'edufax');
        $action_layout = get_theme_mod('shop_grid_layout');
        if ($action_layout === "2" ||  $action_layout === "3" || $action_layout === "4" || $action_layout === "5") {
            $tooltip_position = '';
        } else {
            $tooltip_position = 'tp-product-tooltip-right';
        }
        $output = '<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.60355 7.98635C2.83622 11.8048 7.7062 14.8923 9.0004 15.6565C10.299 14.8844 15.2042 11.7628 16.3973 7.98985C17.1806 5.55102 16.4535 2.46177 13.5644 1.53473C12.1647 1.08741 10.532 1.35966 9.40484 2.22804C9.16921 2.40837 8.84214 2.41187 8.60476 2.23329C7.41078 1.33952 5.85105 1.07778 4.42936 1.53473C1.54465 2.4609 0.820172 5.55014 1.60355 7.98635ZM9.00138 17.0711C8.89236 17.0711 8.78421 17.0448 8.68574 16.9914C8.41055 16.8417 1.92808 13.2841 0.348132 8.3872C0.347252 8.3872 0.347252 8.38633 0.347252 8.38633C-0.644504 5.30321 0.459792 1.42874 4.02502 0.284605C5.69904 -0.254635 7.52342 -0.0174044 8.99874 0.909632C10.4283 0.00973263 12.3275 -0.238878 13.9681 0.284605C17.5368 1.43049 18.6446 5.30408 17.6538 8.38633C16.1248 13.2272 9.59485 16.8382 9.3179 16.9896C9.21943 17.0439 9.1104 17.0711 9.00138 17.0711Z" fill="currentColor"></path>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.203 6.67473C13.8627 6.67473 13.5743 6.41474 13.5462 6.07159C13.4882 5.35202 13.0046 4.7445 12.3162 4.52302C11.9689 4.41097 11.779 4.04068 11.8906 3.69666C12.0041 3.35175 12.3724 3.16442 12.7206 3.27297C13.919 3.65901 14.7586 4.71561 14.8615 5.96479C14.8905 6.32632 14.6206 6.64322 14.2575 6.6721C14.239 6.67385 14.2214 6.67473 14.203 6.67473Z" fill="currentColor"></path>
        </svg>
        ' . $btntext . '
        <span class="tp-product-tooltip ' . $tooltip_position . ' tp-woo-tooltip"> ' . $btntext . '</span>
        ';
        return $output;
    }

    add_filter('woosw_button_text_added', 'edufax_woosw_button_text_added', 10, 1);
    function edufax_woosw_button_text_added($output)
    {

        $btntext = esc_html__("View Wishlist", 'edufax');
        $action_layout = get_theme_mod('shop_grid_layout');
        if ($action_layout === "2" ||  $action_layout === "3" || $action_layout === "4" || $action_layout === "5") {
            $tooltip_position = '';
        } else {
            $tooltip_position = 'tp-product-tooltip-right';
        }
        $output = '
            <svg width="19" height="17" viewBox="0 0 19 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.6891 2.32611C16.2738 1.90569 15.7806 1.57219 15.2377 1.34465C14.6949 1.11711 14.1131 1 13.5255 1C12.9379 1 12.3561 1.11711 11.8133 1.34465C11.2704 1.57219 10.7772 1.90569 10.3619 2.32611L9.49978 3.19821L8.63771 2.32611C7.79866 1.4773 6.66066 1.00044 5.47407 1.00044C4.28747 1.00044 3.14947 1.4773 2.31042 2.32611C1.47137 3.17492 1 4.32616 1 5.52656C1 6.72696 1.47137 7.87819 2.31042 8.727L3.1725 9.5991L9.49978 16L15.8271 9.5991L16.6891 8.727C17.1047 8.30679 17.4344 7.80785 17.6593 7.25871C17.8842 6.70957 18 6.12097 18 5.52656C18 4.93214 17.8842 4.34355 17.6593 3.7944C17.4344 3.24526 17.1047 2.74633 16.6891 2.32611Z" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            ' . $btntext . '
            <span class="tp-product-tooltip ' . $tooltip_position . ' tp-woo-tooltip">' . $btntext . '</span>
        ';
        return $output;
    }

    // smart compare functions
    add_filter('woosc_button_htmls', 'edufax_woosc_button_html', 10, 2);
    function edufax_woosc_button_html($output, $id)
    {
        global $product;
        $product = wc_get_product($id);
        $product_name = $product ? $product->get_name() : '';
        $product_image_id = $product->get_image_id();
        $product_image    = wp_get_attachment_image_url($product_image_id);

        $output = '<button class="woosc-btn woosc-btn-' . $id . '" data-id="' . $id . '" data-product_name="' . $product_name . '" data-product_image="' . esc_attr($product_image) . '">
                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.4144 6.16828L14 3.58412L11.4144 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M1.48883 3.58374L14 3.58374" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4.07446 8.32153L1.48884 10.9057L4.07446 13.4898" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14 10.9058H1.48883" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
        </button>';

        return $output;
    }

    add_filter('woosc_button_texts', 'edufax_woosc_button_text', 10, 1);
    function edufax_woosc_button_text($output)
    {
        $btntext = esc_html__("Add To Compare", 'edufax');
        $action_layout = get_theme_mod('shop_grid_layout');
        if ($action_layout === "2" ||  $action_layout === "3" || $action_layout === "4" || $action_layout === "5") {
            $tooltip_position = '';
        } else {
            $tooltip_position = 'tp-product-tooltip-right';
        }
        $output = '
            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.4144 6.16828L14 3.58412L11.4144 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M1.48883 3.58374L14 3.58374" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M4.07446 8.32153L1.48884 10.9057L4.07446 13.4898" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M14 10.9058H1.48883" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>  
            <span class="tp-product-tooltip ' . $tooltip_position . ' tp-woo-tooltip"> ' . $btntext . '</span>
        ';

        return $output;
    }

    add_filter('woosc_button_text_addeds', 'edufax_woosc_button_text_added', 10, 1);

    function edufax_woosc_button_text_added($output)
    {
        $btntext = esc_html__("View Compare", 'edufax');
        $action_layout = get_theme_mod('shop_grid_layout');
        if ($action_layout === "2" ||  $action_layout === "3" || $action_layout === "4" || $action_layout === "5") {
            $tooltip_position = '';
        } else {
            $tooltip_position = 'tp-product-tooltip-right';
        }
        $output = '
            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.4144 6.16828L14 3.58412L11.4144 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M1.48883 3.58374L14 3.58374" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M4.07446 8.32153L1.48884 10.9057L4.07446 13.4898" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M14 10.9058H1.48883" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>  
            <span class="tp-product-tooltip ' . $tooltip_position . ' tp-woo-tooltip"> ' . $btntext . '</span>
        ';
        return $output;
    }
}
tp_smart_functions();

// product-content
if (!function_exists('edufax_content_product_list')) {
    function edufax_content_product_list()
    {
        global $product;
        global $post;
        global $woocommerce;
        $rating = wc_get_rating_html($product->get_average_rating());
        $ratingcount = $product->get_review_count();
        $terms = get_the_terms(get_the_ID(), 'product_cat');

        $enable_trending_badge = get_theme_mod('enable_trending_badge', false);
        $enable_hot_badge = get_theme_mod('enable_hot_badge', false);

        $is_product_on_trending = function_exists('tpmeta_field') ? tpmeta_field('edufax_product_on_trending') : '';
        $is_product_on_hot = function_exists('tpmeta_field') ? tpmeta_field('edufax_product_on_hot') : '';

    ?>


        <div class="tp-product-list-item d-md-flex tp-woo-product-list-item">

            <?php if (has_post_thumbnail()) : ?>
                <div class="tp-product-list-thumb p-relative fix">

                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail(); ?>
                    </a>

                    <!-- badge -->
                    <div class="tp-product-badge-2">

                        <ul class="d-flex">
                            <?php if ($product->is_on_sale()) : ?>
                                <li>
                                    <?php woocommerce_show_product_loop_sale_flash(); ?>
                                </li>
                            <?php endif; ?>

                            <?php if (($is_product_on_trending === "on") && $enable_trending_badge) : ?>
                                <li>
                                    <span class="onsale on-trending"><?php echo esc_html__('Trending', 'edufax'); ?></span>
                                </li>
                            <?php endif; ?>

                            <?php if (($is_product_on_hot === "on") && $enable_hot_badge) : ?>
                                <li>
                                    <span class="onsale on-hot"><?php echo esc_html__('Hot', 'edufax'); ?></span>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <!-- product action -->
                    <div class="tp-product-action-2 tp-product-action-blackStyle tp-woo-action">

                        <div class="tp-product-action-item-2 d-flex flex-column">

                            <!-- quick view button -->
                            <?php if (class_exists('WPCleverWoosq')) : ?>
                                <div class="tp-product-action-btn-2 tp-woo-quick-view-btn tp-woo-action-btn">
                                    <?php echo do_shortcode('[woosq]'); ?>
                                </div>
                            <?php endif; ?>


                            <?php if (function_exists('woosw_init')) : ?>
                                <!-- wishlist button -->
                                <div class="tp-product-action-btn-2 tp-woo-add-to-wishlist-btn tp-woo-action-btn">
                                    <?php echo do_shortcode('[woosw]'); ?>
                                </div>
                            <?php endif; ?>


                            <?php if (function_exists('woosc_init')) : ?>
                                <!-- compare button -->
                                <div class="tp-product-action-btn-2 tp-woo-add-to-compare-btn tp-woo-action-btn">
                                    <?php echo do_shortcode('[woosc]'); ?>
                                    <span class="tp-product-tooltip tp-product-tooltip-right tp-woo-tooltip"> <?php echo esc_html__('Add To Compare', 'edufax'); ?></span>
                                </div>
                            <?php endif; ?>

                        </div>

                    </div>
                </div>
            <?php endif; ?>
            <div class="tp-product-list-content">
                <div class="tp-product-content-2 pt-15">

                    <div class="tp-product-tag-2">
                        <?php foreach ($terms as $key => $term) :
                            $count = count($terms) - 1;

                            $name = ($count > $key) ? $term->name . ', ' : $term->name
                        ?>

                            <a href="<?php echo get_term_link($term->slug, 'product_cat'); ?> "> <?php echo esc_html($name); ?></a>

                        <?php endforeach; ?>
                    </div>

                    <h3 class="tp-product-title-2">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>

                    <div class="tp-product-rating-icon tp-product-rating-icon-2">
                        <?php echo edufax_kses($rating); ?>
                    </div>

                    <div class="tp-product-price-wrapper-2 tp-woo-price">
                        <?php echo woocommerce_template_loop_price(); ?>
                    </div>

                    <?php the_excerpt(); ?>

                    <div class="tp-product-list-add-to-cart tp-woo-add-cart-btn-common">
                        <?php woocommerce_template_loop_add_to_cart(); ?>
                    </div>

                </div>
            </div>
        </div>
    <?php
    }
}
add_action('woocommerce_before_shop_loop_item_list', 'edufax_content_product_list', 10);


// product add to cart button
function woocommerce_template_loop_add_to_cart($args = array())
{
    global $product;

    if ($product) {
        $defaults = array(
            'quantity'   => 1,
            'class'      => implode(
                ' ',
                array_filter(
                    array(
                        'cart-button icon-btn button',
                        'product_type_' . $product->get_type(),
                        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                        $product->supports('ajax_add_to_cart') && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
                    )
                )
            ),
            'attributes' => array(
                'data-product_id'  => $product->get_id(),
                'data-product_sku' => $product->get_sku(),
                'aria-label'       => $product->add_to_cart_description(),
                'rel'              => 'nofollow',
            ),
        );

        $args = wp_parse_args($args, $defaults);

        if (isset($args['attributes']['aria-label'])) {
            $args['attributes']['aria-label'] = wp_strip_all_tags($args['attributes']['aria-label']);
        }
    }


    // check product type 
    if ($product->is_type('simple')) {
        $btntext = esc_html__("Add to Cart", 'edufax');
    } elseif ($product->is_type('variable')) {
        $btntext = esc_html__("Select Options", 'edufax');
    } elseif ($product->is_type('external')) {
        $btntext = esc_html__("Buy Now", 'edufax');
    } elseif ($product->is_type('grouped')) {
        $btntext = esc_html__("View Products", 'edufax');
    } else {
        $btntext = esc_html__("Add to Cart", 'edufax');
    }

    $action_layout = get_theme_mod('shop_grid_layout');
    if ($action_layout === "2" ||  $action_layout === "3" || $action_layout === "4" || $action_layout === "5") {
        $tooltip_position = '';
    } else {
        $tooltip_position = 'tp-product-tooltip-right';
    }

    echo sprintf(
        '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
        esc_url($product->add_to_cart_url()),
        esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
        esc_attr(isset($args['class']) ? $args['class'] : 'tp-product-action-btn-2 tp-product-add-cart-btn cart-button icon-btn button'),
        isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
        '
            <span class="loading-icon">
                <svg class="cart_load_spinning" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 1V4.2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 13.8V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3.34424 3.34399L5.60824 5.60799" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12.3921 12.392L14.6561 14.656" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M1 9H4.2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M13.8003 9H17.0003" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3.34424 14.656L5.60824 12.392" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12.3921 5.60799L14.6561 3.34399" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>

            <svg class="cart-icon-2 tp-woo-d-none" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.76447 1L3.23047 3.541" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M10.2305 1L12.7645 3.541" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M1 5.09507C1 3.80007 1.693 3.69507 2.554 3.69507H13.446C14.307 3.69507 15 3.80007 15 5.09507C15 6.60007 14.307 6.49507 13.446 6.49507H2.554C1.693 6.49507 1 6.60007 1 5.09507Z" stroke="currentColor" stroke-width="1.5"></path>
                <path d="M6.42969 9.3999V11.8849" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                <path d="M9.65234 9.3999V11.8849" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                <path d="M2.05078 6.6001L3.03778 12.6481C3.26178 14.0061 3.80078 15.0001 5.80278 15.0001H10.0238C12.2008 15.0001 12.5228 14.0481 12.7748 12.7321L13.9508 6.6001" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
            </svg>
            
            <svg class="cart-icon" width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.34706 4.53799L3.85961 10.6239C3.89701 11.0923 4.28036 11.4436 4.74871 11.4436H4.75212H14.0265H14.0282C14.4711 11.4436 14.8493 11.1144 14.9122 10.6774L15.7197 5.11162C15.7384 4.97924 15.7053 4.84687 15.6245 4.73995C15.5446 4.63218 15.4273 4.5626 15.2947 4.54393C15.1171 4.55072 7.74498 4.54054 3.34706 4.53799ZM4.74722 12.7162C3.62777 12.7162 2.68001 11.8438 2.58906 10.728L1.81046 1.4837L0.529505 1.26308C0.181854 1.20198 -0.0501969 0.873587 0.00930333 0.526523C0.0705036 0.17946 0.406255 -0.0462578 0.746256 0.00805037L2.51426 0.313534C2.79901 0.363599 3.01576 0.5995 3.04042 0.888012L3.24017 3.26484C15.3748 3.26993 15.4139 3.27587 15.4726 3.28266C15.946 3.3514 16.3625 3.59833 16.6464 3.97849C16.9303 4.35779 17.0493 4.82535 16.9813 5.29376L16.1747 10.8586C16.0225 11.9177 15.1011 12.7162 14.0301 12.7162H14.0259H4.75402H4.74722Z" fill="currentColor"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.6629 7.67446H10.3067C9.95394 7.67446 9.66919 7.38934 9.66919 7.03804C9.66919 6.68673 9.95394 6.40161 10.3067 6.40161H12.6629C13.0148 6.40161 13.3004 6.68673 13.3004 7.03804C13.3004 7.38934 13.0148 7.67446 12.6629 7.67446Z" fill="currentColor"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.38171 15.0212C4.63756 15.0212 4.84411 15.2278 4.84411 15.4836C4.84411 15.7395 4.63756 15.9469 4.38171 15.9469C4.12501 15.9469 3.91846 15.7395 3.91846 15.4836C3.91846 15.2278 4.12501 15.0212 4.38171 15.0212Z" fill="currentColor"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.38082 15.3091C4.28477 15.3091 4.20657 15.3873 4.20657 15.4833C4.20657 15.6763 4.55592 15.6763 4.55592 15.4833C4.55592 15.3873 4.47687 15.3091 4.38082 15.3091ZM4.38067 16.5815C3.77376 16.5815 3.28076 16.0884 3.28076 15.4826C3.28076 14.8767 3.77376 14.3845 4.38067 14.3845C4.98757 14.3845 5.48142 14.8767 5.48142 15.4826C5.48142 16.0884 4.98757 16.5815 4.38067 16.5815Z" fill="currentColor"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9701 15.0212C14.2259 15.0212 14.4333 15.2278 14.4333 15.4836C14.4333 15.7395 14.2259 15.9469 13.9701 15.9469C13.7134 15.9469 13.5068 15.7395 13.5068 15.4836C13.5068 15.2278 13.7134 15.0212 13.9701 15.0212Z" fill="currentColor"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9692 15.3092C13.874 15.3092 13.7958 15.3874 13.7958 15.4835C13.7966 15.6781 14.1451 15.6764 14.1443 15.4835C14.1443 15.3874 14.0652 15.3092 13.9692 15.3092ZM13.969 16.5815C13.3621 16.5815 12.8691 16.0884 12.8691 15.4826C12.8691 14.8767 13.3621 14.3845 13.969 14.3845C14.5768 14.3845 15.0706 14.8767 15.0706 15.4826C15.0706 16.0884 14.5768 16.5815 13.969 16.5815Z" fill="currentColor"/>
            </svg> 
            
            <span class="tp-product-tooltip ' . $tooltip_position . ' tp-woo-tooltip">' . $btntext . '</span>' . $btntext . ' 
        '
    );
}



add_action('wp_footer', 'custom_quantity_fields_script');

// custom_quantity_fields_script
function custom_quantity_fields_script()
{
    ?>
    <script type='text/javascript'>
        jQuery(function($) {
            if (!String.prototype.getDecimals) {
                String.prototype.getDecimals = function() {
                    var num = this,
                        match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                    if (!match) {
                        return 0;
                    }
                    return Math.max(0, (match[1] ? match[1].length : 0) - (match[2] ? +match[2] : 0));
                }
            }
            // Quantity "plus" and "minus" buttons
            $(document.body).on('click', '.plus, .minus', function() {
                var $qty = $(this).closest('.quantity').find('.qty'),
                    currentVal = parseFloat($qty.val()),
                    max = parseFloat($qty.attr('max')),
                    min = parseFloat($qty.attr('min')),
                    step = $qty.attr('step');

                // Format values
                if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
                if (max === '' || max === 'NaN') max = '';
                if (min === '' || min === 'NaN') min = 0;
                if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

                // Change the value
                if ($(this).is('.plus')) {
                    if (max && (currentVal >= max)) {
                        $qty.val(max);
                    } else {
                        $qty.val((currentVal + parseFloat(step)).toFixed(step.getDecimals()));
                    }
                } else {
                    if (min && (currentVal <= min)) {
                        $qty.val(min);
                    } else if (currentVal > 0) {
                        $qty.val((currentVal - parseFloat(step)).toFixed(step.getDecimals()));
                    }
                }

                // Trigger change event
                $qty.trigger('change');
            });


            $('.tp-woo-single-variation .tpwvs-tooltip').on('click', function() {
                $(this).addClass('active-swatch').siblings().removeClass('active-swatch');
            });

            $(document.body).on('click', '.reset_variations', function() {
                $(this).siblings().children().removeClass('active-swatch')
            });

        });
    </script>
<?php
}


// woocommerce_breadcrumb modilfy
if (!function_exists('woocommerce_breadcrumb')) {

    /**
     * Output the WooCommerce Breadcrumb.
     *
     * @param array $args Arguments.
     */
    function woocommerce_breadcrumb($args = array())
    {
        $args = wp_parse_args(
            $args,
            apply_filters(
                'woocommerce_breadcrumb_defaults',
                array(
                    'delimiter'   => '<span class="dvdr"></span>',
                    'wrap_before' => '<nav class="woocommerce-breadcrumb tp-woo-breadcrumb">',
                    'wrap_after'  => '</nav>',
                    'before'      => '',
                    'after'       => '',
                    'home'        => _x('Home', 'breadcrumb', 'edufax'),
                )
            )
        );

        $breadcrumbs = new WC_Breadcrumb();

        if (!empty($args['home'])) {
            $breadcrumbs->add_crumb($args['home'], apply_filters('woocommerce_breadcrumb_home_url', home_url()));
        }

        $args['breadcrumb'] = $breadcrumbs->generate();

        /**
         * WooCommerce Breadcrumb hook
         *
         * @hooked WC_Structured_Data::generate_breadcrumblist_data() - 10
         */
        do_action('woocommerce_breadcrumb', $breadcrumbs, $args);

        wc_get_template('global/breadcrumb.php', $args);
    }
}


function tp_wc_add_buy_now_button_single()
{
    global $product;
    $enable_buy_now = get_theme_mod('edufax_product_single_buy_now_switch', true);
    if ($enable_buy_now) {
        printf('<button id="tp_wc-adding-button" type="submit" name="tp-wc-buy-now" value="%d" class="tp-product-details-buy-now-btn w-100 single_add_to_cart_button buy_now_button button alt">%s</button>', $product->get_ID(), esc_html__('Buy Now', 'edufax'));
    }
}

add_action('woocommerce_after_add_to_cart_button', 'tp_wc_add_buy_now_button_single');



/*** Handle for click on buy now ***/

function tp_wc_handle_buy_now()
{
    if (!isset($_REQUEST['tp-wc-buy-now'])) {
        return false;
    }

    WC()->cart->empty_cart();

    $product_id = absint($_REQUEST['tp-wc-buy-now']);
    $quantity = absint($_REQUEST['quantity']);

    if (isset($_REQUEST['variation_id'])) {

        $variation_id = absint($_REQUEST['variation_id']);
        WC()->cart->add_to_cart($product_id, 1, $variation_id);
    } else {
        WC()->cart->add_to_cart($product_id, $quantity);
    }

    wp_safe_redirect(wc_get_checkout_url());
    exit;
}

add_action('wp_loaded', 'tp_wc_handle_buy_now');
