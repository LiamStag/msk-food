<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'pavelixn_mskfo73' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'pavelixn_mskfo73' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 'UMkA7rB9' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

define('AUTH_KEY',         '-(h@=|],opOwF3h,SkiO0<K5)9hj');
define('SECURE_AUTH_KEY',  '0b8T2&Iz0E<3XIs}GSxa>IC');
define('LOGGED_IN_KEY',    '~wA01_9$MudGy0j)i~B9uq&Fd1T00');
define('NONCE_KEY',        '[*5U%@?7qhA4au8Q|K:,*NK{Sq?');
define('AUTH_SALT',        'M5@}!,GGE{5%<W$Z{V');
define('SECURE_AUTH_SALT', 'hw3yjM<2#`*@SGs!WbIchG_8');
define('LOGGED_IN_SALT',   'h{wbrn4%<)$g$.PFYH6Ku`Q0k*');
define('NONCE_SALT',       'x|}4p60eJU@ZzL]m4vF3xPn0B9i');

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wps_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_DISPLAY', true );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */

// define( 'COMPRESS_CSS',        true );
// define( 'COMPRESS_SCRIPTS',    true );
// define( 'CONCATENATE_SCRIPTS', true );
// define( 'ENFORCE_GZIP',        true );
define('WP_MEMORY_LIMIT', '512M');




/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
