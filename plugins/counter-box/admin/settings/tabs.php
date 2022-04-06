<?php if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Tabs menu for Settings
 *
 * @package     Wow_Plugin
 * @copyright   Copyright (c) 2018, Dmytro Lobov
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

$tab_elements = array(
	'settings' => esc_attr__( 'Settings', 'counter_box' ),
	'content'  => esc_attr__( 'Content', 'counter_box' ),
	'style'    => esc_attr__( 'Style', 'counter_box' ),
);

$tab_li      = '';
$tab_content = '';
$i           = '1';
foreach ( $tab_elements as $key => $val ) {
	$active      = ( $i == 1 ) ? 'is-active' : '';
	$tab_li      .= '<li class="' . $active . ' is-marginless" data-tab="' . $i . '"><a>' . $val . '</a></li>';
	$tab_content .= '<div class="' . $active . ' tab-content" data-content="' . $i . '">';
	ob_start();
	include( $key . '.php' );
	$tab_content .= ob_get_contents();
	ob_end_clean();
	$tab_content .= '</div>';
	$i ++;
}
?>

<div class="tabs is-centered" id="tab">
    <ul><?php echo $tab_li; ?></ul>
</div>
<div id="tab-content" class="inside">
	<?php echo $tab_content; ?>
</div>