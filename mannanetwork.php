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
 * Version:           1.0.0-st1
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
  wp_enqueue_style( 'mytheme-style', plugin_dir_url( __DIR__ ) . 'manna-network/css/manna_network.css', '', null );

}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_style' );


function mannanetwork_create_menu() {
  /**
* Create new top-level menu
*/
  add_menu_page( 'MannaNetwork', 'MannaNetwork', 'administrator', __DIR__, 'mannanetwork_settings_page', get_stylesheet_directory_uri( 'stylesheet_directory' ) . '/images/media-button-other.gif' );

  /* Call register settings function */
}
add_action( 'admin_menu', 'mannanetwork_create_menu' );
/*
function mannanetwork_enqueue_scripts() {
	wp_enqueue_script( 'mannanetwork-main-js', plugin_dir_url( __FILE__ ) . '/js/mn_enque.js', [], null, true );
	
}


add_action( 'wp_enqueue_scripts', 'mannanetwork_enqueue_scripts', 100 );
*/
function mannanetwork_settings_page() {
  /**
  * Create our options/settings
  */
  if(is_multisite()){
  $blog_id = get_blog_option($blog_id,'siteurl');
   $blog_details = get_blog_details(1);
  // if (!defined('MNPREFX')) {
  define("MNPREFX","mn_".$blog_details->blog_id);
   // }
}else{
//handle regular WP
//if (!defined('MNPREFX')) {
define("MNPREFX","mn_");
//}
}
if(get_option('mn_agent_confgs')){
$mn_agent_confgs = get_option('mn_agent_confgs');
$ex = explode(",", $mn_agent_confgs);
$mn_agent_url = $ex[0];
$mn_agent_folder = $ex[1];
$mn_agent_id = $ex[2];
}
if(get_option(MNPREFX.'plgn_confgs')){
$mn_plgn_confgs = get_option(MNPREFX.'plgn_confgs');
$ex2 = explode(",", $mn_plgn_confgs);
$mn_remote_link_id = $ex2[0];
$mn_pgn8tr_menu_items = $ex2[1];
$mn_installer_id = $ex2[2];
$mn_widg_id = $ex2[3];
$plugin_is_registered = $ex2[4];
$contact_us = $ex2[5];
$page_name = $ex2[6];
$meetup = $ex2[7];
}
else
{
$plugin_is_registered = "";
}
if (!defined('REGISTRATION_CATEGORY_HEADING')) {
include('translations/en.php')  ;
}

if(isset($_POST['set_wp_options'])){
echo SET_OPTIONS_SUCCESS;
echo SET_OPTIONS_REFRESH;

 $file     = 'https://exchange.manna-network.com/incoming/insert_widget_to_mn.php';
 //dev note: The WP function get_site_url() retieves the protocol. Some tables (like the widgets table in this case) store the url WITH the protocol included. Other tables do not and the url needs streplace performed on it to remove the protocol
     $response = wp_remote_post($file,
                    array(
                        'method'      => 'POST',
                        'timeout'     => 45,
                        'redirection' => 5,
                        'httpversion' => '1.0',
                        'blocking'    => true,
                        'headers'     => array(),
                        'body'        => array(
                        'url'       => get_site_url(),
                        'remote_link_id'       => $_POST['mn_remote_link_id'], 
			'agent_id'       => $_POST['mn_agent_id'],
			'installer_id'       => $_POST['mn_installer_id'], 
			),
                        'cookies'     => array(),
                    )
                );
                        if ( is_wp_error( $response ) ) {
                            $error_message = esc_attr( $response->get_error_message() );
                            echo 'Something went wrong - inserting widget: (' . esc_attr( $error_message ) . ' )';
                        } else {
                        $widg_info =  json_decode($response['body'], true);
                        if(is_numeric($widg_info)){
	update_option('mn_agent_confgs',$_POST['mn_agent_url'].','.$_POST['mn_agent_folder'].','.$_POST['mn_agent_id']);
update_option(MNPREFX.'plgn_confgs',$_POST['mn_remote_link_id'].','.$_POST['mn_pgn8tr_menu_items'].','.$_POST['mn_installer_id'].','.$widg_info.',yes'.','.$_POST['contact_us'].','.$_POST['page_name'].','.$_POST['meetup']); 
		                }
		               else
		              {
		               echo '<br>ERROR: Did not receive widget info back from exchange'; 
		                }
                        } 

}
elseif(array_key_exists('reset', $_POST) && isset($_POST['reset'])){
   // delete_option( MNPREFX.'plugin_is_registered');
    delete_option('mn_agent_confgs');
delete_option(MNPREFX.'plgn_confgs'); 

echo '<h2>Your configurations have been cleared</h2>';
echo '<h3>Please refresh the page to reset (be sure to click the "Save Changes" button)</h3>';	
}
elseif($plugin_is_registered === 'yes' ){
/*configuration is complete ... display the reports section */
include('accordian/packed.js');
include('accordian/script.js');
include('accordian/style.css');
?>
<div id="options">
	<a href="javascript:parentAccordion.pr(1)">Expand All</a> | <a href="javascript:parentAccordion.pr(-1)">Collapse All</a>
</div>
<ul class="acc" id="acc">
	<li>
		<h3>Manna Network Member's Reports</h3>
		<div class="acc-section">
			<div class="acc-content">
				<ul class="acc" id="nested">
					<li>
						<h3>Plugin Configurations</h3>
						<div class="acc-section">
							<div class="acc-content">
								This section reports the configurations currently used by the plugin.
							</div>
						</div>
					</li>
	<li>
		<h3>Manna Network Member's Reports</h3>
		<div class="acc-section">
			<div class="acc-content">
				<ul class="acc" id="nested">
					<li>
						<h3>Registered Advertisers</h3>
						<div class="acc-section">
							<div class="acc-content">
								This section reports the number of advertisers (i.e. in the network) that registered AT YOUR SITE.
							</div>
						</div>
					</li>
					<li>
						<h3>Advertisers Upgraded To Membership</h3>
						<div class="acc-section">
							<div class="acc-content">
								Reports the percentage of those registered advertisers that took the extra step of installing the web directory on their own site (note: each advertiser that does so increases the amount of web traffic the network can deliver to advertisers and makes it more valuable [thus increasing bids]. 
							</div>
						</div>
					</li>
					<li>
						<h3>Income</h3>
						<div class="acc-section">
							<div class="acc-content">
								<h4>Income From Advertising Sales (sic. commissions)</h4>
								You receive 50% of whatever amount advertisers pay and for as long as they continue. Your income goes up (or down) as they change their bids.
								<h4>Income From Overrides</h4>
								If and/or when an advertiser adds a directory to their own site they receive their own commissions from their sales but you will also receive an override commission on their sales (this is done because the advertiser joined the network as a result of you introducing the Manna Network to them).
							</div>
						</div>
					</li>
					<li>
						<h3>Get Better Ad Placement</h3>
						<div class="acc-section">
							<div class="acc-content">
								Since EVERY website operator listed in the directory wants the top listing position, the Manna Network designed a bidding system to enable them to compete for the limited top positions. This competition for the best placement means those that receive commissions share those higher earnings.
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
				This section will display stats of the Manna Network (for example, the number of advertisers, the number of directory/plugin installations, gross commissions earned, commissions paid etc). 
			</div>
		</div>
	</li>
	<li>
		<h3>Support & Training</h3>
		<div class="acc-section">
			<div class="acc-content">
				<ul class="acc" id="nested">
					<li>
						<h3>Your Current Configuration Settings</h3>
						<div class="acc-section">
							<div class="acc-content">
							<?php
								echo '<br>$mn_agent_url = ',$mn_agent_url;
echo '<br>$mn_agent_folder = ',$mn_agent_folder;
echo '<br>$mn_agent_id = ',$mn_agent_id;
echo '<br>$mn_remote_link_id = ',$mn_remote_link_id;
echo '<br>$mn_pgn8tr_menu_items = ',$mn_pgn8tr_menu_items;
echo '<br>$mn_installer_id = ',$mn_installer_id;
echo '<br>$mn_widg_id = ',$mn_widg_id ;
echo '<br>$plugin_is_registered = ',$plugin_is_registered;
echo '<br>$contact_us = ',$contact_us;
echo '<br>$page_name = ',$page_name;
echo '<br>$meetup = ',$meetup;

echo '<br>&nbsp;<br><form method="post" action=
            "'. htmlspecialchars($_SERVER['PHP_SELF']).'?page=manna-network">
           
            <input type="hidden" name="reset" value="true">
            
            <input type="submit" name="submit"
                   value="Reset Configurations">
        </form>
  ';
?>
							</div>
						</div>
					</li>
					<li>
						<h3>Add More Support Info</h3>
						<div class="acc-section">
							<div class="acc-content">
								Reports the percentage of those registered advertisers that took the extra step of installing the web directory on their own site (note: each advertiser that does so increases the amount of web traffic the network can deliver to advertisers and makes it more valuable [thus increasing bids]. 
							</div>
						</div>
					</li>
					<li>
						<h3>More Support</h3>
						<div class="acc-section">
							<div class="acc-content">
								<h4>Training 1</h4>
								You receive 50% of whatever amount advertisers pay and for as long as they continue. Your income goes up (or down) as they change their bids.
								<h4>Training 2</h4>
								If and/or when an advertiser adds a directory to their own site they receive their own commissions from their sales but you will also receive an override commission on their sales (this is done because the advertiser joined the network as a result of you introducing the Manna Network to them).
							</div>
						</div>
					</li>
					<li>
						<h3>Get Better Ad Placement</h3>
						<div class="acc-section">
							<div class="acc-content">
								Since EVERY website operator listed in the directory wants the top listing position, the Manna Network designed a bidding system to enable them to compete for the limited top positions. This competition for the best placement means those that receive commissions share those higher earnings.
							</div>
						</div>
					</li>
				</ul>
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
echo '<form method="post" action=
            "'. htmlspecialchars($_SERVER['PHP_SELF']).'?page=manna-network">
           
            <input type="hidden" name="reset" value="true">
            
            <input type="submit" name="submit"
                   value="Reset Configurations">
        </form>
  ';

}
else //is in configuration mode
{
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

//first check if plugin is registered at Manna Network

//checks if site is registered in either temp and/or mnbridge tables and advertiser bridge table (for unconfirmed email confirmation)
    $file = 'https://exchange.manna-network.com/incoming/check_if_registered.php';
  //    echo '<br>file = ', $file;
      $site_url =  get_site_url();
    $site_url =  str_replace("https://", "",$site_url);
    $site_url =  str_replace("http://", "",$site_url);
 //   echo '<br>in plugins mannanetwork.php $site_url = ', $site_url;
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
        'http_host' => $site_url
      ),
      'cookies'     => array(),
    )
  );

  if ( is_wp_error( $response ) ) {
    $error_message = esc_attr( $response->get_error_message() );
    echo 'Something went wrong 102: (' . esc_attr( $error_message ) . ' )';
  } else {
//echo '<br>in plugins mannanetwork.php $response[\'body\'] = ', $response['body'];
        $mn_reg_status = json_decode($response['body'], true);
         //now assign values to the regular vars used in the form
        $mn_reg_status = json_decode($response['body'], true);
       
        if(is_array($mn_reg_status)){
        $sites_reg_status = $mn_reg_status[0][0];
        }
        else
        {
        $sites_reg_status = $mn_reg_status;
        }

    $file = 'https://exchange.manna-network.com/incoming/getThisDomainsCount.php';
 // echo '<br>$file = ', $file;
      $site_url =  get_site_url();
    $site_url =  str_replace("https://", "",$site_url);
    $site_url =  str_replace("http://", "",$site_url);
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
        'http_host' => $site_url
      ),
      'cookies'     => array(),
    )
  );

  if ( is_wp_error( $response ) ) {
    $error_message = esc_attr( $response->get_error_message() );
    echo 'Something went wrong 102: (' . esc_attr( $error_message ) . ' )';
  } else {
echo '<br>in plugins mannanetwork.php $response[\'body\'] = ', $response['body'];
        $countNumAds = json_decode($response['body'], true);
        $countBridgeSites = $countNumAds[0][0];
        $countTempSites = $countNumAds[0][1];
        
        echo '<br>in plugins mannanetwork.php $countBridgeSites = ', $countBridgeSites;
         echo '<br>in plugins mannanetwork.php $countTempSites = ', $countTempSites;
         }
                require_once('translations/en.php');
           	if($sites_reg_status == "email"){
              	/*Give the email verification message and resend email link*/
		    $agent_decode = json_decode($response['body'], true);
                    $mn_agent_url =$agent_decode[0]['agent_url'];
                    $mn_agent_folder = $agent_decode[0]['agent_folder'];
                    $mn_remote_user_id =  $agent_decode[0]['remote_user_id'];
                    $file     = $mn_agent_url.'/'.$mn_agent_folder.'/manna-network/incoming/get_users_registration_info.php';
                    $response = wp_remote_post($file,
                    array(
                        'method'      => 'POST',
                        'timeout'     => 45,
                        'redirection' => 5,
                        'httpversion' => '1.0',
                        'blocking'    => true,
                        'headers'     => array(),
                        'body'        => array(
                            'user_id'       => $mn_remote_user_id,
                               
                        ),
                        'cookies'     => array(),
                    )
                );
                

                        if ( is_wp_error( $response ) ) {
                            $error_message = esc_attr( $response->get_error_message() );
                            echo 'Something went wrong - email not verified: (' . esc_attr( $error_message ) . ' )';
                        } else {
                        echo MESSAGE_CONFIGURATION_STATUS_HEADING;
                            $advertiser_info =  json_decode($response['body'], true);
  echo MESSAGE_RESEND_EMAIL1." ".$advertiser_info['website_url'].".".MESSAGE_RESEND_EMAIL2.$mn_agent_url.MESSAGE_RESEND_EMAIL3;
                            echo '<form action="'.$mn_agent_url.'/'.$mn_agent_folder.'/manna-network/members/resend_email_verification.php" method="post">';
                            echo '    <input type="hidden" name="resend" value="resend">
                            <input type="hidden" name="remote_user_id" value="'. $mn_remote_user_id.'">
                            <input type="hidden" name="user_activation_hash" value="'. $advertiser_info['user_activation_hash'].'">
                            <input type="hidden" name="remote_user_email" value="'. $advertiser_info['user_email'].'">
                            <input type="hidden" name="remote_user_url" value="'. $advertiser_info['website_url'].'">
                            <p><input type="submit" value="'.MESSAGE_RESEND_EMAIL_BUTTON.'"/></p>
                            </form>';
                          echo MESSAGE_RESEND_EMAIL_REFRESH;
                        }
           	} 
           	elseif($sites_reg_status == "not_registered"){
           	/*Wasn't found in any manna network table - must be unregisterd*/
echo '<table><tr><td>'.MESSAGE_NO_REGISTRATION_HEADING;
           	echo NO_REGISTRATION1.get_site_url().NO_REGISTRATION2;
           	echo '</td></tr></tr></table>';
           	}
           	elseif($sites_reg_status == "approved" OR $sites_reg_status == "temp"){
           	$mn_agent_ID = $mn_reg_status[0]['agent_ID'];
$mn_remote_link_id = $mn_reg_status[0]['remote_lnk_num'];
$mn_bridge_id = $mn_reg_status[0]['bridge_id'];
$mn_remote_user_id = $mn_reg_status[0]['remote_user_id'];
$mn_installer_id = $mn_reg_status[0]['installer_id'];//IMPORTANT: This is the widget_id of the site's PARENT. It will become this new widgets parent when the new install is inserted in the widgets table. We send it named "installer_id" in line 90.
           	$file = 'https://exchange.manna-network.com/incoming/install_get_agent_url_folder.php';
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
        'agent_ID' => $mn_reg_status[0]['agent_ID'],
      ),
      'cookies'     => array(),
    )
  );

        if ( is_wp_error( $response ) ) {
            $error_message = esc_attr( $response->get_error_message() );
            echo 'Something went wrong 337: (' . esc_attr( $error_message ) . ' )';
        } else {
                        $mn_data =  $response['body']  ;
                        $agent_decode = json_decode($response['body'], true);
                        $mn_agent_url =$agent_decode[0]['agent_url'];
                        $mn_agent_folder = $agent_decode[0]['foldername'];
                        }
                  

 
