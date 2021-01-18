<?php

if (!defined('ABSPATH'))
    exit;

// Добавление поддержки загрузки файлов ".svg" и ".ico"
add_filter('upload_mimes', function ($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['ico'] = 'image/vnd.microsoft.icon';

    return $mimes;
});

// Исправление MIME типа для SVG файлов.
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes, $real_mime = '') {

    // Для WordPress 5.1+
    $dosvg = (version_compare($GLOBALS['wp_version'], '5.1.0', '>='))
        ? in_array($real_mime, [ 'image/svg', 'image/svg+xml' ])
        : (strtolower(substr($filename, -4)) === '.svg');

    if ($dosvg) {

        // Разрешение на загрузку SVG файлов только администраторам
        if (current_user_can('manage_options')) {
            $data['ext']  = 'svg';
            $data['type'] = 'image/svg+xml';
        }
        else {
            $data['ext'] = $type_and_ext['type'] = false;
        }

    }

    return $data;
}, 10, 5);

// Формирование данных для отображения SVG как изображения в медиабиблиотеке.
add_filter('wp_prepare_attachment_for_js', function ($response) {
    if ( $response['mime'] === 'image/svg+xml' ) {

        // С выводом названия файла
        $response['image'] = [
            'src' => $response['url'],
        ];

        // Без вывода названия файла
        // $response['sizes'] = [
        // 	'medium' => [
        // 		'url' => $response['url'],
        // 	],
        // ];
    }

    return $response;
});