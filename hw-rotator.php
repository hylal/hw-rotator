<?php
/*
 * Plugin Name: HW Rotator
 * Plugin URI: https://github.com/hylal/hw-rotator
 * Description: WordPress Woocommerce Plugin for whatsapp rotator.
 * Version: 1.0.0
 * Author: Hilaludin Wahid
 * Author URI: https://wahid.biz
 * License: GPLv2
 */

// Bismillahirrahmaanirrahim
if ( ! defined( 'ABSPATH' ) ) {
  die;
}

// Menambah Fungsi

function hwRotator()
{
  require_once __DIR__ . '/fungsi/jalankan.php';
}

register_activation_hook( __FILE__, 'hwRotator');
// End plugin acticator


// menambah submenu setting to WooCommerce
add_action('admin_menu', 'hwRotatorAdminMenu');
function hwRotatorAdminMenu(){
   add_submenu_page('woocommerce', 'HW Rotator', 'HwRotator', 'manage_options', 'hw_rotator_admin', 'hwRotatorAdminPage' );
}

function hwRotatorAdminPage()
{
   require_once __DIR__ . '/fungsi/administrasi.php';
}

// Menambahkan WA button
function hwRotatorButtonAfterAddToCart()
{

  require_once __DIR__ . '/fungsi/go.php';
}


if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
   add_action('woocommerce_after_add_to_cart_button', 'hwRotatorButtonAfterAddToCart');
}
// Menambahkan WA button end
