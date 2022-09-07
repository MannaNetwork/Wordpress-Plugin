<?php
$root = dirname(dirname(dirname(dirname( __FILE__, 3 ))));

if (file_exists($root.'/wp-load.php')) {
// WP 2.6
require_once($root.'/wp-load.php');
} else {
// Before 2.6
require_once($root.'/wp-config.php');
}
get_header();


 if(is_multisite()){
 $blog_id = get_blog_option($blog_id,'siteurl');
   $blog_details = get_blog_details(1);
 if (!defined('MNPREFX')) {
   define("MNPREFX","mn_".$blog_details->blog_id);
  }
}else{
//handle regular WP
	if (!defined('MNPREFX')) {
	define("MNPREFX","mn_");
	}
}

$mn_agent_confgs = get_option('mn_agent_confgs');

//if(!empty($mn_agent_confgs)){

$ex = explode(",", $mn_agent_confgs);
$mn_agent_url = $ex[0];
$mn_agent_folder = $ex[1];
$mn_agent_id = $ex[2];

$mn_plgn_confgs = get_option(MNPREFX.'plgn_confgs');
$ex2 = explode(",", $mn_plgn_confgs);
$mn_remote_link_id = $ex2[0];
$mn_pgn8tr_menu_items = $ex2[1];
$mn_installer_id = $ex2[2];
$mn_widg_id = $ex2[3];
$plugin_is_registered = $ex2[4];



if (!defined('REGISTRATION_CATEGORY_HEADING')) {
include(dirname(__DIR__, 2)."/translations/en.php");
}
if($plugin_is_registered == "no" || $plugin_is_registered == "")
{
include(dirname(__DIR__, 2).'/translations/en_no_config.php');
exit();
}

$dont_show_array= array('captcha', 'register', '_wpnonce', 'main_cat_nonce','_wp_http_referer');
echo '<style>';
include(dirname(__DIR__, 2).'/css/manna_network.css');
echo '</style>';
echo '<div id="mn_main_container"><div id="mn_main_menu_container" style="width: 800px ;
  margin-left: 0 ;
  margin-right: auto ;">';
