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
 //echo 'plugin_dir_url( __DIR__ ) = ', plugin_dir_url( __DIR__ );
function mytheme_enqueue_style() {
	/**
* Enqueue CSS
*/
	wp_enqueue_style( 'mytheme-style', plugin_dir_url( __DIR__ ) . 'manna-network/css/styles.css', '', '1.01' );

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
//XXXXXXXXXXXXXXXXXXXXXX New Code XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

If(get_option( 'plugin_is_registered' ) === 'yes' ){
$show_reports = 'true';
}
else
{
$show_reports = 'false';
}

if($_GET['plugin_is_registered']==='yes'){
$show_reports = 'true';
}
else
{
$show_reports = 'false';
}

If($show_reports == 'true'){
include('accordian/packed.js');
include('accordian/script.js');
include('accordian/style.css');
?>
<div id="options">
	<a href="javascript:parentAccordion.pr(1)">Exand All</a> | <a href="javascript:parentAccordion.pr(-1)">Collapse All</a>
</div>
<ul class="acc" id="acc">
	<li>
		<h3>Manna Network Member's Reports</h3>
		<div class="acc-section">
			<div class="acc-content">
				<ul class="acc" id="nested">
					<li>
						<h3>Registered Advertisers</h3>
						<div class="acc-section">
							<div class="acc-content">
								Donec elementum lobortis lorem. Sed aliquet lacus vitae nibh. Sed ullamcorper pharetra augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
							</div>
						</div>
					</li>
					<li>
						<h3>Advertisers Upgraded To Membership</h3>
						<div class="acc-section">
							<div class="acc-content">
								Vestibulum blandit mauris elementum mauris.
							</div>
						</div>
					</li>
					<li>
						<h3>Income</h3>
						<div class="acc-section">
							<div class="acc-content">
								Morbi felis libero, porta non, sagittis ac, consectetur in, sem.
							</div>
						</div>
					</li>
				</ul>				
			</div>
		</div>
	</li><li>
		<h3>Manna Network Network Stats</h3>
		<div class="acc-section">
			<div class="acc-content">
				To initialize an accordion use the following code:<br /><br />
				<code>
					var accordion=new TINY.accordion.slider(&quot;accordion&quot;);<br />
					accordion.init(&quot;accordion&quot;,&quot;h3&quot;,false,0,&quot;selected&quot;);
				</code><br /><br />
				You must create a new accordion object before initialization. The parameter taken by accordion.slider is the variable name used for the object. The object.init function takes 5 parameters: the id of the accordion ul, the header element tag, whether the panels should be expandable independently (optional), the index of the initially expanded section (optional) and the class for the active header (optional).
			</div>
		</div>
	</li>
	<li>
		<h3>Support & Training</h3>
		<div class="acc-section">
			<div class="acc-content">
				This script is provided as-is with no warranty or guarantee. It is available at no cost for any project, non-commercial or commercial. Paid support is available by <a href="http://www.leigeber.com/contact/">clicking here</a>
			</div>
		</div>
	</li>
</ul> 

<script type="text/javascript" src="script.js"></script>

<script type="text/javascript">

var parentAccordion=new TINY.accordion.slider("parentAccordion");
parentAccordion.init("acc","h3",0,0);

var nestedAccordion=new TINY.accordion.slider("nestedAccordion");
nestedAccordion.init("nested","h3",1,-1,"acc-selected");

</script>

<?php
exit();
}
else //is in configuration mode
{
	//1st, check if is in bridge table - means the site has also been approved
$file = 'http://exchange.manna-network.com/incoming/get_bridge_row.php';
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
		
		
	echo '<br>$response[\'body\']<br>';	
	print_r($response['body']);	
		
 $mn_reg_status = json_decode($response['body'], true);
 
	
if($mn_reg_status !=="empty"){
//returns  Array ( [0] => Array ( [remote_lnk_num] => 1 [0] => 1 [agent_ID] => 25 [1] => 25 [agent_url] => orlandoreferralgroup.com [2] => orlandoreferralgroup.com [foldername] => manna_network [3] => manna_network ) ) 
	$agent_ID = $mn_reg_status[0]['agent_ID'];
	$remote_lnk_num = $mn_reg_status[0]['remote_lnk_num'];
	//$foldername = $mn_reg_status[0]['foldername'];
	}
	else
	{
	
	//if (no result from first query)
	
	//Check if is in tempusers
if (array_key_exists ( "http_host" , $_POST ) AND isset($_POST["http_host"])) {
$http_host=$_POST['http_host'];
}
$file = 'http://exchange.manna-network.com/incoming/get_temp_row.php';
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
		
		
	echo '<br><br>';	
	print_r($response['body']);	
	
	}
}
}//close 2nd if
}//close configure

//XXXXXXXXXXXXXXXXXXXXX  END NEW CODE   XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

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
				'agent_ID' => $agent_ID,
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
$agent_decode = json_decode($response['body'], true);
$mn_agent_url =$agent_decode[0]['agent_url'];
$mn_agent_folder = $agent_decode[0]['foldername'];
}



//now display to configuration data of the site we found
if (!defined('REGISTRATION_CATEGORY_HEADING')) {
include('translations/en.php')  ;
}
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
?>

<form method="post" action="../wp-content/plugins/manna-network/options.php">

	<?php
$wp_user_id = get_current_user_id();

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
<tr><td colspan="3"><h3 style="color:red;">We have retrieved the following information about your website and inserted it in the form below for your convenience. <br>IMPORTANT! Correct information is essential for you to receive your commissions!<br> You are responsible to verify the accuracy of the info. They should match those you view by logging into your advertiser's admin page at <a target="_blank" href="https://<?php echo $mn_agent_url."/".$mn_agent_folder.'/manna-network/members">https://'.  $mn_agent_url."/".$mn_agent_folder.'/manna-network/members></a>';?> (then click the "Get Better Placement" button to see the settings in the left column)</h3></td></tr>

<tr><td>&nbsp;</td><td>Suggested<br>Settings *</td></tr>
<tr><td>Your Link ID -> </td><td><input style ="border-style: none;background-color: darkred;color: white;font-weight: bold;padding-left: 2px;" type="text" name="mn_local_lnk_num" value="<?php echo esc_attr( $remote_lnk_num ); ?>" /></td></tr>
<tr><td>Agent ID -> </td><td><input style ="border-style: none;background-color: darkred;color: white;font-weight: bold;padding-left: 2px;" type="text" name="mn_agent_id" value="<?php echo esc_attr( $agent_ID ); ?>" /></td></tr>
<tr><td>Agent url -> </td><td><input style ="border-style: none;background-color: darkred;color: white;font-weight: bold;padding-left: 2px;" type="text" name="mn_agent_url" value="<?php echo esc_attr( $mn_agent_url ); ?>" /></td></tr>
<tr><td>Agent folder name -> </td></td><td><input style ="border-style: none;background-color: darkred;color: white;font-weight: bold;padding-left: 2px;" type="text" name="mn_agent_folder" value="<?php echo esc_attr( $mn_agent_folder ); ?>" /></td></tr>
<tr><td><p>

	<?php submit_button(); ?>
	
</td></tr>	</table>
</form>
</div>
	<?php
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

