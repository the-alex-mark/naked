<?php

if (!defined('ABSPATH'))
    exit;

$wp_theme = (object)[

    // Основной функционал
    'constants'             => require 'includes/naked-constants.php',

    // Дополнительный функционал
    'support' => [
        'theme'             => require 'includes/support/naked-support-theme.php'
    ],

    // Вспомогательный функционал
    'helpers' => [
        'helpers'           => require 'includes/helpers/naked-helpers.php',
    ],
];