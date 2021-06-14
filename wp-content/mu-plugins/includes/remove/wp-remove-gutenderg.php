<?php

if (!defined('ABSPATH'))
    exit;

// Отключение работы редактора «Gutenberg»
if ('disable_gutenberg') {

    // Отключение редактора для WordPress версии 5.5 и ниже
    remove_theme_support('core-block-patterns');

    // Отключение редактора для всех типов записей
    add_filter('use_block_editor_for_post_type', '__return_false', 100);

    // Отключение подключения стилей и скриптов редактора
    remove_action('wp_enqueue_scripts', 'wp_common_block_scripts_and_styles');

    // Отключение уведомлений политики безопасности
    add_action('admin_init', function() {
        remove_action('admin_notices', array( 'WP_Privacy_Policy_Content', 'notice' ));
        add_action('edit_form_after_title', array( 'WP_Privacy_Policy_Content', 'notice' ));
    });
}
