<?php

if (!defined('ABSPATH'))
    exit;

// Отключение поддержки "Emoji"
add_action('init', function () {

    // Перечисление всех действий, отвечающих за работу "Emoji"
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');

    // Отключение "Emoji" из редактора "TinyMCE"
    add_filter('tiny_mce_plugins', function ($plugins) {
        return (is_array($plugins))
            ? array_diff($plugins, [ 'wpemoji' ])
            : [];
    });

    // Отключение "dns-prefetch"
    add_filter('emoji_svg_url', '__return_false');
    add_filter('wp_resource_hints', function ($urls, $relation_type) {
        if ('dns-prefetch' == $relation_type) {
            $emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2.2.1/svg/');
            $urls          = array_diff($urls, [ $emoji_svg_url ]);
        }

        return $urls;
    }, 10, 2);
});