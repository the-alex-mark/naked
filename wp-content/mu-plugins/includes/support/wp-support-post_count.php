<?php

if (!defined('ABSPATH'))
    exit;

// Количество записей на утверждении
add_action('admin_menu', '_wp_render_post_count');
function _wp_render_post_count() {
    global $menu;

    $exclude    = [ 'mediapage', 'attachment', 'revision', 'nav_menu_item' ];
    $post_types = get_post_types([ 'public' => true ]);

    foreach ($post_types as $post_type) {
        if (in_array($post_type, $exclude))
            continue;

        $count = wp_count_posts($post_type)->pending;
        if ($count) {
            foreach ($menu as $key => $value) {
                if ($menu[$key][2] == 'edit.php' . (($post_type != 'post') ? '?post_type=' . $post_type: '')) {
                    $menu[$key][0] .= ' <span class="awaiting-mod"><span class="pending-count">' . $count . '</span></span>';
                    break;
                }
            }
        }
    }
}