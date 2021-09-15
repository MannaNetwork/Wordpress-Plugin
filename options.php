<?php
$root = dirname(dirname(dirname(dirname( __FILE__, 1 ))));
echo $root;

if (file_exists($root.'/wp-load.php')) {
// WP 2.6
require_once($root.'/wp-load.php');
} else {
// Before 2.6
require_once($root.'/wp-config.php');
}
get_header();
$error_array = "";

if(isset($_POST['mn_local_lnk_num']) && is_numeric($_POST['mn_local_lnk_num'])){
update_option( 'mn_local_lnk_num' , $_POST['mn_local_lnk_num']);
} 
else {
$error_array[0] = "yes";
}
if(isset($_POST['mn_agent_id']) && is_numeric($_POST['mn_agent_id'])){
update_option( 'mn_agent_id' , $_POST['mn_agent_id']);
} 
else {
$error_array[1] = "yes";
}
if(filter_var('https://'.$_POST['mn_agent_url'], FILTER_VALIDATE_URL)) 
if(isset($_POST['mn_agent_url']) && filter_var('https://'.$_POST['mn_agent_url'], FILTER_VALIDATE_URL)) 
{    
  update_option( 'mn_agent_url', $_POST['mn_agent_url']);
} 
else {
$error_array[2] = "yes";
}
if(isset($_POST['mn_agent_folder']) ){

update_option( 'mn_agent_folder' , $_POST['mn_agent_folder']);
}
else {
$error_array[3] = "yes";
}
if(isset($_POST['installer_id']) && is_numeric($_POST['installer_id'])){

update_option( 'installer_id' , $_POST['installer_id']);
} 
else {
$error_array[4] = "yes";
}
if (is_array($error_array) && in_array("yes", $error_array)){
if($error_array[0]== 'yes'){ echo '<h3>You\'re link id number is misconfigured</h3>'; }
if($error_array[1]== 'yes'){ echo '<h3>You\'re agent id number is misconfigured</h3>'; }
if($error_array[2]== 'yes'){ echo '<h3>You\'re agent url is misconfigured</h3>'; }
if($error_array[3]== 'yes'){ echo '<h3>You\'re agent folder name is misconfigured</h3>'; }
if($error_array[4]== 'yes'){ echo '<h3>You\'re installer id number is misconfigured</h3>'; }
}
else
{
update_option( 'plugin_is_registered' , 'yes');

echo '<div style="width:75%;margin: 0 auto;"><h3>Your configuration "seems" correct (Important note: it is your responsibility to verify the accuracy of these settings. You can do so by visiting your Member Control Panel at <a  style="color:blue; text-decoration: underline;" target="_blank" href="https://'.$_POST['mn_agent_url'].'/'.$_POST['mn_agent_folder'].'/members">https://'.$_POST['mn_agent_url'].'/'.$_POST['mn_agent_folder'].'/members </a> and click the "Buy Better Placement" link of the site and page you installed the plugin on (there will only be one listing unless you\'ve entered multiple ads).</h3></div>';
}
echo '<div style="width:75%;margin: 0 auto; "><h3><a  style="color:blue; text-decoration: underline;" href="/wp-admin/admin.php?page=manna-network&&plugin_is_registered=yes">RETURN</a></h3></div><br>';
get_footer();

	?>
