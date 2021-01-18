<?php

if (!defined('ABSPATH'))
    exit;

// Отключение вывода ссылок ленты RSS
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);

// Отключение событий RSS
remove_action('do_feed', 'do_feed');
remove_action('do_feed_rdf', 'do_feed_rdf');
remove_action('do_feed_rss', 'do_feed_rss');
remove_action('do_feed_rss2', 'do_feed_rss2');
remove_action('do_feed_atom', 'do_feed_atom');

// Отображение кода ошибки "404" для RSS
add_action('do_feed', '_wp_disable_feed');
add_action('do_feed_rdf', '_wp_disable_feed');
add_action('do_feed_rss', '_wp_disable_feed');
add_action('do_feed_rss2', '_wp_disable_feed');
add_action('do_feed_atom', '_wp_disable_feed');
function _wp_disable_feed() {

    // Указание заголовка с кодом "404"
    header('Content-Type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset'), true, 404);

    // Вывод страницы "404"
    include get_query_template('404');
    exit;
}