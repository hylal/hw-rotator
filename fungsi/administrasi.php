<?php
require_once __DIR__ . '/awal.php';

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if( isset( $_GET[ 'tab' ] ) ) {
    $active_tab = $_GET[ 'tab' ];
} else {
    $active_tab = 'general';
}

$errorMessage = null;
if (count($_POST) > 0) {
    if (
        ! isset( $_POST['_token'] )
        || ! wp_verify_nonce( $_POST['_token'], 'hw_rotator_admin_update' )
    ) {

       echo 'Sorry, your nonce did not verify.';
       exit;

    }
    if (isset($_POST['hw_rotator_no_hp']) && is_null($errorMessage)) {
        if (!ctype_digit($_POST['hw_rotator_no_hp'])) {
            $errorMessage = 'WhatsApp Number must be numeric.';
        } else {
            $hwRotatorObject->setOption('hw_rotator_no_hp', sanitize_text_field($_POST['hw_rotator_no_hp']));
            $success = true;
        }
    }
    if (isset($_POST['hw_rotator_no_hp2']) && is_null($errorMessage)) {
        if (!ctype_digit($_POST['hw_rotator_no_hp2'])) {
            $errorMessage = 'WhatsApp Number must be numeric.';
        } else {
            $hwRotatorObject->setOption('hw_rotator_no_hp2', sanitize_text_field($_POST['hw_rotator_no_hp2']));
            $success = true;
        }
    }
    if (isset($_POST['hw_rotator_content']) && is_null($errorMessage)) {
        $hwRotatorObject->setOption('hw_rotator_content', sanitize_text_field($_POST['hw_rotator_content']));
        $success = true;
    }
    if (isset($_POST['hw_rotator_button']) && is_null($errorMessage)) {
        $hwRotatorObject->setOption('hw_rotator_button', sanitize_text_field($_POST['hw_rotator_button']));
        $success = true;
    }
    if (isset($_POST['hw_rotator_button_class']) && is_null($errorMessage)) {
        $hwRotatorObject->setOption('hw_rotator_button_class', sanitize_text_field($_POST['hw_rotator_button_class']));
        $success = true;
    }
    if (isset($_POST['hw_rotator_button_id']) && is_null($errorMessage)) {
        $hwRotatorObject->setOption('hw_rotator_button_id', sanitize_text_field($_POST['hw_rotator_button_id']));
        $success = true;
    }
    if (isset($_POST['hw_rotator_button_css']) && is_null($errorMessage)) {
        $hwRotatorObject->setOption('hw_rotator_button_css', stripslashes($_POST['hw_rotator_button_css']));
        $success = true;
    }
    if (isset($_POST['hw_rotator_show_desktop']) && is_null($errorMessage)) {
        if (in_array($_POST['hw_rotator_button_show_desktop'], ['yes', 'no'])) {
            $hwRotatorObject->setOption('hw_rotator_button_show_desktop', sanitize_text_field($_POST['hw_rotator_button_show_desktop']));
            $success = true;
        } else {
            $errorMessage = $_POST['hw_rotator_button_show_desktop'] . ' value not valid.';
        }
    }
}
?>

