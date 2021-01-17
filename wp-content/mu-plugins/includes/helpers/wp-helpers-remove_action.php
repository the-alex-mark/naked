<?php

if (!defined('ABSPATH'))
    exit;

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