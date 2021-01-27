<?php

if (!defined('ABSPATH'))
    exit;

// Удаление канонической ссылки
remove_action('wp_head', 'rel_canonical');

// Удаление короткой ссылки на текущую страницу
remove_action('wp_head', 'wp_shortlink_wp_head');

// Удаление различных ссылок
remove_action('wp_head', 'index_rel_link');          // На главную страницу
remove_action('wp_head', 'start_post_rel_link');     // На первую запись
remove_action('wp_head', 'parent_post_rel_link');    // На предыдущую запись
remove_action('wp_head', 'adjacent_posts_rel_link'); // На следующую запись
 
// Удаляем связь с родительской записью
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');

// Отключение плагина "WP-PageNavi"
remove_action('wp_head', 'pagenavi_css');
