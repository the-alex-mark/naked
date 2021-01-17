<?php

if (!defined('ABSPATH'))
    exit;

// Корневая директория
define('ROOT_URL',            get_template_directory_uri());
define('ROOT_PATH',           get_template_directory());

// Расположение ресурсов
define('ASSETS',              ROOT_URL  . '/assets');
define('ASSETS_STYLES',       ASSETS    . '/styles');
define('ASSETS_SCRIPTS',      ASSETS    . '/scripts');
define('ASSETS_RESOURCES',    ASSETS    . '/resources');
define('ASSETS_PLUGINS',      ASSETS    . '/plugins');
define('ASSETS_FONTS',        ASSETS    . '/fonts');

// Расположение шаблонов
define('TEMPLATES',           ROOT_PATH . '/templates');
define('TEMPLATES_PAGES',     TEMPLATES . '/pages');
define('TEMPLATES_PARTS',     TEMPLATES . '/parts');