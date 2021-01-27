<?php

if (!defined('ABSPATH'))
    exit;

// Отключение "srcset" у тега "img"
add_filter('wp_calculate_image_srcset_meta', '__return_null');
remove_filter('the_content', 'wp_make_content_images_responsive');

// Отключение "sizes" у тега "img"
add_filter('wp_calculate_image_sizes', '__return_false',  99);

// Очистка атрибутов из "wp_get_attachment_image()"
add_filter('wp_get_attachment_image_attributes', 'unset_attach_srcset_attr', 99);
function unset_attach_srcset_attr($attr) {
	foreach([ 'sizes', 'srcset' ] as $key) {
        if (isset($attr[$key]))
            unset($attr[$key]);
    }
        
	return $attr;
}
