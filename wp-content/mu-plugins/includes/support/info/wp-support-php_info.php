<?php

if (!defined('ABSPATH'))
    exit;

// Добавление поддержки вывода информации о PHP
add_action('admin_menu', '_wp_render_menu_php_info');

/**
 * Добавляет новый пункт меню "Версия PHP".
 */
function _wp_render_menu_php_info() {

    // Добавление нового пункта меню в раздел "Инструменты"
    add_management_page(
        'PHP ' . phpversion(),
        __('Версия PHP', 'naked'),
        'manage_options',
        'php_info',
        '_wp_php_info_callback',
        4
    );
}

/**
 * Обрабатывает вывод содержимого страницы "Версия PHP".
 */
function _wp_php_info_callback() {

    // Получение всей информации о PHP
    ob_start();
    phpinfo();
    $php_info = ob_get_contents();
    ob_end_clean();

    // Получение только содержимого элемента "<body>"
    $php_info = preg_replace('%^.*<body>(.*)</body>.*$%ms', '$1', $php_info);

    ?>

    <style>
        #php-info { color: #222222; font-size: 16px; }
        #php-info pre { margin: 0; font-family: monospace; }
        #php-info a { color: #222222; }
        #php-info a:link { color: #000099; text-decoration: none; background-color: #ffffff; }
        #php-info a:hover { text-decoration: underline; }
        #php-info table { border-collapse: collapse; border: 0; max-width: 934px; width: 100%; box-shadow: 1px 2px 3px #cccccc; }
        #php-info .center { text-align: center; }
        #php-info .center table { margin: 1em auto; text-align: left; }
        #php-info .center th { text-align: center !important; }
        #php-info td,
        #php-info th { border: 1px solid #666666; font-size: 75%; vertical-align: baseline; padding: 4px 5px; }
        #php-info th { position: sticky; top: 0; background: inherit; }
        #php-info h1 { font-size: 200%; font-weight: bold; }
        #php-info h2 { font-size: 125%; font-weight: bold; }
        #php-info .p { font-size: 250%; text-align: left;}
        #php-info .e { background-color: #ccccff; width: 300px; font-weight: bold; }
        #php-info .h { background-color: #9999cc; font-weight: bold; }
        #php-info .v { background-color: #dddddd; max-width: 300px; overflow-x: auto; word-wrap: break-word; }
        #php-info .v i { color: #999999; }
        #php-info img { display: block; float: right; border: 0; }
        #php-info hr { max-width: 934px; width: 100%; background-color: #cccccc; border: 0; height: 1px; }
    </style>

    <div id="php-info" class="wrap">
        <?php echo $php_info; ?>
    </div>

    <?php
}