?>
<form method="POST" action="" name="set_wp_options" class="set_wp_options" id="set_wp_options">
<input type="hidden" name="set_wp_options" value="true">
<input type="hidden" name="page" value="manna-network">
<input type="hidden" name="mn_installer_id" value="<?php echo esc_attr( $mn_installer_id ); ?>">
<!-- DO NOT CONFUSE this installer_id for this plugin's widget_id! It is the id of this plugin's upline or parent and developer needs to make certain the value came from either the temp or mnbridge table! The value, here, is gotten from the saved wp_options. The value is inserted in options after it was gotten from temp or mnbridge.-->

<table class="form-table">
    <tr valign="top">
    <th scope="row" colspan="3"><?php echo CONFIGURATION_HEADING; ?></th></tr>
<tr><td colspan="3"><?php 

if(isset($mn_bridge_id)){
echo CONFIGURATION_FORM_MESSAGE1R; 
}
else
{
echo CONFIGURATION_FORM_MESSAGE1; 
}
?> 
<a target="_blank" href="https://<?php echo $mn_agent_url."/".$mn_agent_folder; ?>
/manna-network/members">https://
<?php echo  $mn_agent_url."/".$mn_agent_folder; ?>
/manna-network/members</a>
<?php
echo CONFIGURATION_FORM_MESSAGE2;
?>
</td></tr>
<tr><td>&nbsp;</td><td>Suggested<br>Settings *</td></tr>
<tr><td>Your Link ID -> </td><td><input style ="border-style: none;background-color: darkred;color: white;font-weight: bold;padding-left: 2px;" type="text" name="mn_remote_link_id" value="<?php echo esc_attr($mn_remote_link_id); ?>" /></td></tr>
<tr><td>Agent ID -> </td><td><input style ="border-style: none;background-color: darkred;color: white;font-weight: bold;padding-left: 2px;" type="text" name="mn_agent_id" value="<?php echo esc_attr($mn_agent_ID ); ?>" /></td></tr>
<tr><td>Agent url -> </td><td><input style ="border-style: none;background-color: darkred;color: white;font-weight: bold;padding-left: 2px;" type="text" name="mn_agent_url" value="<?php echo esc_attr( $mn_agent_url ); ?>" /></td></tr>
<tr><td>Agent folder name -> </td></td><td><input style ="border-style: none;background-color: darkred;color: white;font-weight: bold;padding-left: 2px;" type="text" name="mn_agent_folder" value="<?php echo esc_attr( $mn_agent_folder ); ?>" /></td></tr>
<tr><td>
Number of paginator menu items(i.e. number of pages displayed per row) -> </td></td><td><input style ="border-style: none;background-color: darkred;color: white;font-weight: bold;padding-left: 2px;" type="text" name="mn_pgn8tr_menu_items" value="10" /></td></tr>
  <tr><td><?php echo CONFIG_BLOKT_CONTACT_TITLE; ?> -> <span class="dropt" style="font-size: large;" title="<?php //echo CONFIG_BLOKT_CONTACT_MOUSEOVER; ?>"><img height="21" width="21" src="/wp-content/plugins/manna-network/images/green_arrow.png">
  <span style="width:500px;"><?php echo CONFIG_BLOKT_CONTACT_MESSAGE; ?></span></span></td><td><input style ="border-style: none;background-color: darkred;color: white;font-weight: bold;padding-left: 2px;" type="text" name="contact_us" value="" /></td></tr>
