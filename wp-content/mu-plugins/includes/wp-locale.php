<?php

if (!defined('ABSPATH'))
    exit;

// Поддержка локализации плагина
add_action('mu_plugin_loaded', function ($mu_plugin) {
    load_muplugin_textdomain('naked', 'languages');
    load_muplugin_textdomain('tgmpa', 'languages');
});