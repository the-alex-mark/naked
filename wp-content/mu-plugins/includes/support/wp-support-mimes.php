<?php

if (!defined('ABSPATH'))
    exit;

// Поддержка выбора файлов типа ".svg", ".ico" и ".json"
add_filter('upload_mimes', function ($mimes) {
    if (current_user_can('manage_options')) {
        $mimes['svg']  = 'image/svg+xml';
        $mimes['ico']  = 'image/vnd.microsoft.icon';
        $mimes['json'] = 'application/json';
    }

    return $mimes;
});

// Поддержка загрузки файлов ".svg" и ".json"
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes, $real_mime = '') {
    if (current_user_can('manage_options')) {

        // Файлы ".svg"
        if (in_array($real_mime, array( 'image/svg', 'image/svg+xml' )) || strtolower(substr($filename, -4)) === '.svg') {
            $data['ext']  = 'svg';
            $data['type'] = 'image/svg+xml';
        }

        // Файлы ".json"
        if (in_array($real_mime, array( 'application/json' )) || strtolower(substr($filename, -5)) === '.json') {
            $data['ext']  = 'json';
            $data['type'] = 'application/json';
        }
    }

    return $data;
}, 10, 5);

// Поддержка отображения файлов ".svg" как обычное изображение
add_filter('wp_prepare_attachment_for_js', function ($response) {
    if ($response['mime'] === 'image/svg+xml') {
         $response['sizes'] = [
         	'full'   => array( 'url' => $response['url'] ),
            'large'  => array( 'url' => $response['url'] ),
            'medium' => array( 'url' => $response['url'] )
         ];
    }

    return $response;
});

// Нормализация отображение файлов ".svg" в медиа-библиотеке
add_action('admin_head', function () {
    if (get_current_screen()->base == 'upload') {
        echo '<style type="text/css"> .media-icon.image-icon { display: flex; align-items: center; justify-content: center; }' . PHP_EOL .
             '.media-icon.image-icon img { height: auto; max-width: 100%; width: auto; } </style>';
    }
});
