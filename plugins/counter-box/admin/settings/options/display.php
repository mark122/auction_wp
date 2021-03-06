<?php if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Tergeting settings
 *
 * @package     Wow_Plugin
 * @subpackage  Settings
 * @copyright   Copyright (c) 2018, Dmytro Lobov
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */


//region Schedule
$weekday = array(
	'label'   => esc_attr__( 'Day of the week', 'counter_box' ),
	'attr'    => [
		'name'  => 'param[weekday]',
		'id'    => 'weekday',
		'value' => isset( $param['weekday'] ) ? $param['weekday'] : 'none',
	],
	'options' => [
		'none' => esc_attr__( 'Everyday', 'counter_box' ),
		'1'    => esc_attr__( 'Monday', 'counter_box' ),
		'2'    => esc_attr__( 'Tuesday', 'counter_box' ),
		'3'    => esc_attr__( 'Wednesday', 'counter_box' ),
		'4'    => esc_attr__( 'Thursday', 'counter_box' ),
		'5'    => esc_attr__( 'Friday', 'counter_box' ),
		'6'    => esc_attr__( 'Saturday', 'counter_box' ),
		'7'    => esc_attr__( 'Sunday ', 'counter_box' ),

	],
	'tooltip' => esc_attr__( 'Select the day of the week when the counter will be displayed.', 'counter_box' ),
	'icon'    => '',
	'func'    => '',
);

$time_start = array(
	'label'   => esc_attr__( 'Time from', 'counter_box' ),
	'attr'    => [
		'name'  => 'param[time_start]',
		'id'    => 'time_start',
		'value' => isset( $param['time_start'] ) ? $param['time_start'] : '00:00',
	],
	'tooltip' => esc_attr__( 'Specify what from time of the day to show the counter', 'counter_box' ),
	'icon'    => '',
);

$time_end = array(
	'label'   => esc_attr__( 'Time to', 'counter_box' ),
	'attr'    => [
		'name'  => 'param[time_end]',
		'id'    => 'time_end',
		'value' => isset( $param['time_end'] ) ? $param['time_end'] : '23:59',
	],
	'tooltip' => esc_attr__( 'Specify what to time of the day to show the counter.', 'counter_box' ),
	'icon'    => '',
);

$set_dates = array(
	'label'   => esc_attr__( 'Set Dates', 'counter_box' ),
	'attr'    => [
		'name'  => 'param[set_dates]',
		'id'    => 'set_dates',
		'value' => isset( $param['set_dates'] ) ? $param['set_dates'] : '',
	],
	'tooltip' => esc_attr__( 'Check this if you want to set the show counter between dates.', 'counter_box' ),
	'icon'    => '',
	'func'    => 'setDate',
);

$date_start = array(
	'label'   => esc_attr__( 'Date Start', 'counter_box' ),
	'attr'    => [
		'name'  => 'param[date_start]',
		'id'    => 'date_start',
		'value' => isset( $param['date_start'] ) ? $param['date_start'] : '',
	],
	'tooltip' => esc_attr__( 'Set the date start.', 'counter_box' ),
	'icon'    => '',
);

$date_end = array(
	'label'   => esc_attr__( 'Date End', 'counter_box' ),
	'attr'    => [
		'name'  => 'param[date_end]',
		'id'    => 'date_end',
		'value' => isset( $param['date_end'] ) ? $param['date_end'] : '',
	],
	'tooltip' => esc_attr__( 'Set the date end', 'counter_box' ),
);


//endregion

//region Users Role
$item_user = array(
	'label'   => esc_attr__( 'Show for users', 'counter_box' ),
	'attr'    => [
		'name'  => 'param[item_user]',
		'id'    => 'item_user',
		'value' => isset( $param['item_user'] ) ? $param['item_user'] : '',
	],
	'options' => [
		'1' => esc_attr__( 'All Users', 'counter_box' ),
		'2' => esc_attr__( 'Authorized Users', 'counter_box' ),
		'3' => esc_attr__( 'Unauthorized Users', 'counter_box' ),
	],
	'icon'    => '',
	'func'    => 'userRole()',
);

