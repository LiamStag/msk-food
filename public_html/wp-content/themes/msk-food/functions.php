<?php
// add_action('init', 'stop_heartbeat', 1);
// function stop_heartbeat()
// {
// 	wp_deregister_script('heartbeat');
// }


/**
 * Disable the emoji's
 */
function disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
    add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
}
add_action('init', 'disable_emojis');

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param array $plugins
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch($urls, $relation_type)
{
    if ('dns-prefetch' == $relation_type) {
        /** This filter is documented in wp-includes/formatting.php */
        $emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');

        $urls = array_diff($urls, array($emoji_svg_url));
    }

    return $urls;
}
/**
 * msk-food functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package msk-food
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function msk_food_setup()
{
    /*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on msk-food, use a find and replace
		* to change 'msk-food' to the name of your theme in all the template files.
		*/
    load_theme_textdomain('msk-food', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
    add_theme_support('title-tag');

    /*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'menu-1' => esc_html__('Primary', 'msk-food'),
        )
    );

    /*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'msk_food_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );
}
add_action('after_setup_theme', 'msk_food_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function msk_food_content_width()
{
    $GLOBALS['content_width'] = apply_filters('msk_food_content_width', 640);
}
add_action('after_setup_theme', 'msk_food_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function msk_food_widgets_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'msk-food'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'msk-food'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'msk_food_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function msk_food_scripts()
{
    wp_enqueue_style('msk-food-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_enqueue_style('bootstrap-reboot', get_template_directory_uri() . '/css/bootstrap-reboot.min.css', array(), _S_VERSION);
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), _S_VERSION);
    wp_enqueue_style('custom', get_template_directory_uri() . '/css/custom.css', array(), _S_VERSION);
    wp_enqueue_style('slick', get_template_directory_uri() . '/css/slick.css', array(), _S_VERSION);
    wp_enqueue_style('slick-theme', get_template_directory_uri() . '/css/slick-theme.css', array(), _S_VERSION);
    wp_enqueue_style('jquery.fancybox', get_template_directory_uri() . '/css/jquery.fancybox.css', array(), _S_VERSION);
    wp_enqueue_style('image-zoom', get_template_directory_uri() . '/css/image-zoom.css', array(), _S_VERSION);
    wp_style_add_data('msk-food-style', 'rtl', 'replace');

    wp_enqueue_script('msk-food-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
    wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), _S_VERSION, true);
    wp_enqueue_script('imagesloaded', get_template_directory_uri() . '/js/imagesloaded.min.js', array(), _S_VERSION, true);
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), _S_VERSION, true);
    wp_enqueue_script('slick-js', get_template_directory_uri() . '/js/slick.min.js', array(), _S_VERSION, true);
    wp_enqueue_script('jquery.fancybox-js', get_template_directory_uri() . '/js/jquery.fancybox.js', array(), _S_VERSION, true);
    wp_enqueue_script('image-zoom-js', get_template_directory_uri() . '/js/image-zoom.js', array(), _S_VERSION, true);

    wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/custom-script.js', array(), _S_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'msk_food_scripts');

function add_async_attribute($tag, $handle)
{
    if ('jquery' !== $handle)
        return $tag;
    return str_replace(' src', ' async="async" src', $tag);
}
add_filter('script_loader_tag', 'add_async_attribute', 10, 2);

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
    require get_template_directory() . '/inc/woocommerce.php';
}





add_filter('woocommerce_add_to_cart_fragments', 'header_add_to_cart_fragment');

function header_add_to_cart_fragment($fragments)
{
    global $woocommerce;
    ob_start();
?>
    <span class="basket-btn__counter">
        <?php if ($woocommerce->cart->cart_contents_count > 0) {
            echo "(" . sprintf($woocommerce->cart->cart_contents_count) . ")";
        }
        ?>
    </span>
    <?php
    $fragments['.basket-btn__counter'] = ob_get_clean();
    return $fragments;
}
/*
add_filter('woocommerce_add_to_cart_fragments', 'header_add_to_cart_fragment');

function header_add_to_cart_fragment($fragments)
{
    global $woocommerce;
    ob_start();
    if ($woocommerce->cart->cart_contents_count > 0) : ?>

        <a href="<?php echo wc_get_cart_url(); ?>" class="mini-basket">
            <div class="content-basket_in js-basket-open">

                <div class="basket__left">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/cart.svg" alt="">
                </div>
                <div class="basket__right">
                    <span class="basket-btn__total">
                        <?php echo sprintf($woocommerce->cart->cart_contents_total); ?>
                        <i class="rubl">₽</i>
                    </span>
                </div>

            </div>
        </a>


    <?php endif;

    $fragments['.content-basket_in'] = ob_get_clean();
    return $fragments;
}
*/
//favorite posts array
function favorite_id_array()
{
    if (!empty($_COOKIE['favorite_post_ids'])) {
        return explode(',', $_COOKIE['favorite_post_ids']);
    } else {
        return array();
    }
}



//add to favorite function
function add_favorite()
{
    $post_id = (int)$_POST['post_id'];
    if (!empty($post_id)) {
        $new_post_id = array(
            $post_id
        );
        $post_ids = array_merge($new_post_id, favorite_id_array());
        $post_ids = array_diff($post_ids, array(
            ''
        ));
        $post_ids = array_unique($post_ids);
        setcookie('favorite_post_ids', implode(',', $post_ids), time() + 3600 * 24 * 365, '/');
        echo count($post_ids);
    }
    die();
}
add_action('wp_ajax_favorite', 'add_favorite');
add_action('wp_ajax_nopriv_favorite', 'add_favorite');



//delete from favorite function
function delete_favorite()
{
    $post_id = (int)$_POST['post_id'];
    if (!empty($post_id)) {
        $favorite_id_array = favorite_id_array();
        if (($delete_post_id = array_search($post_id, $favorite_id_array)) !== false) {
            unset($favorite_id_array[$delete_post_id]);
        }
        setcookie('favorite_post_ids', implode(',', $favorite_id_array), time() + 3600 * 24 * 30, '/');
        echo count($favorite_id_array);
    }
    die();
}
add_action('wp_ajax_delfavorite', 'delete_favorite');
add_action('wp_ajax_nopriv_delfavorite', 'delete_favorite');

add_action('woocommerce_sale_flash', 'pancode_echo_sale_percent');

/**
 * Echo discount percent badge html.
 *
 * @param string $html Default sale html.
 *
 * @return string
 */
function pancode_echo_sale_percent($html)
{
    global $product;

    /**
     * @var WC_Product $product
     */

    $regular_max = 0;
    $sale_min    = 0;
    $discount    = 0;

    if ('variable' === $product->get_type()) {
        $prices      = $product->get_variation_prices();
        $regular_max = max($prices['regular_price']);
        $sale_min    = min($prices['sale_price']);
    } else {
        $regular_max = $product->get_regular_price();
        $sale_min    = $product->get_sale_price();
    }

    if (!$regular_max && $product instanceof WC_Product_Bundle) {
        $bndl_price_data = $product->get_bundle_price_data();
        $regular_max     = max($bndl_price_data['regular_prices']);
        $sale_min        = max($bndl_price_data['prices']);
    }

    if (floatval($regular_max)) {
        $discount = round(100 * ($regular_max - $sale_min) / $regular_max);
    }

    return '<span class="onsale">-&nbsp;' . esc_html($discount) . '%</span>';
}

add_action('after_setup_theme', 'mywoo_add_woocommerce_support');
function mywoo_add_woocommerce_support()
{
    add_theme_support('woocommerce');
}

add_action('init', 'register_post_types');
function register_post_types()
{
    register_post_type('slider', [
        'label'  => null,
        'labels' => [
            'name'               => 'Слайдер', // основное название для типа записи
            'singular_name'      => 'Слайд', // название для одной записи этого типа
            'add_new'            => 'Добавить слайд', // для добавления новой записи
            'add_new_item'       => 'Добавление слайда', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактирование слайда', // для редактирования типа записи
            'new_item'           => 'Новый слайд', // текст новой записи
            'view_item'          => 'Смотреть слайд', // для просмотра записи этого типа.
            'search_items'       => 'Искать слайд', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Слайдер', // название меню
        ],
        'description'         => '',
        'public'              => false,
        'publicly_queryable'  => null, // зависит от public
        'exclude_from_search' => null, // зависит от public
        'show_ui'             => true, // зависит от public
        'show_in_nav_menus'   => null, // зависит от public
        'show_in_menu'        => null, // показывать ли в меню адмнки
        // 'show_in_admin_bar'   => null, // зависит от show_in_menu
        'show_in_rest'        => null, // добавить в REST API. C WP 4.7
        'rest_base'           => null, // $post_type. C WP 4.7
        'menu_position'       => 4,
        'menu_icon'           => null,
        //'capability_type'   => 'post',
        //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
        //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
        'hierarchical'        => false,
        'supports'            => ['title', 'custom-fields', 'revisions', 'page-attributes', 'post-formats'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'taxonomies'          => [],
        'has_archive'         => false,
        'rewrite'             => true,
        'query_var'           => true,
    ]);
}


add_theme_support('category-thumbnails');



function get_categories_product($categories_list = "")
{

    $get_categories_product = get_terms("product_cat", [
        "orderby" => "name", // Тип сортировки
        "order" => "ASC", // Направление сортировки
        "hide_empty" => 1, // Скрывать пустые. 1 - да, 0 - нет.
    ]);

    if (count($get_categories_product) > 0) {

        $categories_list = '<ul class="main_categories_list">';

        foreach ($get_categories_product as $categories_item) {
            var_dump($categories_item);
            $categories_list .= '<li><a href="' . esc_url(get_term_link((int)$categories_item->term_id)) . '">' . esc_html($categories_item->name) . '</a></li>';
        }

        $categories_list .= '</ul>';
    }

    return $categories_list;
}

add_action('wp_ajax_ql_woocommerce_ajax_add_to_cart', 'ql_woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_ql_woocommerce_ajax_add_to_cart', 'ql_woocommerce_ajax_add_to_cart');
function ql_woocommerce_ajax_add_to_cart()
{
    $product_id        = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $product           = wc_get_product($product_id);
    $quantity          = empty($_POST['quantity']) ? 1 : wc_stock_amount(wp_unslash($_POST['quantity']));
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status    = get_post_status($product_id);
    $variation_id      = $_POST['variation_id'];
    $variation         = array();

    if ($product && 'variation' === $product->get_type()) {
        $variation_id = $product_id;
        $product_id   = $product->get_parent_id();
        $variation    = $WC_Product_Variable->get_variation_attributes();;
    }

    if ($passed_validation && false !== WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variation) && 'publish' === $product_status) {

        do_action('woocommerce_ajax_added_to_cart', $product_id);

        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }

        WC_AJAX::get_refreshed_fragments();
        $data = array(
            'var1'       => $variation_id,
            'var2' => $variation,
        );

        wp_send_json($data);
    } else {

        // If there was an error adding to the cart, redirect to the product page to show any errors.
        $data = array(
            'error'       => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id),
        );

        wp_send_json($data);
    }
    wp_die();
}



