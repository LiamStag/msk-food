<?php

/**
 * The template for displaying search results pages
 *
 * @subpackage msk-food
 * @since 1.0
 * @version 0.1
 */

get_header(); ?>

<div class="container">

    <header class="page-header">
        <?php if (have_posts()) : ?>
            <h1 class="search-title"><?php /* translators: %s: search term */ printf(esc_html__('Search Results for: %s', 'msk-food'), '<span>' . esc_html(get_search_query()) . '</span>'); ?></h1>
        <?php else : ?>
            <h1 class="page-title"><?php esc_html_e('Nothing Found', 'msk-food'); ?></h1>
        <?php endif; ?>
    </header>

    <div class="content-area">
        <main id="main" class="site-main" role="main">
            <?php
            $supermarket_ecommerce_layout_option = get_theme_mod('supermarket_ecommerce_theme_options', 'Right Sidebar');
            if ($supermarket_ecommerce_layout_option == 'Left Sidebar') { ?>
                <div class="row">
                    <div id="sidebar" class="col-lg-4 col-md-4"><?php dynamic_sidebar('sidebar-1'); ?></div>
                    <div id="" class="content_area col-lg-8 col-md-8">
                        <section id="post_section">
                            <?php
                            if (have_posts()) :
                                /* Start the Loop */
                                while (have_posts()) : the_post();

                                    get_template_part('template-parts/content', get_post_format());

                                endwhile; // End of the loop.

                            else : ?>

                                <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'zz'); ?></p>
                            <?php
                                get_search_form();

                            endif;
                            ?>
                            <div class="navigation">
                                <?php
                                // Previous/next page navigation.
                                the_posts_pagination(array(
                                    'prev_text'          => __('Previous page', 'msk-food'),
                                    'next_text'          => __('Next page', 'msk-food'),
                                    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'msk-food') . ' </span>',
                                ));
                                ?>
                                <div class="clearfix"></div>
                            </div>
                        </section>
                    </div>
                    <div class="clearfix"></div>
                </div>
            <?php } else if ($supermarket_ecommerce_layout_option == 'Right Sidebar') { ?>
                <div class="row">
                    <div id="" class="content_area col-lg-8 col-md-8">
                        <section id="post_section">
                            <?php
                            if (have_posts()) :
                                /* Start the Loop */
                                while (have_posts()) : the_post();

                                    get_template_part('template-parts/content', get_post_format());

                                endwhile; // End of the loop.

                            else : ?>

                                <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'msk-food'); ?></p>
                            <?php
                                get_search_form();

                            endif;
                            ?>
                            <div class="navigation">
                                <?php
                                // Previous/next page navigation.
                                the_posts_pagination(array(
                                    'prev_text'          => __('Previous page', 'msk-food'),
                                    'next_text'          => __('Next page', 'msk-food'),
                                    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'msk-food') . ' </span>',
                                ));
                                ?>
                                <div class="clearfix"></div>
                            </div>
                        </section>
                    </div>
                    <div id="sidebar" class="col-lg-4 col-md-4">
                        <?php dynamic_sidebar('sidebar-2'); ?>
                    </div>
                </div>
            <?php } else if ($supermarket_ecommerce_layout_option == 'One Column') { ?>
                <div id="" class="content_area">
                    <section id="post_section">
                        <?php
                        if (have_posts()) :
                            /* Start the Loop */
                            while (have_posts()) : the_post();

                                get_template_part('template-parts/content', get_post_format());

                            endwhile; // End of the loop.

                        else : ?>

                            <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'msk-food'); ?></p>
                        <?php
                            get_search_form();

                        endif;
                        ?>
                        <div class="navigation">
                            <?php
                            // Previous/next page navigation.
                            the_posts_pagination(array(
                                'prev_text'          => __('Previous page', 'msk-food'),
                                'next_text'          => __('Next page', 'msk-food'),
                                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'msk-food') . ' </span>',
                            ));
                            ?>
                            <div class="clearfix"></div>
                        </div>
                    </section>
                </div>
            <?php } else if ($supermarket_ecommerce_layout_option == 'Three Columns') { ?>
                <div class="row">
                    <div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-1'); ?></div>
                    <div id="" class="content_area col-lg-6 col-md-6">
                        <section id="post_section">
                            <?php
                            if (have_posts()) :
                                /* Start the Loop */
                                while (have_posts()) : the_post();

                                    get_template_part('template-parts/content', get_post_format());

                                endwhile; // End of the loop.

                            else : ?>

                                <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'msk-food'); ?></p>
                            <?php
                                get_search_form();

                            endif;
                            ?>
                            <div class="navigation">
                                <?php
                                // Previous/next page navigation.
                                the_posts_pagination(array(
                                    'prev_text'          => __('Previous page', 'msk-food'),
                                    'next_text'          => __('Next page', 'msk-food'),
                                    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'msk-food') . ' </span>',
                                ));
                                ?>
                                <div class="clearfix"></div>
                            </div>
                        </section>
                    </div>
                    <div id="sidebar" class="col-lg-3 col-md-3">
                        <?php dynamic_sidebar('sidebar-2'); ?>
                    </div>
                </div>
            <?php } else if ($supermarket_ecommerce_layout_option == 'Four Columns') { ?>
                <div class="row">
                    <div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-1'); ?></div>
                    <div id="" class="content_area col-lg-3 col-md-3">
                        <section id="post_section">
                            <?php
                            if (have_posts()) :
                                /* Start the Loop */
                                while (have_posts()) : the_post();

                                    get_template_part('template-parts/content', get_post_format());

                                endwhile; // End of the loop.

                            else : ?>

                                <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'msk-food'); ?></p>
                            <?php
                                get_search_form();

                            endif;
                            ?>
                            <div class="navigation">
                                <?php
                                // Previous/next page navigation.
                                the_posts_pagination(array(
                                    'prev_text'          => __('Previous page', 'msk-food'),
                                    'next_text'          => __('Next page', 'msk-food'),
                                    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'msk-food') . ' </span>',
                                ));
                                ?>
                                <div class="clearfix"></div>
                            </div>
                        </section>
                    </div>
                    <div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-2'); ?></div>
                    <div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-3'); ?></div>
                </div>
            <?php } else if ($supermarket_ecommerce_layout_option == 'Grid Layout') { ?>
                <div class="row">
                    <div id="" class="content_area col-lg-8 col-md-8">
                        <section id="post_section">
                            <div class="row">
                                <?php
                                if (have_posts()) :

                                    /* Start the Loop */
                                    while (have_posts()) : the_post();

                                        get_template_part('template-parts/post/grid-layout');

                                    endwhile; // End of the loop.

                                else : ?>

                                    <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'msk-food'); ?></p>
                                <?php
                                    get_search_form();

                                endif;
                                ?>
                                <div class="navigation">
                                    <?php
                                    // Previous/next page navigation.
                                    the_posts_pagination(array(
                                        'prev_text'          => __('Previous page', 'msk-food'),
                                        'next_text'          => __('Next page', 'msk-food'),
                                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'msk-food') . ' </span>',
                                    ));
                                    ?>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div id="sidebar" class="col-lg-4 col-md-4">
                        <?php dynamic_sidebar('sidebar-1'); ?>
                    </div>
                </div>
            <?php } else { ?>
                <div class="row">
                    <div id="" class="content_area col-lg-8 col-md-8">
                        <section id="post_section">
                            <?php
                            if (have_posts()) :
                                /* Start the Loop */
                                while (have_posts()) : the_post();

                                    get_template_part('template-parts/content', get_post_format());

                                endwhile; // End of the loop.

                            else : ?>

                                <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'msk-food'); ?></p>
                            <?php
                                get_search_form();

                            endif;
                            ?>
                            <div class="navigation">
                                <?php
                                // Previous/next page navigation.
                                the_posts_pagination(array(
                                    'prev_text'          => __('Previous page', 'msk-food'),
                                    'next_text'          => __('Next page', 'msk-food'),
                                    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'msk-food') . ' </span>',
                                ));
                                ?>
                                <div class="clearfix"></div>
                            </div>
                        </section>
                    </div>
                    <div id="sidebar" class="col-lg-4 col-md-4">
                        <?php dynamic_sidebar('sidebar-2'); ?>
                    </div>
                </div>
            <?php } ?>
        </main>
    </div>
</div>

<?php get_footer();
