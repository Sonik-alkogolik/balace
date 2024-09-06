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
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'wp_db' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'root' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', '' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'MySQL-8.0' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Q;$!q/N_A0Zm5@>tjuH3Oy+bj5#i{V,%0;%N]Fx?2Y&bE!`CJ0Z$Q:{F:CYTON&.' );
define( 'SECURE_AUTH_KEY',  'IJ;U>GY!hHL(v1U_Q6m*Ds^*x2yavUNrXRaOeqMH9B y3?9b}^qb^d&*Q~n/Q){n' );
define( 'LOGGED_IN_KEY',    'Rbr{ac[$`Fg}$]%dUJ4(0j@-jl%f/Bb(Ea b <s3BYB+MI.(uT9!O4YX;cq]FZ)[' );
define( 'NONCE_KEY',        '^_4-/T]:Dq,!h)[ip~#y>HCz8)2*$Hp[o|Pz<lL$cne!^1,*!vdumhIuc-^3Ob2B' );
define( 'AUTH_SALT',        'I)ckF!sPNY4 +cICaLQdAWKaX!BJzmOb;.l)GVG<~Z]>S08Tx C%Nf$MQw>Vi29A' );
define( 'SECURE_AUTH_SALT', 'Btt>;&?([;@SE8j%+iM[zZ?`;`>18Z9&vT3-StvWoZFg8C%&9*.yDzvs.a8pshlt' );
define( 'LOGGED_IN_SALT',   'BA6:h?Ti/7h:X;]CH{Yt>?{R/@d%NYCDrMVn-~EzaH;ktP(Xg@cHEP4XG.zzq;=L' );
define( 'NONCE_SALT',       'tI?^A]O``5#[,W3CGMADV;#{V8,o#`QRNXHXIjc9sJ1J?.Pi:<M6B)Is%RUuWs$0' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );
/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';

define('WP_ALLOW_MULTISITE', true);