add_filter('woocommerce_checkout_fields', 'quadlayers_remove_checkout_fields');

function quadlayers_remove_checkout_fields($fields)
{

    unset($fields['billing']['billing_company']);

    unset($fields['billing']['billing_postcode']);

    unset($fields['billing']['billing_state']);


    $fields['billing']['billing_email']['class'] = array('form-row-first');
    $fields['billing']['billing_phone']['class'] = array('form-row-last');

    return $fields;
}


add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');
function custom_override_checkout_fields($fields)
{
    array_push($fields['billing']['billing_country']['class'], "d-none"); // Добавляем класс для скрытия поля.
    return $fields;
}

add_filter("woocommerce_checkout_fields", "my_order_fields", 1);

function my_order_fields($fields)
{

    $fields['billing']['billing_first_name']['priority'] = 10;
    $fields['billing']['billing_last_name']['priority'] = 20;
    $fields['billing']['billing_email']['priority'] = 30;
    $fields['billing']['billing_phone']['priority'] = 40;
    $fields['billing']['billing_city']['priority'] = 50;
    $fields['billing']['billing_address_1']['priority'] = 60;
    $fields['billing']['billing_address_2']['priority'] = 70;

    $fields['billing']['billing_first_name']['placeholder'] = __('Имя', 'woocommerce');
    $fields['billing']['billing_last_name']['placeholder'] = __('Фамилия', 'woocommerce');
    $fields['billing']['billing_email']['placeholder'] = __('example@mail.ru', 'woocommerce');
    $fields['billing']['billing_phone']['placeholder'] = __('+7 (900) 000-00-00', 'woocommerce');
    return $fields;
}

