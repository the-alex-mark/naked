<?php

if (!defined('ABSPATH'))
    exit;

// Поддержка старых версий WordPress
if (!function_exists('_wp_render_title_tag')) {

    // Вывод тега заголовка с содержимым.
    add_action('wp_head', '_wp_render_title_tag', 10);
    function _wp_render_title_tag() {

        $title = [
            'home'      => apply_filters('document_title_home', 'Главная'),
            'site_name' => apply_filters('document_title_site_name', get_bloginfo('name')),
            'separator' => apply_filters('document_title_separator', '&#183;')
        ];

        echo '<title>';
        echo (is_home() || is_front_page())
            ? $title['home'] . ' ' . $title['separator'] . ' '
            : wp_title($title['separator'], false, 'right');
        echo $title['site_name'];
        echo '</title>';
    }

} else {

    // Поддержка функционала и локализации темы
    add_action('after_setup_theme', '_wp_support_title_tag', 10);
    function _wp_support_title_tag() {
        add_theme_support('title-tag');
    }

    // Изменение положения заголовка сайта относительно разделителя
    add_filter('document_title_parts', '_change_document_title', 10, 1);
    function _change_document_title($title) {
        if (is_home() || is_front_page()) {
            $title = array_reverse($title);
            $title['tagline'] = apply_filters('document_title_home', 'Главная');
        }

        return $title;
    }

    // Замена разделителя заголовка сайта
    add_filter('document_title_separator', '_change_document_title_separator', 10, 1);
    function _change_document_title_separator($separator) {
        return '&#183;'; // Символ "·"
    }
}