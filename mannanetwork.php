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
print_r($_GET);

If(get_option( 'plugin_is_registered' ) === 'yes' ){

echo '<script>
document.addEventListener("DOMContentLoaded", function(event) {
  new MetisMenu(\'#menu1\');
  new MetisMenu(\'#menu2\', {
    toggle: false
  });
  new MetisMenu(\'#menu3\');
});
</script>';

echo 'Place reports here
- Number of advertisers registered
- Number of directories installed by them
- Number of paying advertisers
-- BSV
-- Demo coin
plugin_is_registered

Place a reconfigure"" button here too (probably only used IF they upgrade to enterprise level)';
echo '
<!-- Inspiration: https://dribbble.com/shots/4397812-Click-Me -->

<a href="?reconfigure=true" class="cta">
  <span>Click me</span>
  <svg width="13px" height="10px" viewBox="0 0 13 10">
    <path d="M1,5 L11,5"></path>
    <polyline points="8 1 12 5 8 9"></polyline>
  </svg>
</a>';

?>
<div class="row">
  <div class="col-md-3">
    <nav class="sidebar-nav">
    <ul class="metismenu" id="menu1">
      <li>
        <a class="has-arrow" href="#" aria-expanded="false">
          <span class="fa fa-fw fa-github fa-lg"></span>
          metisMenu
        </a>
        <ul>
          <li>
            <a href="https://github.com/onokumus/metismenujs">
              <span class="fa fa-fw fa-code-fork"></span> Fork
            </a>
          </li>
          <li>
            <a href="https://github.com/onokumus/metismenujs">
              <span class="fa fa-fw fa-star"></span> Star
            </a>
          </li>
          <li>
            <a href="https://github.com/onokumus/metismenujs/issues">
              <span class="fa fa-fw fa-exclamation-triangle"></span> Issues
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a class="has-arrow" href="#" aria-expanded="false">Menu 0</a>
        <ul>
          <li>
            <a href="#">item 0.1</a>
          </li>
          <li>
            <a href="#">item 0.2</a>
          </li>
          <li>
            <a href="http://onokumus.com">onokumus</a>
          </li>
          <li>
            <a href="#">item 0.4</a>
          </li>
        </ul>
      </li>
      <li id="removable">
        <a class="has-arrow" href="#" aria-expanded="false">Menu 1</a>
        <ul>
          <li>
            <a href="#">item 1.1</a>
          </li>
          <li>
            <a href="#">item 1.2</a>
          </li>
          <li>
            <a class="has-arrow" href="#" aria-expanded="false">Menu 1.3</a>
            <ul>
              <li>
                <a href="#">item 1.3.1</a>
              </li>
              <li>
                <a href="#">item 1.3.2</a>
              </li>
              <li>
                <a href="#">item 1.3.3</a>
              </li>
              <li>
                <a href="#">item 1.3.4</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#">item 1.4</a>
          </li>
          <li>
            <a class="has-arrow" href="#" aria-expanded="false">Menu 1.5</a>
            <ul>
              <li>
                <a href="#">item 1.5.1</a>
              </li>
              <li>
                <a href="#">item 1.5.2</a>
              </li>
              <li>
                <a href="#">item 1.5.3</a>
              </li>
              <li>
                <a href="#">item 1.5.4</a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      <li>
        <a class="has-arrow" href="#" aria-expanded="false">Menu 2</a>
        <ul>
          <li>
            <a href="#">item 2.1</a>
          </li>
          <li>
            <a href="#">item 2.2</a>
          </li>
          <li>
            <a href="#">item 2.3</a>
          </li>
          <li>
            <a href="#">item 2.4</a>
          </li>
        </ul>
      </li>
    </ul>    </nav>
  </div>
  <!-- /.col-md-3 -->
  <div class="col-md-9">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Auto Collapse <small>default</small></h5>
<pre><code class="language-javascript"><span class="hljs-built_in">document</span>.addEventListener(<span class="hljs-string">"DOMContentLoaded"</span>, <span class="hljs-function"><span class="hljs-keyword">function</span>(<span class="hljs-params">event</span>) </span>{
  <span class="hljs-keyword">new</span> MetisMenu(<span class="hljs-string">'#menu1'</span>);
});
</code></pre>

      </div>
    </div>
  </div>
  <!-- /.col-md-9 -->
</div>
<!-- /.row -->

<hr>

<?php
exit();
}
else //is in configuration mode
{
echo 'The current logged in user ID is: '.get_current_user_id();
    echo '<br>line 267 in mannanetwork - opening get bridge row_m';
  //1st, check if is in bridge table - means the site has also been approved
    $file = 'http://exchange.manna-network.com/incoming/get_bridge_row_m.php';
        if ( strpos( get_site_url(), 'https://' ) !== false ) {
        $http_host = str_replace( 'https://', '', get_site_url() );
        } elseif ( strpos( get_site_url(), 'http://' ) !== false ) {
        $http_host = str_replace( 'http://', '', get_site_url() );
        }
    echo '<br>line 275 in mmannanetwork before remote post and http_host sent to exchange is ', $http_host;
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
        echo '<br> LINE 300 - In mannanetwok.php line 301 $response[body] from exchange.manna-network.com/incoming/get bridge row_m.php';
        $mn_reg_status = json_decode($response['body'], true);
        echo '<br><br>$response[\'body\'] = ';  
        print_r($response['body']); 
  require_once('translations/en.php');
            if($mn_reg_status !=="empty"){
            echo '<br>Passed "if !empty" ---- ';
            print_r($mn_reg_status ); 
            //returns  Array ( [0] => Array ( [remote_lnk_num] => 1 [0] => 1 [agent_ID] => 25 [1] => 25 [agent_url] => orlandoreferralgroup.com [2] => orlandoreferralgroup.com [foldername] => manna_network [3] => manna_network ) ) 
            echo '  Create vars for each item displayed in form - fill values from bridge table<br>
            For example';
            $agent_ID = $mn_reg_status['agent_id'];
            $remote_lnk_num = $mn_reg_status['remote_lnk_num'];
            $remote_user_id = $mn_reg_status['remote_user_id'];
            //$foldername = $mn_reg_status[0]['foldername'];

            echo '<br><br>line 316';
            echo '<br>$agent_ID = ', $agent_ID;
            $file = 'http://exchange.manna-network.com/incoming/install_get_agent_url_folder.php';
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
            echo 'Something went wrong 337: (' . esc_attr( $error_message ) . ' )';
        } else {
                            //$mn_data = esc_attr( $response['body'] ) ;
                    $mn_data =  $response['body']  ;
                    $agent_decode = json_decode($response['body'], true);
                    echo '<br><br>$response[\'body\'] = ';  
                    print_r($response['body']); 
                echo '<br><br>$agent_decode = ';  
                    print_r($agent_decode);

                    $mn_agent_url =$agent_decode[0]['agent_url'];
                    $mn_agent_folder = $agent_decode[0]['foldername'];
                    echo '<br><br>line 349';
                echo '<br>$mn_agent_url = ', $mn_agent_url;
                echo '<br><br>line 351';
                echo '<br>$mn_agent_folder = ',$mn_agent_folder;
                echo '<br>$remote_user_id = ',$remote_user_id;
                echo '</h3><br> Now insert the agent url into curl next file link  ';
                $file     = 'https://'.$mn_agent_url.'/'.$mn_agent_folder.'/manna-network/incoming/get_users_registration_info.php';
                echo '<br>curl line 357 - file link = ', $file;
                echo '<br>curl line 358 - $remote_user_id = ', $remote_user_id;
                //echo '<br>curl line 44 - http_host = ', $http_host;
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
                            'user_id'       => $remote_user_id,
                            'remote_link_url'       => $http_host,    
                        ),
                        'cookies'     => array(),
                    )
                );

                        if ( is_wp_error( $response ) ) {
                            $error_message = esc_attr( $response->get_error_message() );
                            echo 'Something went wrong - email not verified: (' . esc_attr( $error_message ) . ' )';
                        } else {
                        echo '<h3>line 381 </h3>';
                        $advertiser_info =  json_decode($response['body'], true);
                        echo '<h1>Before IF line 352 $response[\'body\'] ' , $response['body'];

                        echo '</h1>';
                        echo '<h1>Before IF line 355 advertiser info ';
                        print_r($advertiser_info);
                        echo '</h1>';
                        
echo '<br>$advertiser_info[\'user_activation_hash\'] =', $advertiser_info['user_activation_hash'];

 if(!empty($advertiser_info['user_activation_hash'])){
 echo '<br>line 360 - passed if(!empty($advertiser_info[\'user_activation_hash\']', $advertiser_info['user_activation_hash'];
 
 }
                                if(!empty($advertiser_info['user_activation_hash'] )&& 0==$advertiser_info['user_active'])
                            {
                            echo '<h1>line 389 advertiser info ';
                            print_r($advertiser_info);
                            echo '</h1>';
                            echo '<br>We need to display the no verif message and the link to the resend verif email button';
                            
                            echo '<h3>';
                            echo MESSAGE_RESEND_EMAIL;
                            echo '</h3>';

                            echo '<form action="https://'.$mn_agent_url.'/'.$mn_agent_folder.'/manna-network/members/resend_email_verification.php" method="post">';

                        echo '    <input type="hidden" name="resend" value="resend">
                            <input type="hidden" name="remote_user_id" value="'. $advertiser_info['user_id'].'">
                            
                            
                            <input type="hidden" name="user_activation_hash" value="'. $advertiser_info['user_activation_hash'].'">
                            <input type="hidden" name="remote_user_email" value="'. $advertiser_info['user_email'].'">
                            <input type="hidden" name="remote_user_url" value="'. $advertiser_info['website_url'].'">
                            <p><input type="submit" value="Resend Email Verification"/></p>
                            </form>
                            <h3>After verifying email address, refresh this page.</h3>';
                            exit();
                            }
                            else
                            {
                            echo '<h1>user is registered and has confirmed email</h1>';
                           
                    //if (no result from first queries)
                    
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
                    
                    
                    
                    
                    
                echo '  
                Create vars for each item displayed in form - fill values from tempusers table
                    For example
                    $agent_id = $result[\'agent_id\'];
                    $url = $result[\'url\'];
                    etc';

               

if($mn_reg_status =="temp"){
echo '<br>line 446 - is temp';
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
  //  $mn_data = esc_attr( $response['body'] ) ;
$mn_data =  $response['body']  ;
//echo '<br> In mannanetwok.phpline 170 $response[body] from exchange.manna-network.com/incoming/check_if_registered.php =', $mn_data;
$decode = json_decode($mn_data, true);
echo '<br>139 decode = :', $decode;
print_r($decode);
//echo '<br>139 decode = :', $decode;
//echo '$decode remote_link_id = ', $decode['remote_link_id'];
$php_login_user_id = $decode['user_id'];//the data base at MN records the wp_link id as the site's "remote" link id [i.e. it is remote to the MN system)
$mn_agent_id = $decode['agent_id'];
$mn_installer_id = $decode['installer_id'];



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
    $php_login_user_id =$decode['user_id'];
    $mn_agent_id = $decode['agent_ID'];
    $mn_installer_id = $decode['installer_id'];

    }
}
}
}
}
}
 
                            }
                            echo '<h1>last line (524) in if</h1>';
                        }
                        else
                        {
echo '<h1>Site is not registered</h1>';
echo MESSAGE_NO_REGISTRATION;
exit();
                        }
                        
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
if(isset($_POST[submit])){
//POST = Array ( [option_page] => manna_member-group [action] => update [_wpnonce] => 1347a914bb [_wp_http_referer] => /wp-admin/admin.php?page=manna-network [wp_user_id] => 202 [mn_agent_id] => 17 [mn_agent_url] => 1stbitcoinbank.com [mn_agent_folder] => manna_network [installer_id] => 1 [wp_page_name] => [submit] => Save Changes ) 

if(isset($_POST['mn_local_lnk_num']) && is_numeric($_POST['mn_local_lnk_num'])){

update_option( 'mn_php_login_user_id',  $_POST['user_id']);
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
{ 
//echo '<h1>line 586 at beginning of form and is the "else" of if submit</h1>';
?>

<form method="post" action="../wp-content/plugins/manna-network/options.php">

  <?php

/*  settings_fields( 'manna_member-group' );
   do_settings_sections( 'manna_member-group' ); 
*/
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
<tr><td>Your User ID -> </td><td><input style ="border-style: none;background-color: darkred;color: white;font-weight: bold;padding-left: 2px;" type="text" name="php_login_user_id" value="<?php echo esc_attr($advertiser_info['user_id'] ); ?>" /></td></tr>
<tr><td>Agent ID -> </td><td><input style ="border-style: none;background-color: darkred;color: white;font-weight: bold;padding-left: 2px;" type="text" name="mn_agent_id" value="<?php echo esc_attr( $agent_ID ); ?>" /></td></tr>
<tr><td>Agent url -> </td><td><input style ="border-style: none;background-color: darkred;color: white;font-weight: bold;padding-left: 2px;" type="text" name="mn_agent_url" value="<?php echo esc_attr( $mn_agent_url ); ?>" /></td></tr>
<tr><td>Agent folder name -> </td></td><td><input style ="border-style: none;background-color: darkred;color: white;font-weight: bold;padding-left: 2px;" type="text" name="mn_agent_folder" value="<?php echo esc_attr( $mn_agent_folder ); ?>" /></td></tr>
<tr><td><p>

  <?php submit_button(); ?>
  
</td></tr>  </table>
</form>
<?php
}
//}
?>
</div>
  <?php

//} closing because closed the else on 271
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