function delshipping_calc_in_cart($show_shipping)
{
    if (is_cart()) {
        return false;
    }
    return $show_shipping;
}
add_filter('woocommerce_cart_ready_to_calc_shipping', 'delshipping_calc_in_cart', 99);


add_filter('woocommerce_default_address_fields', 'misha_email_first');

function misha_email_first($address_fields)
{
    // as you can see, no needs to specify a field group anymore
    $address_fields['city']['priority'] = 50;


    return $address_fields;
}

add_filter('woocommerce_default_address_fields', 'custom_woocommerce_default_address_fields', 20);
function custom_woocommerce_default_address_fields($fields)
{
    $fields['address_1']['class'][0] = 'form-row-first';
    $fields['address_2']['class'][0] = 'form-row-last';

    return $fields;
}

add_filter('woocommerce_default_address_fields', 'override_default_address_fields');
function override_default_address_fields($address_fields)
{
    $address_fields['city']['label'] = 'Город';

    return $address_fields;
}

add_filter('woocommerce_default_address_fields', 'custom_override_default_checkout_fields', 10, 1);
function custom_override_default_checkout_fields($address_fields)
{
    $address_fields['city']['placeholder'] = __('Название населенного пункта', 'woocommerce');
    $address_fields['address_2']['placeholder'] = __('Номер квартиры или офиса', 'woocommerce');
    $address_fields['address_2']['label'] = __('Квартира (офис)', 'woocommerce');
    $address_fields['address_2']['label_class'] = array(); // No label class

    return $address_fields;
}

