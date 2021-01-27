<?php

if (!defined('ABSPATH'))
    exit;

// Отключение поддержки сервиса "Windows Live Writer"
remove_action('wp_head','wlwmanifest_link');
