<?php

if (!defined('ABSPATH'))
    exit;

// Вывод фильтра для терминов категорий
add_action('admin_print_scripts', '_wp_render_term_filter', 20);

/**
 * Генерирует и выводит поле фильтрации терминов категории.
 */
function _wp_render_term_filter() {

    if (get_current_screen()->base !== 'post')
        return;

    ?>

    <style>
        .wp-term_filter-input {
            display: block;
            margin: 10px 0;
            width: 100%;
        }
    </style>

    <script>
        jQuery(document).ready(function($) {

            // Получение контейнера с выбором категорий
            var container_terms = $('.categorydiv');

            // Вывод дополнительного поля поиска термина и его обработка
            container_terms
                .prepend('<input type="search" class="wp-term_filter-input" placeholder="Поиск">')
                .on('keyup search', '.wp-term_filter-input', function (e) {
                    var term_search = e.target.value;
                    var term_list   = $(this).parent().find('.categorychecklist li');

                    if ($.trim(term_search)) {
                        term_list.hide().filter(function () {
                            return $(this).text().toLowerCase().indexOf(term_search.toLowerCase()) !== -1;
                        }).show();
                    }
                    else { term_list.show(); }
                });

        });
    </script>

    <?php
}