add_filter('woocommerce_form_field', 'elex_remove_checkout_optional_text', 10, 4);
function elex_remove_checkout_optional_text($field, $key, $args, $value)
{
    if (is_checkout() && !is_wc_endpoint_url()) {
        $optional = '&nbsp;<span class="optional">(' . esc_html__('optional', 'woocommerce') . ')</span>';
        $field = str_replace($optional, '', $field);
    }
    return $field;
}

add_filter('woocommerce_form_field', 'replace_checkout_optional_by_required', 10, 4);
function replace_checkout_optional_by_required($field, $key, $args, $value)
{
    // Only on checkout page for postcode field
    if (is_checkout() && !is_wc_endpoint_url() && in_array($key, ['billing_postcode', 'shipping_postcode'])) {
        $optional = '<span class="optional">(' . esc_html__('optional', 'woocommerce') . ')</span>';
        $required = '<abbr class="required" title="required">*</abbr>';
        $field = str_replace($optional, $required, $field);
    }
    return $field;
}

add_filter('custom_woocommerce_default_address_fields', 'remove_checkout_optional_fields_label', 10, 4);
function remove_checkout_optional_fields_label($field)
{
    // Only on checkout page
    if (is_checkout() && !is_wc_endpoint_url()) {
        $optional = '<span class="optional">(' . esc_html__('optional', 'woocommerce') . ')</span>';
        $field = str_replace($optional, '', $field);
    }
    return $field;
}

