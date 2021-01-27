<?php

if (!defined('ABSPATH'))
    exit;

// Удаление версии WordPress (из заголовка)
remove_action('wp_head', 'wp_generator');

// Удаление версии WordPress (из URL)
add_filter('the_generator', '__return_empty_string');

// Удаление версии стилей и скриптов
add_filter('script_loader_src', '_wp_remove_version');
add_filter('style_loader_src', '_wp_remove_version');
function _wp_remove_version($src) {
    global $wp_version;

    parse_str(parse_url($src, PHP_URL_QUERY), $query);
    if (!empty($query['ver']) && $query['ver'] === $wp_version) {
        $src = remove_query_arg('ver', $src);
    }

    return $src;
}