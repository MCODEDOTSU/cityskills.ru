<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'cmk' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'cmk' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 'cmk' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '9UtA/ac5~q6u#YH_2qZM+ounW1IhPiC/U|RU(0`qh*lQR(#NOv!bfy66%<:52~?P' );
define( 'SECURE_AUTH_KEY',  'Tem,u:im,[k.F&wKZ9(R{O/7=xvc^E![zjOsj>U+yiPHZ V(h1SNY*$o!ntx?S3o' );
define( 'LOGGED_IN_KEY',    '{q@a*Y_LfR?SRb6vcL76QuSZt/U,A.v`zL@Bg^^C} M8Du=1M+(w2[J)GTaNfbe<' );
define( 'NONCE_KEY',        '1=<q`!h3&e`H:xt?-Y*vyPb<(2F.|_+J[,.]TtD%}wfxNo6YjbHr6tg_2J!;ZbOv' );
define( 'AUTH_SALT',        'C!j/KvDh(xv$xy7B8,if(,1bxHSYQ_OBhbdlufZ/?}_Je ~/<~+zZxaw]DxQho{K' );
define( 'SECURE_AUTH_SALT', ']Jis:;cD Nh,.cXI<F6[e^LlQ0>]*xi)O;_6HWzTE(t//51wjTN`OpQMr;n~W9CX' );
define( 'LOGGED_IN_SALT',   'P<ypmd2TEx*Goh,P#&/doE*S>(d${6`Q4&yE=fmFEESU6bY7Q_z@v{ bLseKwL]Q' );
define( 'NONCE_SALT',       'Z8Lq?~>?gNtfLlgz.&jo&6(c.5NGv_#|Qa~3Ntwn<It`hn+_]HFXg?_@+{_vSMNm' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'cmk_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
