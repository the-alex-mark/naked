<?php

if (!defined('ABSPATH'))
    exit;

// Отключение поддержки сервиса "Really Simple Discovery"
remove_action('wp_head','rsd_link');
