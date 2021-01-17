<?php

if (!defined('ABSPATH'))
    exit;

if (!function_exists('assets')) {

    /**
     * Возвращает расположение файла, относительно папки `assest`.
     *
     * @param string $file Расположение нужного ресурса внутри папки `assets`.
     *
     * @return string|false
     */
    function assets($file)
    {
        return ASSETS . '/' . $file;
    }
}

if (!function_exists('template')) {

    /**
     * Возвращает расположение файла, относительно папки `templates`.
     *
     * @param string $file Расположение нужного шаблона внутри папки `templates`.
     *
     * @return string|false
     */
    function template($file)
    {
        return TEMPLATES . DIRECTORY_SEPARATOR . $file;
    }
}