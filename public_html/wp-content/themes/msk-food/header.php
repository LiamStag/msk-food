<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package msk-food
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <header id="masthead" class="site-header">
            <div class="topbar">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="topbar__left">
                                <div class="site-branding">
                                    <?php
                                    the_custom_logo();
                                    if (is_front_page() && is_home()) :
                                    ?>
                                        <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                                    <?php
                                    endif;
                                    ?>
                                </div><!-- .site-branding -->
                                <div class="location__only-msk df"><img src="<?php echo get_template_directory_uri(); ?>/img/place.svg" alt="">
                                    <p>Москва</p>
                                </div>
                                <div class="top-bar__phone df"><img src="<?php echo get_template_directory_uri(); ?>/img/phone.svg" alt=""><a href="tel:88007700259" class="phone">8 800 770-02-59</a></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="right-sidebar">
                                <nav id="site-navigation" class="main-navigation">
                                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Primary Menu', 'msk-food'); ?></button>
                                    <?php
                                    wp_nav_menu(
                                        array(
                                            'theme_location' => 'menu-1',
                                            'menu_id'        => 'primary-menu',
                                        )
                                    );
                                    ?>
                                </nav><!-- #site-navigation -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='scrolling'>
                <div class="container">
                    <div class="row" style="justify-content: space-between;">
                        <div class="col-md-4">
                            <div class="header__logo-catalog df">

                                <div class="header__catalog">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/burger.svg" alt="">
                                    <p>Каталог</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="header__cart--popup">
                                <div class="s-header__basket-wr df woocommerce">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/cart.svg" alt="">
                                    <?php
                                    global $woocommerce; ?>
                                    <a href="<?php echo wc_get_cart_url(); ?>" class="basket-btn basket-btn_fixed-xs">
                                        <!-- <span class="basket-btn__label">Корзина</span> -->

                                        <span class="basket-btn__counter">
                                            <?php if ($woocommerce->cart->cart_contents_count > 0) {
                                                echo "(" . sprintf($woocommerce->cart->cart_contents_count) . ")";
                                            }
                                            ?>
                                        </span>

                                    </a>
                                    <div class="header__mini-cart">
                                        <div class="header__mini-cart--body">
                                            <?php woocommerce_mini_cart(); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="header__popup">
                                    <a href="" class="header__popup-link gallery">Обратный&nbsp;звонок</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($woocommerce->cart->cart_contents_total > 0) : ?>

                <div class="content-basket">
                    <div class="content-basket_in js-basket-open">
                        <div class="basket__left">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/cart.svg" alt="">
                        </div>
                        <div class="basket__right">
                            <span class="basket-btn__total">

                                <?php
                                echo sprintf($woocommerce->cart->cart_contents_total);
                                ?>
                                <i class="rubl">₽</i>
                            </span>
                        </div>
                    </div>
                    <div class="header__mini-cart content-basket">
                        <h5>В вашей корзине:</h5>
                        <div class="header__mini-cart--body">
                            <?php woocommerce_mini_cart(['list_class' => 'content-basket_drop']);
                            ?>
                        </div>

                    </div>
                </div>

            <?php endif; ?>
        </header><!-- #masthead -->