<tr><td><?php echo CONFIG_BLOKT_PGNAME_TITLE; ?> -> <span class="dropt" style="font-size: large;" title="<?php //echo CONFIG_BLOKT_PGNAME_MOUSEOVER; ?>"><img height="21" width="21" src="/wp-content/plugins/manna-network/images/green_arrow.png">
  <span style="width:500px;"><?php echo CONFIG_BLOKT_PGNAME_MESSAGE; ?></span></span></td><td><input style ="border-style: none;background-color: darkred;color: white;font-weight: bold;padding-left: 2px;" type="text" name="page_name" value="" /></td></tr>
  <tr><td><?php echo CONFIG_BLOKT_MEETUP_TITLE; ?> -> <span class="dropt" style="font-size: large;" title="<?php //echo CONFIG_BLOKT_MEETUP_MOUSEOVER; ?>"><img height="21" width="21" src="/wp-content/plugins/manna-network/images/green_arrow.png">
  <span style="width:500px;"><?php echo CONFIG_BLOKT_MEETUP_MESSAGE; ?></span></span></td><td><input style ="border-style: none;background-color: darkred;color: white;font-weight: bold;padding-left: 2px;" type="text" name="meetup" value="" /></td></tr>
  <tr><td>
<p>&nbsp;
</td></tr>
<tr><td>
<p>
  <?php submit_button(); ?>
</td></tr>
<tr><td>
<p>&nbsp;
</td></tr>

</table>
</form>
</div>
<?php
        } 
    }
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
define( 'MN_DIR_MOREINFO', 'https://www.Manna-Network.com/' );
add_shortcode( 'mannanetwork', 'mannanetwork_func' );
