<?php
/**
 * Manna Network.
 *
 * @link              https://manna-Network.com
 * @since             1.0.0
 * @package           Mannanetwork
 *
 * @wordpress-plugin
 * Plugin Name:       Manna Network
 * Plugin URI:        https://github.com/MannaNetwork/wp_plugin
 * Description:       Manna Network is a "distributed" web directory and monetization system that pools and aggregates the web traffic of the installation sites into a larger, more valuable product (i.e. to the advertisers) and then enables each site as an agent to sell the aggregate for both short and long-term income.
 * Version:           1.0.0
 * Author:            Robert Lefebvre
 * Author URI:        https://manna-Network.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mannanetwork
 * Domain Path:       /languages
 */
 function mytheme_enqueue_style() {
	/**
* Enqueue CSS
*/
	wp_enqueue_style( 'mannamainstyle', plugin_dir_url( __DIR__ ) . 'manna-network/css/styles.css', '', '1.01' );
	wp_enqueue_style( 'cssmenustyle1', plugin_dir_url( __DIR__ ) . 'manna-network/css/reset.min.css', '', '1.01' );
	wp_enqueue_style( 'cssmenustyle2', plugin_dir_url( __DIR__ ) . 'manna-network/css/style.min.css', '', '1.01' );
	wp_enqueue_style( 'cssmenustyle3', plugin_dir_url( __DIR__ ) . 'manna-network/css/ionicon.min.css', '', '1.01' );

/*	<link rel="stylesheet" type="text/css" href="./css/reset.min.css">
      <link rel="stylesheet" type="text/css" href="./css/style.min.css">
      <link rel="stylesheet" type="text/css" href="./css/ionicon.min.css"> */

}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_style' );



function mannanetwork_create_menu() {
	/**
* Create new top-level menu
*/
	add_menu_page( 'MannaNetwork', 'MannaNetwork', 'administrator', __DIR__, 'mannanetwork_settings_page', get_stylesheet_directory_uri( 'stylesheet_directory' ) . '/images/media-button-other.gif' );
add_submenu_page( 'MannaNetwork', 'MannaNetwork', 'administrator', __DIR__, 'mannanetwork_settings_page', get_stylesheet_directory_uri( 'stylesheet_directory' ) . '/images/media-button-other.gif' );

	/* Call register settings function */
	add_action( 'admin_init', 'register_manna_member' );
}

 
add_action( 'admin_menu', 'mannanetwork_create_menu' );

function register_manna_member() {
	/**
	* Register our settings
	*/
	register_setting( 'manna_member-group', 'mn_local_lnk_num' );
	register_setting( 'manna_member-group', 'mn_agent_id' );
	register_setting( 'manna_member-group', 'mn_agent_url' );
	register_setting( 'manna_member-group', 'mn_agent_folder' );
	register_setting( 'manna_member-group', 'wp_page_name' );
	register_setting( 'manna_member-group', 'installer_id' );
/* note - this is used in the registration form instead of $_SESSION */
	register_setting( 'manna_member-group', 'captcha' );
/* non-menu (like  hidden var) - */
register_setting( 'manna_member-group', 'plugin_is_registered' );
	
}