/**
 * Moving the payments
 */
add_action('woocommerce_before_order_notes', 'my_custom_display_payments', 20);

/**
 * Displaying the Payment Gateways
 */
function my_custom_display_payments()
{
    if (WC()->cart->needs_payment()) {
        $available_gateways = WC()->payment_gateways()->get_available_payment_gateways();
        WC()->payment_gateways()->set_current_gateway($available_gateways);
    } else {
        $available_gateways = array();
    }
    ?>
    <div id="checkout_payments">
        <h3><?php esc_html_e('Способ оплаты:', 'woocommerce'); ?></h3>
        <?php if (WC()->cart->needs_payment()) : ?>
            <ul class="wc_payment_methods payment_methods methods">
                <?php
                if (!empty($available_gateways)) {
                    foreach ($available_gateways as $gateway) {
                        wc_get_template('checkout/payment-method.php', array('gateway' => $gateway));
                    }
                } else {
                    echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters('woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__('Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce') : esc_html__('Please fill in your details above to see available payment methods.', 'woocommerce')) . '</li>'; // @codingStandardsIgnoreLine
                }
                ?>
            </ul>
        <?php endif; ?>
    </div>
<?php
}

/**
 * Adding the payment fragment to the WC order review AJAX response
 */
add_filter('woocommerce_update_order_review_fragments', 'my_custom_payment_fragment');

/**
 * Adding our payment gateways to the fragment #checkout_payments so that this HTML is replaced with the updated one.
 */
function my_custom_payment_fragment($fragments)
{
    ob_start();

    my_custom_display_payments();

    $html = ob_get_clean();

    $fragments['#checkout_payments'] = $html;

    return $fragments;
}

add_filter('woocommerce_shipping_package_name', 'custom_shipping_package_name');
function custom_shipping_package_name($name)
{
    return '<h3>Способ доставки:</h3>';
}

add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {

    ob_start();
?>

    <div class="header__mini-cart">
        <?php woocommerce_mini_cart(); ?>
    </div>

<?php $fragments['div.header__mini-cart'] = ob_get_clean();

    return $fragments;
});

add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {

    ob_start();
?>


    <p class="woocommerce-mini-cart__total total">
        <?php
        /**
         * Hook: woocommerce_widget_shopping_cart_total.
         *
         * @hooked woocommerce_widget_shopping_cart_subtotal - 10
         */
        do_action('woocommerce_widget_shopping_cart_total');
        ?>
    </p>



<?php $fragments['p.woocommerce-mini-cart__total'] = ob_get_clean();

    return $fragments;
});

add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    global $woocommerce;
    ob_start();

