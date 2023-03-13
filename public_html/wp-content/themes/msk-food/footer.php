<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package msk-food
 */
?>
<div class="rightcart">


</div>
<footer id="colophon" class="site-footer">
    <div class="site-info">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="footer__logo">
                        <a href="<?php echo get_site_url(); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/logo-footer.png" alt="">
                        </a>
                    </div>
                    <div class="footer__socials">
                        <p>Мы в соцсетях</p>
                        <div class="footer__socials-icons df">

                            <a href="#">
                                <div class="footer__socials-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/telegram1.svg" alt="">
                                </div>
                            </a>
                            <a href="#">
                                <div class="footer__socials-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/facebook1.svg" alt="">
                                </div>
                            </a>
                            <a href="#">
                                <div class="footer__socials-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/instagram1.svg" alt="">
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="footer__trademark">
                        <p>
                            тм 2022 ООО "МСК-ФУД"
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <p><a href="#">О магазине</a></p>
                    <p><a href="#">Оплата заказов</a></p>
                    <p><a href="#">Условия доставки</a></p>
                </div>
                <div class="col-md-3">
                    <p><a href="#">Пользовательское соглашение</a></p>
                    <p><a href="#">Контакты</a></p>
                </div>
                <div class="col-md-3">
                    <div class="footer__contacts">
                        <p>Свяжитесь с нами</p>
                        <p><a href="mailto:info@msk-food.ru">info@msk-food.ru</a></p>
                        <p>Служба поддержки:</p>
                        <p><a href="tel:+780077000259">8 800 770-02-59</a></p>
                        <p>Круглосуточно, звонок бесплатный</p>
                    </div>
                    <!-- <div class="footer__check">
					<p><a href="#">Проверить статус заказа</a></p>
				</div> -->
                </div>
            </div>
        </div>

    </div><!-- .site-info -->
</footer><!-- #colophon -->
<a class="button__to-top"></a>


<div class="list-category__left">

    <?php
    $terms = get_terms('product_cat');

    if ($terms) { ?>
        <div class="product-cats">
            <div class="list-category__title">
                <p>
                    категории товаров
                </p>
            </div>
            <div class="list-category__left--close"></div>
            <?php
            get_search_form();
            ?>
            <?php foreach ($terms as $term) { ?>
                <div class="category">


                    <a href="<?php echo esc_url(get_term_link($term)) ?>" class="<?php echo $term->slug ?>">
                        <?php echo $term->name; ?>
                    </a>

                </div>
            <?php } ?>
        </div>
    <?php } ?>




</div>



</div><!-- #page -->



<?php wp_footer(); ?>

</body>

</html>
