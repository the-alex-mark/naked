<?php

/**
 * Plugin Name: Naked Core
 * Description: Основной функционал сайта
 * Version:     3.6
 * Author:      Александр Макаров
 * Author URI:  https://vk.com/the_alex_mark
 */

if (!defined('ABSPATH'))
    exit;

$wp_core = (object)[

    // Основной функционал
    'constants'             => require 'includes/wp-constants.php',
    'locale'                => require 'includes/wp-locale.php',

    // Вспомогательный функционал
    'helpers' => [
        'helpers'           => require 'includes/helpers/wp-helpers.php',
        'remove_action'     => require 'includes/helpers/wp-helpers-remove_action.php',
        'remove_filter'     => require 'includes/helpers/wp-helpers-remove_filter.php'
    ],

    // Дополнительный функционал
    'support' => [
        'title_tag'         => require 'includes/support/wp-support-title_tag.php',
        'post_count'        => require 'includes/support/wp-support-post_count.php',
        'term_filter'       => require 'includes/support/wp-support-term_filter.php',
        'tgmpa'             => require 'includes/support/wp-support-tgmpa.php',
        'svg'               => require 'includes/support/wp-support-svg.php',

        'info' => [
            'php_info'      => require 'includes/support/info/wp-support-php_info.php',
            'php_log'       => require 'includes/support/info/wp-support-php_log.php'
        ]
    ],

    // Отключение лишнего функционала
    'remove' => [
        'emoji'             => require 'includes/remove/wp-remove-emoji.php',
        'rss'               => require 'includes/remove/wp-remove-rss.php'
    ]
];