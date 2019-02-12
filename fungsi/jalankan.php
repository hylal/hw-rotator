<?php
require_once __DIR__ . '/awal.php';

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if (!class_exists('WooCommerce')) {
	die('Untuk menggunakan plugin ini, harus install WooCommerce.');
}

// Set default value
$hwRotatorObject->setDefault();
