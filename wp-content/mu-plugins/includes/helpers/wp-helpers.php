<?php

if (!defined('ABSPATH'))
    exit;

if (!function_exists('mu_assets')) {

    /**
     * Возвращает расположение файла, относительно папки `assest`.
     *
     * @param string $file Расположение нужного ресурса внутри папки `assets`.
     *
     * @return string|false
     */
    function mu_assets($file) {
        return MU_ASSETS . '/' . $file;
    }
}

if (!function_exists('mu_template')) {

    /**
     * Возвращает расположение файла, относительно папки `templates`.
     *
     * @param string $file Расположение нужного шаблона внутри папки `templates`.
     *
     * @return string|false
     */
    function mu_template($file) {
        return MU_TEMPLATES . DIRECTORY_SEPARATOR . $file;
    }
}

if (!function_exists('mu_notice')) {

    /**
     * Вызывает уведомление администратора с указанными параметрами.
     *
     * @param string $content        Текст уведомления.
     * @param string $type           Тип уведомления.
     * @param bool   $is_dismissible Возможность закрытия уведомления.
     *
     * @return null|false
     */
    function mu_notice($content, $type = 'info', $is_dismissible = true) {
        if (empty($content))
            return false;

        echo '<div class="notice notice-' . $type . (($is_dismissible) ? ' is-dismissible' : '') . '">' . $content . '</div>';
    }
}