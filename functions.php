<?php
if (file_exists( __DIR__ . '/vendor/autoload.php')) {
	require_once __DIR__ . '/vendor/autoload.php';
}

require_once get_template_directory() . '/src/functions.php';

Selectrum\Theme::init();