<div class="wrap">
    <h1>Setting Untuk WA Customer Sales / Marketing</h1>

    <!-- Tab navigation start -->
    <h2 class="nav-tab-wrapper">
        <a href="?page=hw_rotator_admin&tab=general" class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>">General</a>
        <a href="?page=hw_rotator_admin&tab=advance" class="nav-tab <?php echo $active_tab == 'advance' ? 'nav-tab-active' : ''; ?>">Advance Settings</a>
    </h2>
    <!-- Tab navigation end -->

    <?php if(isset($success) && $success){ ?>
    <!-- Success message start -->
    <div class="notice notice-success is-dismissible">
        <p>Perubahan berhasil disimpan :)</p>
    </div>
    <!-- Success message end -->
    <?php } ?>

    <?php if(!is_null($errorMessage)){ ?>
    <!-- Error message start -->
    <div class="notice notice-error is-dismissible">
        <p><?php echo $errorMessage; ?></p>
    </div>
    <!-- Error message end -->
    <?php } ?>


    <form action="" method="post">
        <?php settings_fields( 'woocommerce-order-whatsapp' ); do_settings_sections( 'woocommerce-order-whatsapp' ); ?>
        <?php wp_nonce_field( 'hw_rotator_admin_update', '_token' ); ?>

        <?php if ($active_tab == 'general') { ?>
        <!-- General form menu -->
        <table class="form-table">
            <tr valign="top">
            <th scope="row">Nomor CS OB Fit ke 01</th>
            <td>
                <input style="width: 500px;" type="text" name="hw_rotator_no_hp" value="<?php echo esc_attr($hwRotatorObject->getOption('hw_rotator_no_hp')); ?>" placeholder="Example: 62888XXXXXXX" />
                <br><small>Don't forget to add country code prefix, like 62 for Indonesia.</small>
            </td>
            </tr>

            <tr valign="top">
            <th scope="row">Nomor CS OB Fit ke 02</th>
            <td>
                <input style="width: 500px;" type="text" name="hw_rotator_no_hp2" value="<?php echo esc_attr($hwRotatorObject->getOption('hw_rotator_no_hp2')); ?>" placeholder="Example: 62888XXXXXXX" />
                <br><small>Don't forget to add country code prefix, like 62 for Indonesia.</small>
            </td>
            </tr>

            <tr valign="top">
            <th scope="row">Button Text</th>
            <td><input style="width: 500px;" type="text" name="hw_rotator_button" value="<?php echo esc_attr($hwRotatorObject->getOption('hw_rotator_button')); ?>" /></td>
            </tr>

            <tr valign="top">
            <th scope="row">Message</th>
            <td>
                <textarea  style="width: 500px;" rows="8" name="hw_rotator_content"><?php echo esc_attr($hwRotatorObject->getOption('hw_rotator_content')); ?></textarea><br>
                Formatting:
                <ul>
                    <li>You can use <strong>{{title}}</strong> to insert Product Name.</li>
                    <li>You can use <strong>{{link}}</strong> to insert Product URL.</li>
                </ul>
                Example: <em><?php echo esc_attr($hwRotatorObject->default['content']); ?></em> will be parsed to <strong>Hello, I want to buy this product https://yourstore.com/produk/link-produk</strong>
            </td>
            </tr>

            </tr>
        </table>
        <!-- General form menu -->
        <?php } elseif ($active_tab == 'advance') { ?>
        <!-- Advance form menu -->
        <!-- General form menu -->
        <h3>WhatsApp Button Setting</h3>
        <table class="form-table">
            <tr valign="top">
            <th scope="row">Button Class
            <td>
                <input style="width: 500px;" type="text" name="hw_rotator_button_class" value="<?php echo esc_attr($hwRotatorObject->getOption('hw_rotator_button_class')); ?>" placeholder="<?php echo esc_attr($hwRotatorObject->default['button_class']); ?>" />
                <br><small>Default class: <code>single_add_to_cart_button button</code>, with this class WhatsApp button style will following Add to Cart button style.</small>
            </td>
            </tr>

            <tr valign="top">
            <th scope="row">Button ID</th>
            <td><input style="width: 500px;" type="text" name="hw_rotator_button_id" value="<?php echo esc_attr($hwRotatorObject->getOption('hw_rotator_button_id')); ?>" placeholder="<?php echo esc_attr($hwRotatorObject->default['button_id']); ?>" /></td>
            </tr>

            <tr valign="top">
            <th scope="row">Custom Button Style CSS</th>
            <td>
                <textarea  style="width: 500px;" rows="8" name="hw_rotator_button_css" placeholder="Example: margin: 0px 2px; border-radius: 5px;"><?php echo $hwRotatorObject->getOption('hw_rotator_button_css'); ?></textarea><br>
            </td>
            </tr>

            <tr valign="top">
            <th scope="row">Show on Desktop</th>
            <td>
                <input type="radio" name="hw_rotator_button_show_desktop" value="yes" <?php echo $hwRotatorObject->getOption('hw_rotator_button_show_desktop', 'yes') == 'yes' ? 'checked' : '' ?>> Yes
                <input type="radio" name="hw_rotator_button_show_desktop" value="no" <?php echo $hwRotatorObject->getOption('hw_rotator_button_show_desktop', 'yes') == 'no' ? 'checked' : '' ?>> No
            </td>
            </tr>

            </tr>
        </table>
        <!-- Advance form menu -->
        <?php } ?>
        <?php submit_button(); ?>
    </form>
</div>