// Users role
$add_users      = array( 'all' => array( 'name' => esc_attr__( 'All Users', 'counter_box' ) ) );
$editable_role  = array_reverse( get_editable_roles() );
$editable_roles = array_merge( $add_users, $editable_role );
$users_arr      = array();
foreach ( $editable_roles as $role => $details ) {
	$name                           = translate_user_role( $details['name'] );
	$users_arr[ esc_attr( $role ) ] = $name;
}

$user_role = array(
	'label'   => esc_attr__( 'User Role', 'counter_box' ),
	'attr'    => [
		'name'  => 'param[user_role]',
		'id'    => 'user_role',
		'value' => isset( $param['user_role'] ) ? $param['user_role'] : 'all',
	],
	'options' => $users_arr,
);
//endregion

//region languages
$language = array(
	'label'    => esc_attr__( 'Language dependency', 'counter_box' ),
	'checkbox' => [
		'name'  => 'param[language_checkbox]',
		'id'    => 'language_checkbox',
		'class' => 'checkLabel',
		'value' => isset( $param['language_checkbox'] ) ? $param['language_checkbox'] : 0,
	],
	'attr'     => [
		'name'  => 'param[language]',
		'id'    => 'language',
		'value' => isset( $param['language'] ) ? $param['language'] : 'en',
	],
	'options'  => [
		'ar'  => '??????????????',
		'az'  => 'Az??rbaycan dili',
		'bg'  => '??????????????????',
		'bn'  => '???????????????',
		'bs'  => 'Bosanski',
		'ca'  => 'Catal??',
		'ceb' => 'Cebuano',
		'cs'  => '??e??tina???',
		'cy'  => 'Cymraeg',
		'da'  => 'Dansk',
		'de'  => 'Deutsch',
		'el'  => '????????????????',
		'en'  => 'English',
		'eo'  => 'Esperanto',
		'es'  => 'Espa??ol',
		'et'  => 'Eesti',
		'eu'  => 'Euskara',
		'fa'  => '??????????',
		'fi'  => 'Suomi',
		'fr'  => 'Fran??ais',
		'gd'  => 'G??idhlig',
		'gl'  => 'Galego',
		'haz' => '?????????? ????',
		'he'  => '????????????????',
		'hi'  => '??????????????????',
		'hr'  => 'Hrvatski',
		'hu'  => 'Magyar',
		'hy'  => '??????????????',
		'id'  => 'Bahasa Indonesia',
		'is'  => '??slenska',
		'it'  => 'Italiano',
		'ja'  => '?????????',
		'ka'  => '?????????????????????',
		'ko'  => '?????????',
		'lt'  => 'Lietuvi?? kalba',
		'mk'  => '???????????????????? ??????????',
		'mr'  => '???????????????',
		'ms'  => 'Bahasa Melayu',
		'my'  => '???????????????',
		'nb'  => 'Norsk bokm??l',
		'nl'  => 'Nederlands',
		'nn'  => 'Norsk nynorsk',
		'oc'  => 'Occitan',
		'pl'  => 'Polski',
		'ps'  => '????????',
		'pt'  => 'Portugu??s',
		'ro'  => 'Rom??n??',
		'ru'  => '??????????????',
		'sk'  => 'Sloven??ina',
		'sl'  => 'Sloven????ina',
		'sq'  => 'Shqip',
		'sr'  => '???????????? ??????????',
		'sv'  => 'Svenska',
		'th'  => '?????????',
		'tl'  => 'Tagalog',
		'tr'  => 'T??rk??e',
		'ug'  => 'Uy??urq??',
		'uk'  => '????????????????????',
		'vi'  => 'Ti???ng Vi???t',
		'zh'  => '????????????',
	],
	'tooltip'  => esc_attr__( 'Choose the language in which the counter will be displayed.', 'counter_box' ),
);
//endregion


