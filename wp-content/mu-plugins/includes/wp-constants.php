<?php

if (!defined('ABSPATH'))
    exit;

// Корневая директория
define('MU_ROOT_URL',         plugin_dir_url(dirname(__FILE__)));
define('MU_ROOT_PATH',        dirname(dirname(__FILE__)));

// Расположение ресурсов
define('MU_ASSETS',           MU_ROOT_URL  . 'assets');
define('MU_ASSETS_STYLES',    MU_ASSETS    . '/styles');
define('MU_ASSETS_SCRIPTS',   MU_ASSETS    . '/scripts');
define('MU_ASSETS_RESOURCES', MU_ASSETS    . '/resources');
define('MU_ASSETS_PLUGINS',   MU_ASSETS    . '/plugins');
define('MU_ASSETS_FONTS',     MU_ASSETS    . '/fonts');

// Расположение шаблонов
define('MU_TEMPLATES',        MU_ROOT_PATH . DIRECTORY_SEPARATOR . 'templates');
define('MU_TEMPLATES_PAGES',  MU_TEMPLATES . DIRECTORY_SEPARATOR . 'pages');
define('MU_TEMPLATES_PARTS',  MU_TEMPLATES . DIRECTORY_SEPARATOR . 'parts');