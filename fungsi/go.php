<?php
require_once __DIR__ . '/awal.php';

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if (wp_is_mobile() || $hwRotatorObject->getOption('hw_rotator_button_show_desktop', 'yes') == 'yes') {
	global $product;

	$namerotate = esc_attr($hwRotatorObject->getOption('hw_rotator_name_rotate'));
	$noHp = esc_attr($hwRotatorObject->getOption('hw_rotator_no_hp'));
	$noHp2 = esc_attr($hwRotatorObject->getOption('hw_rotator_no_hp2'));
	$content = esc_attr($hwRotatorObject->getOption('hw_rotator_content'));
	$button = esc_attr($hwRotatorObject->getOption('hw_rotator_button'));
	?>
	<button class="<?php echo $hwRotatorObject->getOption('hw_rotator_button_class', $hwRotatorObject->default['button_class']) ?>" id="<?php echo $hwRotatorObject->getOption('hw_rotator_button_id', 'hwrotator-button') ?>" style="<?php echo $hwRotatorObject->getOption('hw_rotator_button_css') ?>" type="button" onclick="openWA()"><?php echo $button ?></button>
	<script>
    var i = parseInt(Math.random() * 2)
		var isMobile = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i);
		function openWA(){
			var noHp = ["<?php echo esc_attr($noHp); ?>","<?php echo esc_attr($noHp2); ?>"],
				content = "<?php echo esc_attr($hwRotatorObject->getContent($content, $product)) ?>";
        namerotate = "<?php echo esc_attr($namerotate); ?>",
        link = "";
			if (isMobile) {
				link = "https://wa.me/" + noHp[i] + "?text=" + content;
			} else {
				link = "https://wa.me/" + noHp[i] + "?text=" + content;
			}
			var n = window.open(link, "_blank");
			n ? n.focus() : alert("Please allow popups for this website")
		}
	</script>
	<?php
}
?>
