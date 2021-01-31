<?php

if (!defined('ABSPATH'))
    exit;

if (!function_exists('dd')) {

    /**
     * Выводит указанные данные в удобном, читаемом представлении.
     *
     * @param mixed   $data
     * @param boolean $die
     */
    function dd($data, $die = false) {
        echo '<pre style="margin: 8px; width: 100%; font-size: 14px; background-color: #ffffff;">';
        print_r($data);
        echo '</pre>';

        if ($die)
            die();
    }
}
