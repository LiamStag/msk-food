<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * template name: Главная
 * @package msk-food
 */

get_header();
?>

<main id="primary" class="site-main">




    <div class="container">

        <div class="row">
            <div class="banner__home d-none">
                <?php
                $loop = new WP_Query(array(
                    'post_type' => 'slider',

                    'posts_per_page' => 8,
                    'orderby' => 'date',
                    'order' => 'ASC',
                ));

                while ($loop->have_posts()) : $loop->the_post(); ?>

                    <div class="col-md-12">
                        <img src="<?php echo get_field('izobrazhenie_slajdera'); ?>" alt="" class="img-slid__desk">
                    </div>




                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </div>



    <?php
    $featured_posts = get_field('rekomenduemye_tovary');

    if ($featured_posts) : ?>
        <div class="container">
            <div class="row">
                <div class="home__block-name">
                    <p>Рекомендуем</p>
                </div>
            </div>
            <div class="row">
                <div class="home-product__slider d-none">


                    <?php foreach ($featured_posts as $post) :

                        // Setup this post for WP functions (variable must be named $post).
                        setup_postdata($post);
                        wc_get_template_part('content', 'product-home');
                    ?>

                    <?php endforeach; ?>

                    <?php
                    // Reset the global post object so that the rest of the page works correctly.
                    wp_reset_postdata(); ?>
                <?php endif; ?>
                </div>

            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="home__block-name margin-top-30">
                        <p>Категории</p>
                    </div>
                </div>
            </div>
            <div class="row home__list-cat">
                <?php
                $args = array(
                    'taxonomy' => 'product_cat',
                    'hide_empty' => true,
                );
                $product_categories = get_terms($args);

                $count = count($product_categories);

                if ($count > 0) {
                    foreach ($product_categories as $product_category) {
                        $thumbnail_id = get_term_meta($product_category->term_id, 'thumbnail_id', true); ?>
                        <div class="col-md-3 home__cat">

                            <div class="home__cat-img">
                                <a href="<?php echo get_term_link($product_category); ?>"><img src="<?php echo wp_get_attachment_url($thumbnail_id); ?>" alt=""></a>
                            </div>

                            <div class="home__cat-name">
                                <a href="<?php echo get_term_link($product_category); ?>" title="<?php echo $product_category->name; ?> ">
                                    <p> <?php echo $product_category->name; ?> </p>
                                </a>
                            </div>




                        </div>

                <?php
                    }
                }
                ?>

            </div>
            <div class="row">
                <div class="home__cat-list--togle">
                    <p>показать ещё</p>
                    <p>Скрыть категории</p>
                </div>
            </div>
        </div>
</main><!-- #main -->


<?php

get_footer();
