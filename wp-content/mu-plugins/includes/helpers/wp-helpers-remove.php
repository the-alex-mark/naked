<?php

if (!defined('ABSPATH'))
    exit;

/**
 * Удаляет функцию из указанного фильтра, без доступа к объекту класса.
 *
 * @global WP_Hook[] $wp_filter          Хранит все фильтры и действия.
 *
 * @param  string    $tag                Имя фильтра, к которому прикреплена удаляемая функция.
 * @param  string    $class_name         Имя класса для обратного вызова фильтра.
 * @param  string    $function_to_remove Имя функции, которая должна быть удалена.
 * @param  int       $priority           Необязательный. Приоритет функции. По умолчанию 10.
 *
 * @return bool                          Существовала ли эта функция до того, как она была удалена.
 */
function remove_class_filter($tag, $class_name, $function_to_remove, $priority = 10) {
    global $wp_filter;

    // Проверка существования фильтра
    if (!isset($wp_filter[$tag]))
        return false;

    // Проверка способа хранения конфигураций фильтров (начиная с версии WordPress 4.7+ конфиругация хранится объектом)
    if (is_object($wp_filter[$tag]) && isset($wp_filter[$tag]->callbacks)) {
        $fob = $wp_filter[$tag];
        $callbacks = &$wp_filter[$tag]->callbacks;
    } else {
        $callbacks = &$wp_filter[$tag];
    }

    // Проверка существования вызова фильтра с указанным приоритетом
    if (!isset($callbacks[$priority]) || empty($callbacks[$priority]))
        return false;

    // Поиск нужного фильтра исходя из указанных параметров
    foreach ((array)$callbacks[$priority] as $filter_id => $filter) {

        // Проверка фильтра, созданного в классе (пример: array( $this, 'method' ))
        if (!isset($filter['function']) || !is_array($filter['function']))
            continue;

        // Проверка на то, является ли класс объектом
        if (!is_object($filter['function'][0]))
            continue;

        // Проверка совпадения функции фильтра с указанной в параметре
        if ($filter['function'][1] !== $function_to_remove)
            continue;

        // Проверка совпадения класса фильтра с указанным в параметре
        if (get_class($filter['function'][0]) === $class_name) {

            if (isset($fob)) {

                // Удаление фильтра для WordPress 4.7+
                $fob->remove_filter($tag, $filter['function'], $priority);
            } else {
                unset($callbacks[$priority][$filter_id]);

                if (empty($callbacks[$priority]))
                    unset($callbacks[$priority]);

                if (empty($callbacks))
                    $callbacks = array();

                unset($GLOBALS['merged_filters'][$tag]);
            }

            return true;
        }
    }

    return false;
}

/**
 * Удаляет функцию из указанного действия, без доступа к объекту класса.
 *
 * @param  string $tag                Имя действия, к которому подключается удаляемая функция.
 * @param  string $class_name         Имя класса для обратного вызова фильтра.
 * @param  string $function_to_remove Имя функции, которая должна быть удалена.
 * @param  int    $priority           Необязательный. Приоритет функции. По умолчанию 10.
 *
 * @return bool                       Существовала ли эта функция до того, как она была удалена.
 */
function remove_class_action($tag, $class_name, $function_to_remove, $priority = 10) {
    return remove_class_filter($tag, $class_name, $function_to_remove, $priority);
}