function mannanetwork_settings_page() {
	/**
	* Create our options/settings
	*/

//First, check mn in the temp and approved tables for the url
$file = 'http://exchange.manna-network.com/incoming/check_if_registered.php';
if ( strpos( get_site_url(), 'https://' ) !== false ) {
	$http_host = str_replace( 'https://', '', get_site_url() );
} elseif ( strpos( get_site_url(), 'http://' ) !== false ) {
	$http_host = str_replace( 'http://', '', get_site_url() );
}
//fake test ul
//$http_host = "https://test5.manna-network.com";
	$response = wp_remote_post(
		$file,
		array(
			'method'      => 'POST',
			'timeout'     => 45,
			'redirection' => 5,
			'httpversion' => '1.0',
			'blocking'    => true,
			'headers'     => array(),
			'body'        => array(
				'http_host' => $http_host,
			),
			'cookies'     => array(),
		)
	);

	if ( is_wp_error( $response ) ) {
		$error_message = esc_attr( $response->get_error_message() );
		echo 'Something went wrong 102: (' . esc_attr( $error_message ) . ' )';
	} else {
		$mn_reg_status = esc_attr( $response['body'] ) ;

//echo '<br>$config_error = ',$config_error;
if($mn_reg_status =="empty"){

include('translations/en_no_registration.php')  ;
exit();
}
elseif($mn_reg_status =="temp"){
$file = 'http://exchange.manna-network.com/incoming/install_get_temp.php';
include('translations/en_is_temp.php');
	$response = wp_remote_post(
		$file,
		array(
			'method'      => 'POST',
			'timeout'     => 45,
			'redirection' => 5,
			'httpversion' => '1.0',
			'blocking'    => true,
			'headers'     => array(),
			'body'        => array(
				'http_host' => $http_host,
			),
			'cookies'     => array(),
		)
	);

	if ( is_wp_error( $response ) ) {
		$error_message = esc_attr( $response->get_error_message() );
		echo 'Something went wrong 102: (' . esc_attr( $error_message ) . ' )';
	} else {
	//	$mn_data = esc_attr( $response['body'] ) ;
$mn_data =  $response['body']  ;
//echo '<br> In mannanetwok.phpline 170 $response[body] from exchange.manna-network.com/incoming/check_if_registered.php =', $mn_data;
$decode = json_decode($mn_data, true);
//echo '<br>139 decode = :', $decode;
//print_r($decode);
//echo '<br>139 decode = :', $decode;
//echo '$decode remote_link_id = ', $decode['remote_link_id'];
$local_wp_link_id = $decode['remote_link_id'];//the data base at MN records the wp_link id as the site's "remote" link id [i.e. it is remote to the MN system)
$mn_agent_id = $decode['agent_id'];
$mn_installer_id = $decode['installer_id'];


}
}
else
{
//is approved
$file = 'http://exchange.manna-network.com/incoming/install_get_bridge.php';
if ( strpos( get_site_url(), 'https://' ) !== false ) {
	$http_host = str_replace( 'https://', '', get_site_url() );
} elseif ( strpos( get_site_url(), 'http://' ) !== false ) {
	$http_host = str_replace( 'http://', '', get_site_url() );
}

	$response = wp_remote_post(
		$file,
		array(
			'method'      => 'POST',
			'timeout'     => 45,
			'redirection' => 5,
			'httpversion' => '1.0',
			'blocking'    => true,
			'headers'     => array(),
			'body'        => array(
				'http_host' => $http_host,
			),
			'cookies'     => array(),
		)
	);

	if ( is_wp_error( $response ) ) {
		$error_message = esc_attr( $response->get_error_message() );
		echo 'Something went wrong 102: (' . esc_attr( $error_message ) . ' )';
	} else {
		//$mn_data = esc_attr( $response['body'] ) ;
$decode =  json_decode($response['body'], true)  ;
$local_wp_link_id =$decode['remote_lnk_num'];
$mn_agent_id = $decode['agent_ID'];
$mn_installer_id = $decode['installer_id'];

}
}
//is approved
$file = 'http://exchange.manna-network.com/incoming/install_get_agent_url_folder.php';
if ( strpos( get_site_url(), 'https://' ) !== false ) {
	$http_host = str_replace( 'https://', '', get_site_url() );
} elseif ( strpos( get_site_url(), 'http://' ) !== false ) {
	$http_host = str_replace( 'http://', '', get_site_url() );
}

	$response = wp_remote_post(
		$file,
		array(
			'method'      => 'POST',
			'timeout'     => 45,
			'redirection' => 5,
			'httpversion' => '1.0',
			'blocking'    => true,
			'headers'     => array(),
			'body'        => array(
				'agent_ID' => $mn_agent_id,
			),
			'cookies'     => array(),
		)
	);

	if ( is_wp_error( $response ) ) {
		$error_message = esc_attr( $response->get_error_message() );
		echo 'Something went wrong 102: (' . esc_attr( $error_message ) . ' )';
	} else {
		//$mn_data = esc_attr( $response['body'] ) ;
$mn_data =  $response['body']  ;
//echo '<br> In line 214 mannanetwork.php $response[body] from exchange.manna-network.com/incoming/install_get_bridge.php =', $response['body'], '<br>';

$agent_decode = json_decode($mn_data, true);
$mn_agent_url =$agent_decode[0]['agent_url'];
$mn_agent_folder = $agent_decode[0]['foldername'];
}



//now display to configuration data of the site we found
include('translations/en.php')  ;
?>	
<div class="wrap">
<style type="text/css">span.dropt {border-bottom: thin dotted; background: #ffeedd;}
span.dropt:hover {text-decoration: none; background: #ffffff; z-index: 6; }
span.dropt span {position: absolute; left: -9999px;
  margin: 20px 0 0 0px; padding: 3px 3px 3px 3px;
  border-style:solid; border-color:black; border-width:1px; z-index: 6;}
span.dropt:hover span {left: 2%; background: #ffffff;} 
span.dropt span {position: absolute; left: -9999px;
  margin: 4px 0 0 0px; padding: 3px 3px 3px 3px; 
  border-style:solid; border-color:black; border-width:1px;}
span.dropt:hover span {margin: 20px 0 0 170px; background: #ffffff; z-index:6;} " style="span.dropt {border-bottom: thin dotted; background: #ffeedd;}
span.dropt:hover {text-decoration: none; background: #ffffff; z-index: 6; }
span.dropt span {position: absolute; left: -9999px;
  margin: 20px 0 0 0px; padding: 3px 3px 3px 3px;
  border-style:solid; border-color:black; border-width:1px; z-index: 6;}
span.dropt:hover span {left: 2%; background: #ffffff;} 
span.dropt span {position: absolute; left: -9999px;
  margin: 4px 0 0 0px; padding: 3px 3px 3px 3px; 
  border-style:solid; border-color:black; border-width:1px;}
span.dropt:hover span {margin: 20px 0 0 170px; background: #ffffff; z-index:6;} </style>
<?php 
$current_url = $_SERVER['REQUEST_URI'] ;
/* if(isset($_POST[submit])){
//POST = Array ( [option_page] => manna_member-group [action] => update [_wpnonce] => 1347a914bb [_wp_http_referer] => /wp-admin/admin.php?page=manna-network [wp_user_id] => 202 [mn_agent_id] => 17 [mn_agent_url] => 1stbitcoinbank.com [mn_agent_folder] => manna_network [installer_id] => 1 [wp_page_name] => [submit] => Save Changes ) 

if(isset($_POST['mn_local_lnk_num']) && is_numeric($_POST['mn_local_lnk_num'])){

update_option( 'mn_local_lnk_num',  $_POST['mn_local_lnk_num']);
}   
if(isset($_POST['mn_agent_id']) && is_numeric($_POST['mn_agent_id'])){
update_option( 'mn_agent_id', $_POST['mn_agent_id']);
}

		update_option( 'mn_agent_url', 'change_me');
		update_option( 'mn_agent_folder','change_me');
		update_option( 'wp_page_name', 'change_me');
		update_option( 'installer_id' , 'change_me');
		update_option( 'plugin_is_registered' , 'no');

echo '<br>POST = ';
print_r($_POST);
}
else
{ */
?>
<!--<form method="post" action="<?php echo $current_url;?>">-->
<form method="post" action="../wp-content/plugins/manna-network/options.php">

	<?php

/*	settings_fields( 'manna_member-group' );
	 do_settings_sections( 'manna_member-group' ); 
*/
$wp_user_id = get_current_user_id();
?>
	
<?php
if($config_error == "true"){
echo 'need a message line 339';
}
else
{
?>
<script>
var blink_speed = 1000; // every 1000 == 1 second, adjust to suit
var t = setInterval(function () {
    var ele = document.getElementById('myBlinkingDiv');
    ele.style.visibility = (ele.style.visibility == 'hidden' ? '' : 'hidden');
}, blink_speed)
</script>	

<table class="form-table">
		<tr valign="top">
		<th scope="row" colspan="3"> Configuration</th></tr>
<tr><td colspan="3"><h3 style="color:red;">We have retrieved the following information about your website and inserted it in the form below for your convenience. The values in the "Current Settings" column should match those in the "Suggested Settings" column then submit the form. <br>IMPORTANT! Correct information is essential for you to receive your commissions!<br> You are responsible to verify the accuracy of the info. They should match those you view by logging into your advertiser's admin page at <a target="_blank" href="https://<?php echo $mn_agent_url."/".$mn_agent_folder.'/manna-network/members">https://'.  $mn_agent_url."/".$mn_agent_folder.'/manna-network/members></a>';?> (then click the "Get Better Placement" button to see the settings in the left column)</h3></td></tr>

<tr><td>&nbsp;</td><td>Current<br>Settings</td><td>Suggested<br>Settings *</td></tr>
<tr><td>Your Link ID -> </td><td><?php echo get_option( 'mn_local_lnk_num' ); ?></td><td><input style ="border-style: none;background-color: darkred;color: white;font-weight: bold;padding-left: 2px;" type="text" name="mn_local_lnk_num" value="<?php echo esc_attr( $local_wp_link_id ); ?>" /></td></tr>
<tr><td>Agent ID -> </td><td><?php echo esc_attr( get_option( 'mn_agent_id') ); ?></td><td><input style ="border-style: none;background-color: darkred;color: white;font-weight: bold;padding-left: 2px;" type="text" name="mn_agent_id" value="<?php echo esc_attr( $mn_agent_id ); ?>" /></td></tr>
<tr><td>Agent url -> </td><td><?php echo esc_attr( $mn_agent_url ); ?></td><td><input style ="border-style: none;background-color: darkred;color: white;font-weight: bold;padding-left: 2px;" type="text" name="mn_agent_url" value="<?php echo esc_attr( $mn_agent_url ); ?>" /></td></tr>
<tr><td>Agent folder name -> </td><td><?php echo esc_attr( $mn_agent_folder ); ?></td><td><input style ="border-style: none;background-color: darkred;color: white;font-weight: bold;padding-left: 2px;" type="text" name="mn_agent_folder" value="<?php echo esc_attr( $mn_agent_folder ); ?>" /></td></tr>
<tr><td>Manna Network Installer ID -> </td><td><?php echo esc_attr( $mn_installer_id ); ?></td><td><input style ="border-style: none;background-color: darkred;color: white;font-weight: bold;padding-left: 2px;" type="text" name="installer_id" value="<?php echo esc_attr( $mn_installer_id ); ?>" /></td></tr>
<tr><td><p>

	<?php submit_button(); ?>
	
</td></tr>	</table>
</form>
<?php
//}
}
?>
</div>
	<?php

}
}
function mannanetwork_func( $atts ) {
	/**
	* Manna network func
	*/
	include 'mannanetwork-main.php';
	return '';
}

define( 'MN_DIR_ROOT', dirname( __FILE__ ) . '/' );
list($url) = explode( '/', plugin_basename( __FILE__ ) );
define( 'MN_DIR_URL', '/wp-content/plugins/' . $url . '/' );
define( 'MN_DIR_MOREINFO', 'http://www.Manna-Network.com/' );

add_shortcode( 'mannanetwork', 'mannanetwork_func' );