?>

    <div class="rightcart">
        <div class="rightcart__header">
            <h2>ВАША КОРЗИНА</h2>
            <div class="rightcart__header--close">

            </div>
        </div>
        <div class="rightcart__body">
            <ul class="woocommerce-mini-cart cart_list product_list_widget rightcart__ul">
                <?php
                do_action('woocommerce_before_mini_cart_contents');
                foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                    $_product     = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                    $product_id   = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                    if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
                        $product_name      = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
                        $product_name      =  explode("–", $product_name);
                        $product_name      =  $product_name[0];
                        $thumbnail         = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
                        $product_price     = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
                        $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                ?>
                        <li id="<?php echo $cart_item_key; ?>" class="woocommerce-mini-cart-item <?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key)); ?>">
                            <?php
                            echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                'woocommerce_cart_item_remove_link',
                                sprintf(
                                    '<a href="%s" class="remove remove_from_cart_but" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
                                    esc_url(wc_get_cart_remove_url($cart_item_key)),
                                    esc_attr__('Remove this item', 'woocommerce'),
                                    esc_attr($product_id),
                                    esc_attr($cart_item_key),
                                    esc_attr($_product->get_sku())
                                ),
                                $cart_item_key
                            );
                            ?>
                            <?php if (empty($product_permalink)) : ?>
                                <?php echo $thumbnail; ?>
                                <div class="rightcart__body--product-name">
                                    <p><?php echo $product_name; ?></p>
                                </div>

                            <?php else : ?>
                                <a href="<?php echo esc_url($product_permalink); ?>">
                                    <?php echo $thumbnail; ?>
                                </a>
                                <div class="rightcart__body--product-name">
                                    <a href="<?php echo esc_url($product_permalink); ?>">
                                        <p><?php echo $product_name; ?></p>
                                    </a>
                                </div>

                            <?php endif ?>

                            <?php echo wc_get_formatted_cart_item_data($cart_item); ?>

                            <div class="sp-quantity">
                                <div class="sp-minus fff">
                                    <div class="ddd">-</div>
                                </div>
                                <div class="sp-input">
                                    <input type='text' value="<?php echo $cart_item['quantity']; ?>" name="qty[]" product_price="<?php echo $_product->get_price(); ?>" key="<?php echo $cart_item_key; ?>" class="qtyval quntity-input">
                                </div>
                                <div class="sp-plus fff">
                                    <div class="ddd">+</div>
                                </div>
                            </div>

                            <div class="priceintable">
                                <?php
                                echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                ?>
                            </div>
                        </li>
                <?php
                    }
                }
                do_action('woocommerce_mini_cart_contents');
                ?>
            </ul>

        </div>
        <div class="rightcart__footer">
            <p class="woocommerce-mini-cart__total total">
                <?php
                /**
                 * Hook: woocommerce_widget_shopping_cart_total.
                 *
                 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
                 */
                do_action('woocommerce_widget_shopping_cart_total');
                ?>
            </p>

            <?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>

            <div class="woocommerce-mini-cart__buttons buttons"><?php do_action('woocommerce_widget_shopping_cart_buttons'); ?></div>

            <?php do_action('woocommerce_widget_shopping_cart_after_buttons'); ?>
        </div>

    </div>

<?php $fragments['.rightcart'] = ob_get_clean();

    return $fragments;
});


add_action('wp_enqueue_scripts', 'action_function_name_7714');
function action_function_name_7714()
{



    wp_localize_script('custom-script', 'front', array('ajaxurl' => admin_url('admin-ajax.php')));
}

add_action('wp_ajax_my_first_ajax', 'my_first_ajax'); // wp_ajax_{ЗНАЧЕНИЕ ПАРАМЕТРА ACTION!!}
add_action('wp_ajax_nopriv_my_first_ajax', 'my_first_ajax');  // wp_ajax_nopriv_{ЗНАЧЕНИЕ ACTION!!}
// первый хук для авторизованных, второй для не авторизованных пользователей

function my_first_ajax()
{


    global $woocommerce;
    extract($_POST);
    if ($qty == 0)
        WC()->cart->remove_cart_item($key);
    else
        WC()->cart->set_quantity($key, $qty);


    echo  WC()->cart->get_cart_contents_count() . "))" . WC_AJAX::get_refreshed_fragments();

    die; // даём понять, что обработчик закончил выполнение
}


add_action('wp_ajax_product_remove', 'product_remove');
add_action('wp_ajax_nopriv_product_remove', 'product_remove');
function product_remove()
{
    global $wpdb, $woocommerce;
    session_start();
    $cart = WC()->instance()->cart;
    $id = $_POST['product_id'];
    $key = $_POST['key'];

    if ($key) {
        WC()->cart->remove_cart_item($key);
    }

    echo  json_encode(WC()->cart->get_cart_contents_count() . "))" . WC_AJAX::get_refreshed_fragments());
    exit();
}

add_filter('woocommerce_product_tabs', 'sb_woo_remove_reviews_tab', 98);
function sb_woo_remove_reviews_tab($tabs)
{

    unset($tabs['reviews']);

    return $tabs;
}