if(isset($_POST['confirm'])){
include('sanitize.php');
$url1 = "https://".$mn_agent_url."/".$mn_agent_folder."/manna-network/members/register.php";
$args = array();

	foreach($_POST as $key=>$value){
if(!in_array($key, $dont_show_array, TRUE)){
	$args[$key] = $value;
	
          }
	}
$args['register']=true;//this needed to get classes in enterprise code to parse data and insert in database
	$response = wp_remote_post(
		$url1,
		array(
			'method'      => 'POST',
			'timeout'     => 45,
			'redirection' => 5,
			'httpversion' => '1.0',
			'blocking'    => true,
			'headers'     => array(),
			'body'        => $args,
			'cookies'     => array(),
		)
	);

	if ( is_wp_error( $response ) ) {
		$error_message = esc_attr( $response->get_error_message() );
		echo 'Something went wrong: (' . esc_attr( $error_message ) . ')';
	} else {
		$regresults = $response['body'];
		echo $regresults;
		?>
<script>
//dev note ... what is this script actually doing? It looks like a candidate for deprecation
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<?php
}
get_footer();
}
elseif(isset($_POST['register'])){
unset($error_test);
$error_test = "";
echo '<div class="reg_form_page"><h1 align="center">Confirm Your Registration Details For Accuracy</h1>
 <div class="reg_form_content">
<form class = "frms" method="POST" action="" name="registerform">';

	foreach($_POST as $key=>$value){
if(!in_array($key, $dont_show_array, TRUE) && !empty($value)){
if($key=="website_title" || $key=="website_description"){
$value = str_replace('\\', '', $value);
}

if(($key !== "regional" && $key !== "submenu" && $key!=="selected_region_menu_name" && $key !== "page_name") ){
//these two have the javascipt displaying ex. submenu = y:111:Business and selected_region_menu_name is duplicate of selected_region_name
	echo '<input type="hidden" name="'.$key.'" value="'.$value.'"><br>', $key;
	echo '       = ', $value;
	}
	if( $key == "page_name" && stripos($value, 'Insert Your LANDING PAGE NAME HERE') === false){
	echo '<input type="hidden" name="'.$key.'" value="'.$value.'"><br>', $key;
	echo '       = ', $value;
	}
if($key == "recruiter_lnk_num"){
if($value == ""){
echo '&nbsp;&nbsp;<h4 style="color:red;">&nbsp;&nbsp;'.$key.'&nbsp;&nbsp;'.REGISTRATION_GENERAL_ERROR1.REGISTRATION_LNK_NUM1.REGISTRATION_GENERAL_ERROR2.$value.'</h4>';
$error_test = 'failed';
echo '<br> recruiter link number is empty = '.$key;
}
if(!is_numeric($value)){
echo '&nbsp;&nbsp;<h4 style="color:red;">&nbsp;&nbsp;'.$key.'&nbsp;&nbsp;'.REGISTRATION_GENERAL_ERROR1.REGISTRATION_LNK_NUM2.REGISTRATION_GENERAL_ERROR2.$value.'</h4>';
$error_test = 'failed';
} 
}
if($key == "user_email"){
if($value==""){
	echo '<h3 style="color:red;">You must supply your email</h3>';
$error_test = 'failed';
}
else
{
if (!filter_var($value, FILTER_VALIDATE_EMAIL)){
  echo '<h3 style="color:red;">'.$value.' is not a valid email address format';
$error_test = 'failed';
}
}
}
if($key == "user_password_new"){
if($_POST['user_password_repeat'] !== $_POST['user_password_new']){
echo '<h3 style="color:red;">Passwords don\'t  match</h3>';
$error_test = 'failed';
}
if(empty($_POST['user_password_new']))
{
echo "<h3 style='color:red;'>You must supply a password in both locations</h3>";
$error_test = 'failed';
}
$user_password_new_subject = $value;
//$user_password_new_pattern = '/^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).*$/';
$user_password_new_pattern = '/^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[\(\)!@#$%^&!"~\[\]^_`{|},-.:;<=>?,+=]).*$/';

preg_match($user_password_new_pattern, $user_password_new_subject, $user_password_new_matches);
if(!preg_match($user_password_new_pattern, $user_password_new_subject, $user_password_new_matches)){
echo "<h3 style='color:red;'>Password must be at least 8 characters and contain at least one of each of the following: Capitalized letter,  lower cased letter, number, special character</h3>";
$error_test = 'failed';
}
} 
if($key == "user_password_repeat"){
if($_POST['user_password_repeat'] !== $_POST['user_password_new']){
echo '<h3 style=\'color:red;\'>Passwords don\'t  match</h3>';
$error_test = 'failed';
}
if(empty($_POST['user_password_repeat']))
{
echo "<h3 style='color:red;'>You must supply a password in both locations</h3>";
$error_test = 'failed';
echo '<br> error key = '.$key;
}
$user_password_repeat_subject = $value;
 // $user_password_repeat_pattern = '/^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).*$/';
  $user_password_repeat_pattern = '/^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[\(\)!@#$%^&!"~\[\]^_`{|},-.:;<=>?,+=]).*$/';

preg_match($user_password_repeat_pattern, $user_password_repeat_subject, $user_password_repeat_matches);
//if(!$user_password_repeat_matches[0]){
if(!preg_match($user_password_repeat_pattern, $user_password_repeat_subject, $user_password_repeat_matches)){
echo "<h3 style='color:red;'>Password must be at least 8 characters and contain at least one of each of the following: Capitalized letter,  lower cased letter, number, special character</h3>";
// echo '&nbsp;&nbsp;<h4 style="color:red;">&nbsp;&nbsp;'. $message.'</h4>';
$error_test = 'failed';
}
} 
if($key == "website_title"){
if(empty($_POST['website_title']))
{
echo "<h3 style='color:red;'>You must supply a title for your ad listing</h3>";
$error_test = 'failed';
}
$website_title_subject = $value;
$website_title_pattern = '/^[a-zA-Z0-9 ]*/';

preg_match($website_title_pattern, $website_title_subject, $website_title_matches);

if(!$website_title_matches[0]){
echo "<h3 style='color:red;'>Only alphabet characters, numbers and white space allowed</h3>";
$error_test = 'failed';
}
}

if($key == "website_description"){

if(empty($_POST['website_description']))
{
echo "<h3 style='color:red;'>You must supply a description for you ad listing</h3>";
$error_test = 'failed';
}
$website_description_subject = $value;
$website_description_pattern = '/^[a-zA-Z0-9 ]*/';

preg_match($website_description_pattern, $website_description_subject, $website_description_matches);
if(!$website_description_matches[0]){
echo "<h3 style='color:red;'>Only alphabets, numbers and white space allowed</h3>";
$error_test = 'failed';
}
} 
if($key == "website_url"){
$temp_value = $_POST['protocol'].$value;
if (!filter_var($temp_value, FILTER_VALIDATE_URL)) {
       echo("<h3 style='color:red;'>$value is not a valid URL</h3>");
$error_test = 'failed';
}
} 

if ($key == "page_name") {
if (!filter_var($value, FILTER_SANITIZE_STRING)) {
       echo("<h3 style='color:red;'>$value is not a valid string</h3>");
$error_test = 'failed';
}
}

 

if($key == "installer_id"){
if(empty($_POST['installer_id']))
{
echo "<h3 style='color:red;'>Missing installer_id data</h3>";
$error_test = 'failed';
}
echo '<input type="hidden" name="installer_id" value="'.$_POST['installer_id'].'">';
} 

if($key == "selected_cat_id"){
if(empty($_POST['selected_cat_id']))
{
echo "<h3 style='color:red;'>You must select a category for your  ad listing</h3>";
$error_test = 'failed';
}
echo '<input type="hidden" name="selected_cat_id" value="'.$_POST['selected_cat_id'].'">';
} 


if($key == "selected_region_id"){
if(!empty($_POST['selected_region_id']))
{
echo '<input type="hidden" name="selected_region_id" value="'.$_POST['selected_region_id'].'">';
}
} 
}
}
if($error_test == 'failed'){

echo '<h2 style="color:red;">Errors were detected! Please use the browser back button, correct the errors and resubmit the form. </h2>';
}
else
{
echo '<p><input type="submit" name="confirm" value="CONFIRM" />';
}
echo '   </form></div></div>';
}
else
{
require_once(dirname( __FILE__, 3 )."/translations/en.js");
if (!defined('REGISTRATION_CATEGORY_HEADING')) {
require_once(dirname( __FILE__, 3 )."/translations/en.php");
}
echo'
<div style="padding:20px 30px;">';
include('include_form.php');
echo '</div>';

 $display_blockmp .= ' <a href="./index.php">'. WORDING_BACK_TO_LOGIN.'</a>
';
echo  $display_blockmp;
}
//echo '<br>in views/register.php dirname( __FILE__, 3 )."/js/mn_ajaxForReg.js") = '. dirname( __FILE__, 3 )."/js/mn_ajaxForReg.js";
include(dirname( __FILE__, 3 )."/js/mn_ajaxForReg.js");
echo '<style>
span.dropt {border-bottom: thin dotted; background: #ffeedd;}
span.dropt:hover {text-decoration: none; background: #ffffff; z-index: 6; }
span.dropt span {position: absolute; left: -9999px;
  margin: 20px 0 0 0px; padding: 3px 3px 3px 3px;
  border-style:solid; border-color:black; border-width:1px; z-index: 6;}
span.dropt:hover span {left: 2%; background: #ffffff;} 
span.dropt span {position: absolute; left: -9999px;
  margin: 4px 0 0 0px; padding: 3px 3px 3px 3px; 
  border-style:solid; border-color:black; border-width:1px;}
span.dropt:hover span {margin: 20px 0 0 170px; background: #ffffff; z-index:6;} 
</style>';
echo '</div>';
get_footer();
?>
