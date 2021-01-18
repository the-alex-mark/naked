<?php

if (!defined('ABSPATH'))
    exit;

// Отключение автоматического сохранения записи в процессе редактирования
add_action('wp_print_scripts', function () {
   wp_deregister_script('autosave');
});