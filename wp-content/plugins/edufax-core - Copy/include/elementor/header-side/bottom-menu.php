<div id="tp-bottom-menu-sticky" class="tp-mobile-menu d-lg-none">
    <div class="container">
        <div class="row row-cols-5">
            <?php if(class_exists('WooCommerce')) :?>
            <div class="col">
                <div class="tp-mobile-item text-center">
                    <a href="<?php echo esc_url(get_permalink(get_option( 'woocommerce_shop_page_id' ))); ?>" class="tp-mobile-item-btn">
                    <i class="shofyicon-store"></i>
                    <span><?php echo esc_html__('Store', 'tpcore'); ?></span>
                    </a>
                </div>
            </div>
            <?php endif; ?>
            <div class="col">
                <div class="tp-mobile-item text-center">
                    <button class="tp-mobile-item-btn tp-search-open-btn">
                    <i class="shofyicon-magnifying-glass"></i>
                    <span><?php echo esc_html__('Search', 'tpcore'); ?></span>
                    </button>
                </div>
            </div>

            <?php if(class_exists( 'WPCleverWoosw' )) :
                $wishlist_data = new WPCleverWoosw();

                $key        = $wishlist_data::get_key();
                $products   = $wishlist_data::get_ids( $key );
                $count      = count( $products );
            ?>
            <div class="col">
                <div class="tp-mobile-item text-center">
                    <a href="<?php echo esc_url( $wishlist_data::get_url( $key, true ) ); ?>" class="tp-mobile-item-btn">
                    <i class="shofyicon-heart"></i>
                    <span><?php echo esc_html__('Wishlist', 'tpcore'); ?></span>
                    </a>
                </div>
            </div>
            <?php endif; ?>

            <?php if(class_exists('WooCommerce')) :?>
            <div class="col">
                <div class="tp-mobile-item text-center">
                    <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="tp-mobile-item-btn">
                    <i class="shofyicon-user"></i>
                    <span><?php echo esc_html__('Account', 'tpcore'); ?></span>
                    </a>
                </div>
            </div>
            <?php endif; ?>
            <div class="col">
                <div class="tp-mobile-item text-center">
                    <button class="tp-mobile-item-btn tp-offcanvas-open-btn">
                    <i class="shofyicon-menu-1"></i>
                    <span><?php echo esc_html__('Menu', 'tpcore'); ?></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>