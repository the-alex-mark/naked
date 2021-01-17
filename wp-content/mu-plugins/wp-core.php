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
];