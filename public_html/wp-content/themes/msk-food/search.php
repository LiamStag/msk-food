<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package msk-food
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php if (have_posts()) : ?>
        <div class="container">
            <header class="page-header">
                <h1 class="page-title">
                    <?php
                    /* translators: %s: search query. */
                    printf(esc_html__('Результаты поиска: %s', 'msk-food'), '<span>' . get_search_query() . '</span>');
                    ?>
                </h1>
            </header><!-- .page-header -->
            <div class="row">
                <div class="home-product__slider d-none">
                    <?php
                    /* Start the Loop */
                    while (have_posts()) :
                        the_post();

                        /**
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        wc_get_template_part('content', 'product-home');

                    endwhile;
                    ?>
                </div>
            </div>
        <?php
        the_posts_pagination(array(
            'show_all'     => false, // показаны все страницы участвующие в пагинации
            'end_size'     => 1,     // количество страниц на концах
            'mid_size'     => 1,     // количество страниц вокруг текущей
            'prev_next'    => true,  // выводить ли боковые ссылки "предыдущая/следующая страница".
            'add_args'     => false, // Массив аргументов (переменных запроса), которые нужно добавить к ссылкам.
            'screen_reader_text' => __('Posts navigation'),
            'class'        => 'pagination', // CSS класс, добавлено в 5.5.0.
        ));

    else :

        get_template_part('template-parts/content', 'none');
        get_sidebar();

    endif;
        ?>
        </div>

</main><!-- #main -->

<?php
get_footer();
