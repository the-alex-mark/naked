<?php

if (!defined('ABSPATH'))
    exit;

/**
 *
 */
class wp_support_theme {

    /**
     *
     */
    public function __construct() {

        // Поддержка функционала и локализации темы
        add_action('after_setup_theme', [ $this, 'locale' ]);
        add_action('after_setup_theme', [ $this, 'support' ]);

        // Подключение стилей и скриптов темы
        add_action('wp_enqueue_scripts', [ $this, 'enqueue' ]);
    }

    /**
     * Поддержка локализации темы.
     */
    public function locale() {

        load_theme_textdomain('naked', ROOT_PATH . '/languages');
    }

    /**
     * Поддержка различного функционала на сайте.
     */
    public function support() {

        // Отображение панели администратора WordPress
        show_admin_bar(false);

        // Поддержка пользовательского навигационного меню
        add_theme_support('menus');

        // Поддержка виджетов
        add_theme_support('widgets');

        // Поддержка пользовательского логотипа
        add_theme_support('custom-logo');

        // Поддержка миниатюр типов постов
        add_theme_support('post-thumbnails', [
            'page', 'post', 'employee', 'gratitude', 'partner'
        ]);

        // Поддержка форматов поста
        add_theme_support( 'post-formats', [
            'image', 'video', 'link', 'chat'
        ]);

        // Поддерка HTML5
        add_theme_support('html5', [
            'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'script', 'style',
        ]);

        // Поддержка широкого выравнивания для картинок у блоков "Gutenberg"
        add_theme_support('align-wide');

        // Регистрация пользовательского навигационного меню
        register_nav_menu('primary', 'Основное меню');
    }

    /**
     * Подключение стилей и скриптов темы.
     */
    public function enqueue() {

        // Подключение стилей
        wp_enqueue_style('normalize',      assets('plugins/normalize/normalize.css'));
        wp_enqueue_style('main',           assets('styles/main.css'));

        // Подключение скриптов
        wp_enqueue_script('jquery');
        wp_enqueue_script('main',          assets('scripts/main.js'), [], false, true);
    }
}

return new wp_support_theme();