<?php

if (!defined('ABSPATH'))
    exit;

// Добавление поддержки виджета об ошибках PHP
add_action('wp_dashboard_setup', '_wp_render_widget_php_log');

/**
 * Добавляет новый виджет "Журнал ошибок PHP".
 */
function _wp_render_widget_php_log() {

    if (!current_user_can('manage_options'))
        return;

    // Создание виджета
    wp_add_dashboard_widget(
        'php-errors',
        __('Журнал ошибок PHP'),
        '_wp_php_errors_callback',
        null,
        'column3',
        'default'
    );
}

/**
 * Обрабатывает вывод содержимого виджета "Журнал ошибок PHP".
 */
function _wp_php_errors_callback($post, $meta) {
    $args = $meta['args'];

    // Конфигурация виджета
    $config = [
        'error_log'    => apply_filters('php_error_log', ini_get('error_log')), // Расположение файла журнала
        'error_count'  => 100,                                                  // Количество выводимых ошибок
        'error_length' => 300,                                                  // Длина выводимой ошибки
    ];

    // Статус очистки журнала
    $cleared = false;

    // Очистка журнала
    if (isset($_GET["php-errors"]) && $_GET["php-errors"] == "clear") {
        if (file_exists($config['error_log'])) {
            $handle = fopen($config['error_log'], "w");
            if ($handle) {
                fclose($handle);
                $cleared = true;
            }
        }
    }

    ?>

    <?php if (file_exists($config['error_log'])): ?>
        <?php
        $errors = file($config['error_log']);
        $errors = array_reverse($errors);
        ?>

        <?php if ($cleared): ?>
            <p style="text-align: center"><em>Журнал очищен</em></p>
        <?php endif; ?>

        <?php if ($errors): ?>
            <style>
                #php-errors .inside {
                    margin-top: 0;
                    padding: 0;
                }

                #php-errors .php-errors-body {
                    padding: 5px;
                    max-height: 500px;
                    background-color: #FAFAFA;
                    overflow: auto;
                }
                #php-errors .php-errors-list {
                    margin: 0;
                    padding: 0;
                    list-style: none;
                }
                #php-errors .php-errors-item {
                    display: block;
                    margin: 0;
                    padding: 4px 6px 6px;
                }
                #php-errors .php-errors-item:not(:last-child) {
                    border-bottom: 1px solid #ececec;
                }
                #php-errors .php-errors-footer {
                    display: flex;
                    align-items: center;
                    margin: 0;
                    padding: 12px;
                    border-top: 1px solid #eeeeee;
                }
                #php-errors .php-errors-clear {
                    margin-left: auto;
                    text-decoration: none;
                }
            </style>

            <div class="php-errors-body">
                <ul class="php-errors-list">
                    <?php foreach ($errors as $error): ?>
                        <li class="php-errors-item">
                            <?
                            $output = preg_replace('/\[([^\]]+)\]/', '<b>[$1]</b>', $error, 1);
                            echo (strlen($output) > $config['error_length'])
                                ? substr($output, 0, $config['error_length']) . ' [...]'
                                : $output;
                            ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="php-errors-footer">
                <span class="php-errors-count">Ошибок: <b><?php echo count($errors); ?></b></span>
                <a href="<?php echo admin_url(); ?>?php-errors=clear" onclick="return confirm('Вы уверенны?');" class="php-errors-clear">Очистить журнал</a>
            </div>
        <?php else: ?>
            <p style="text-align: center">Ошибок нет</p>
        <?php endif; ?>
    <?php else: ?>
        <p style="text-align: center"><em>Произошла ошибка чтения журнала</em></p>
    <?php endif; ?>

    <?php
}
