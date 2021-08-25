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
include(dirname(__DIR__, 2)."/includes/get_wp_option_values.php");
if (!defined('REGISTRATION_CATEGORY_HEADING')) {
include(dirname(__DIR__, 2)."/translations/en.php");
}
$plugin_is_registered = get_option('plugin_is_registered');


if($plugin_is_registered == "no" || $plugin_is_registered == "")
{
include(dirname(__DIR__, 2).'/translations/en_no_config.php');
exit();
}

$dont_show_array= array('captcha', 'register', '_wpnonce', 'main_cat_nonce','_wp_http_referer');

echo '<div id="mn_main_container"><div id="mn_main_menu_container" style="width: 800px ;
  margin-left: 0 ;
  margin-right: auto ;">';
if(isset($_POST['confirm'])){

$handle = curl_init();
$url1 = "http://".$mn_agent_url."/".$mn_agent_folder."/manna-network/members/register.php";
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$args = array();

	foreach($_POST as $key=>$value){
if(!in_array($key, $dont_show_array, TRUE)){
	$args[$key] = $value;
	
          }
	}
$args['register']=true;//this needed to get classes in enterprise code to parse data and insert in database

		    $ch = curl_init();    // initialize curl handle
		    $ch = curl_init();    // initialize curl handle
		    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		    curl_setopt($ch, CURLOPT_URL, $url1); 
		    curl_setopt($ch, CURLOPT_FAILONERROR, 1);          
		    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);    
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
		    curl_setopt($ch, CURLOPT_TIMEOUT, 50); 
		    curl_setopt($ch, CURLOPT_POSTFIELDS, $args); 
		    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
	
		    $regresults = curl_exec($ch);
		    $curl_errno = curl_errno($ch);
		    $curl_error = curl_error($ch);
		    if ($curl_errno > 0) {
			    echo "cURL Error ($curl_errno): $curl_error\n";
		    } else {    
echo $regresults;
?>
<script>
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

	echo '<input type="hidden" name="'.$key.'" value="'.$value.'"><br>', $key;
	echo '       = ', $value;
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
$user_password_new_pattern = '/^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).*$/';
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
//$user_password_repeat_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,15}$/';
  $user_password_repeat_pattern = '/^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).*$/';
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
if (!filter_var($value, FILTER_VALIDATE_URL)) {
       echo("<h3 style='color:red;'>$value is not a valid URL</h3>");
$error_test = 'failed';
}
} 
if($key == "selected_cat_id"){
if(empty($_POST['selected_cat_id']))
{
echo "<h3 style='color:red;'>You must select a category for your  ad listing</h3>";
$error_test = 'failed';
}
else
{
echo '<input type="hidden" name="selected_cat_id" value="'.$_POST['selected_cat_id'].'">';

}
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

$display_blockmp = '<h3 align="center">'.REG_FORM_WELCOME_TITLE.'</h3>'.REG_FORM_WELCOME_BODY.'   
<form class = "frms" method="POST" action="/wp-content/plugins/manna-network/endorsements/register.php" name="registerform">';
 
if (array_key_exists ( "script_type" , $_GET ) AND isset($_GET['script_type'])) {
$display_blockmp .= '
<input type = "hidden" id="script_type" name="script_type" value="'. $_GET['script_type'].'">
<h3>In order for the'. $_GET['script_type'].' to function properly it is necessary for you to register at the ad server.</h3>
<h4>You will need to:<br>
<ul> 
<li>Register with a valid email address</li>
<li>Verify the email address</li>
<li>Login at the ad server</>
<li>Add website info (a title, description and URL)</li>
</ul>
</h3>
<h3>Doing that will also advertise your website across the entire ad network (for free!).</h3>
<h3>Please fill in the form below to get started.</h3>'; 
}

if(array_key_exists("flag", $_GET) OR isset($_GET['flag'])){
$display_blockmp .= '<input type="hidden" name="flag" value="'.$_GET['flag'].'">';
}



$display_blockmp .= '<input type="hidden" name="recruiter_lnk_num" value="'.$mn_local_lnk_num.'">
 <label for="user_name">'.WORDING_REGISTRATION_USERNAME.'</label>
  <input id="user_name" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" style="width: 20em;" required />
   <label for="user_email">'.WORDING_REGISTRATION_EMAIL.'</label><span class="dropt" style="font-size: large;" title="'.REG_BLOKT_EMAIL_MOUSEOVER.'"><img height="42" width="42" src="/wp-content/plugins/manna-network/images/green_arrow.png">
  <span style="width:500px;">'.REG_BLOKT_EMAIL_MESSAGE.'</span></span>
    <input id="user_email" type="email" name="user_email" style="width: 20em;" required />
  <br>     <label for="user_password_new">'. WORDING_REGISTRATION_PASSWORD.'</label><span class="dropt" style="font-size: large;" title="'.REG_BLOKT_PASSWORD_MOUSEOVER.'"><img height="42" width="42" src="/wp-content/plugins/manna-network/images/green_arrow.png">
  <span style="width:500px;">'.REG_BLOKT_PASSWORD_MESSAGE.'</span></span>
    <br>    <input id="user_password_new" type="password" name="user_password_new" pattern=".{6,}" style="width: 20em;" required autocomplete="off" />
    <br>     <label for="user_password_repeat">'. WORDING_REGISTRATION_PASSWORD_REPEAT.'</label>
   <br>       <input id="user_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" style="width: 20em;" required autocomplete="off" />
  <br>   <label for="website_title">'. WORDING_REGISTRATION_TITLE.'</label><span class="dropt" style="font-size: large;" title="'.REG_BLOKT_TITLE_MOUSEOVER.'"><img height="42" width="42" src="/wp-content/plugins/manna-network/images/green_arrow.png">
  <span style="width:500px;">'.REG_BLOKT_TITLE_MESSAGE.'</span></span>
   <br>   <input id="website_title" type="text"  name="website_title" style="width: 20em;" required />
    <br>   <label for="website_description">'. WORDING_REGISTRATION_DESCRIPTION.'</label><span class="dropt" style="font-size: large;" title="'.REG_BLOKT_DESCRIPTION_MOUSEOVER.'"><img height="42" width="42" src="/wp-content/plugins/manna-network/images/green_arrow.png">
  <span style="width:500px;">'.REG_BLOKT_DESCRIPTION_MESSAGE.'</span></span>
     <br>   <textarea  id="website_description" type="text-area"  name="website_description" required  rows="5" cols="40"></textarea>
      <br>   <label for="website_url">'. WORDING_REGISTRATION_URL.'</label><span class="dropt" style="font-size: large;" title="'.REG_BLOKT_URL_MOUSEOVER.'"><img height="42" width="42" src="/wp-content/plugins/manna-network/images/green_arrow.png">  <span style="width:500px;">'.REG_BLOKT_URL_MESSAGE.'</span></span>
      <br>    <input id="website_url" type="text"  name="website_url" value="https://Insert Your URL HERE" required /><span style="color:red;">(Leave the https:// in front of your URL - remove the "s" from "https" if yours is not SSL [NOT recommended!])</span>
<hr>';

if( array_key_exists('gocat', $_GET) AND ISSET($_GET['gocat'])){
//NOTE category id comes in from main menu
$selected_cat_id = 1;
}

elseif( array_key_exists('q', $_GET) AND ISSET($_GET['q'])){
//NOTE category id comes in from main menu
$selected_cat_id = $_GET['q'];
}
elseif( array_key_exists('selected_cat_id', $_GET) AND ISSET($_GET['selected_cat_id'])){
//NOTE THIS CATEGORY ID COMES IN FROM THE PAGINATOR MENU
$selected_cat_id = $_GET['selected_cat_id'];
}
elseif(array_key_exists('selected_cat_id', $_POST) && ISSET($_POST['selected_cat_id'])){

//NOTE q comes in from dropdown 
$selected_cat_id = $_POST['selected_cat_id'];
}
else
{
$selected_cat_id = 1;

}
//both determiine what links are shown via category id var

$file = 'http://' . $mn_agent_url . '/' . $mn_agent_folder . '/mannanetwork-dir/get_category_json.php';

/* Dev Note PHPCS reports "ERROR   | Processing form data without nonce verification" for all these POSt variables but this page is included and the nonce verification was done on the previous page */

if ( isset( $_POST['main_cat_nonce'] ) ) {
	$nonce = sanitize_text_field( wp_unslash( $_POST['main_cat_nonce'] ) );
} elseif ( isset( $_GET['main_cat_nonce'] ) ) {
	$nonce = sanitize_text_field( wp_unslash( $_GET['main_cat_nonce'] ) );
} else {
	$nonce = 'null';
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
				'selected_cat_id' => $selected_cat_id,
'type' => 'categories',
			),
			'cookies'     => array(),
		)
	);

	if ( is_wp_error( $response ) ) {
		$error_message = esc_attr( $response->get_error_message() );
		echo 'Something went wrong: (' . esc_attr( $error_message ) . ')';
	} else {
		


$category_list = json_decode( $response['body'], true );


$category_list = str_replace('[', '', $category_list);
$category_list = str_replace(']', '', $category_list);

$display_blockmp .= '
<script>
var main_cat_nonce = "'.esc_attr( $nonce ).'"
var original_cat_id = "'.esc_attr( $selected_cat_id ) . '"
</script>';

//echo '<span id="mn_subcat_container"> <script>showSubLoc1(\'y:Select:1\',\'\',1,\'1\',\'categories\')</script></span>';

		$display_blockmp .= '<span id="mn_subcat_container"> 
 <table id="mn_subcat_table">
<tr><td><h2>'.REGISTRATION_CATEGORY_HEADING.'</h2>




<select name="submenu" onchange="showSubLoc1(this.value,\'' . esc_attr( $nonce ) . '\',1,\'' . esc_attr( $selected_cat_id ) . '\',\'categories\')"><option value="">' . esc_attr( WORDING_AJAX_MENU1 ) . '</option> ';
		$display_blockmp .= "<option value='y:" . esc_attr( $selected_cat_id ) . ":'></option>";
		foreach ( $category_list as $key => $value ) {
			if ( $category_list[ $key ]['lft'] + 1 < $category_list[ $key ]['rgt'] ) {
				$display_blockmp .= "<option value='y:" . esc_attr( $category_list[ $key ]['id'] ) . ':' . esc_attr( $category_list[ $key ]['name'] ) . "'>" . esc_attr( $category_list[ $key ]['name'] ) . '</option>';
			} else {
				$display_blockmp .= "<option value='n:" . esc_attr( $category_list[ $key ]['id'] ) . ':' . esc_attr( $category_list[ $key ]['name'] ) . "'>" . esc_attr( $category_list[ $key ]['name'] ) . '</option>';
			}
		}
		$display_blockmp .= '</select>&nbsp;&nbsp;&nbsp;&nbsp;<span class="dropt" style="font-size: large;" title="'.REG_BLOKT_CATEGORY_MOUSEOVER.'"><img height="42" width="42" src="/wp-content/plugins/manna-network/images/green_arrow.png">  <span style="width:500px;">'.REG_BLOKT_CATEGORY_MESSAGE.'</span></span>
		      <div class="catHint1" id="catHint1" name="catHint1"><b>' . esc_attr( WORDING_AJAX_1 ) . '</b></div><input type="hidden" id="selected_cat_name" name="selected_cat_name" class ="selected_cat_name" value="">
<input type="hidden" id="selected_cat_id" name="selected_cat_id" class ="selected_cat_id" value=""><div width: 250px;style="font-size: larger; font-weight:stronger;">Your Current Selection *: <input style="font-size: larger; font-weight:stronger;width: 250px;" type="text" id="selected_cat_menu_name"  class="selected_cat_menu_name" name="selected_cat_menu_name" value=""></td></tr></table></span>';

	}



$display_blockmp .= '<span id="mn_location_container"> 
<table id="mn_location_table">
<tr><td><h2>'.REGISTRATION_REGIONAL_HEADING_SEL.'</h2><select name="regional" id="regional" onchange="
showSubLoc1(this.value,\'' . esc_attr( $nonce ) . '\',1,\'' . esc_attr( $selected_cat_id ) . '\',\'regions\')"><option value="">'.WORDING_AJAX_REGIONAL_REG1.'</option>';
			$display_blockmp .= "
		<option value='y:2566:Africa'>Africa</option>
		<option value='y:2567:America - Central'>America - Central</option>
		<option value='y:2568:America - North'>America - North</option>
		<option value='y:2569:America - South'>America - South</option>
		<option value='y:2572:Asia'>Asia</option>
		<option value='y:2573:Australia/Oceania'>Australia\/Oceania</option>
		<option value='y:2756:Caribbean'>Caribbean</option>
		<option value='y:2575:Europe'>Europe</option>
		<option value='y:2740:Middle East'>Middle East</option>";
	
		$display_blockmp .= '</select>&nbsp;&nbsp;&nbsp;&nbsp;<span class="dropt" style="font-size: large;" title="'.REG_BLOKT_REGIONAL_MOUSEOVER.'"><img height="42" width="42" src="/wp-content/plugins/manna-network/images/green_arrow.png"><span style="width:500px;">'.REG_BLOKT_REGIONAL_MESSAGE.'</span></span><br>
		      <div id="locHint1" name="locHint1"><b>Smaller Regions Available After Selection.</b></div>
					  <div id="locHint2" name="locHint2"><b></b></div>
					   <div id="locHint3" name="locHint3"><b></b></div>
					    <div id="locHint4" name="locHint4"><b></b></div>
		<div id="locHint5" name="locHint5"><b></b></div>
		<div id="locHint6" name="locHint6"><b></b></div>
		<p id="selectedregion" name="selectedregion"><b></b></p>
<input type="hidden" id="selected_region_id" name="selected_region_id" class ="selected_region_id" value="">
<input type="hidden" id="selected_region_name" name="selected_region_name" class ="selected_region_name" value="">	<div width: 250px;style="font-size: larger; font-weight:stronger;">Your Current Selection *: <input style="font-size: larger; font-weight:stronger;width: 250px;" type="text" id="selected_region_menu_name"  class="selected_region_menu_name" name="selected_region_menu_name" value="">

		</td><td></table></span><div id="city_street_address" name="city_street_address" class="city_street_address"><b></b></div>
		';
//$display_blockmp .= '<span class="dropt" style="font-size: large;" title="'.$mouseover.'">'.$link_title.'<img height="42" width="42" src="/wp-content/plugins/manna-network/images/green_arrow.png">  <span style="width:500px;">'.$blockt_message.'</span></span>';
		//}
	if( array_key_exists('regional_num', $_GET) AND ISSET($_GET['regional_num'])){
	//NOTE category id comes in from main menu
	$regional_num = $_GET['regional_num'];
	unset($_GET['regional_num']);
	unset($_POST['regional_num']);
	}
//END Location AJAX
if(!array_key_exists("flag", $_GET) OR !isset($_GET['flag']) OR $_GET['flag'] !== "1"  ){
$display_blockmp .= ' <h1>'.WORDING_REGISTRATION_RECIPROCAL_HEADER.
WORDING_REGISTRATION_RECIPROCAL.' </div>';

   
}

$plugin_name = basename( plugin_dir_path(  dirname( __FILE__ , 2 ) ) );
$display_blockmp .= wp_nonce_field(); //this will ADD a nonce field to the form which will then need to be detected on exch of the showsubcat and showsubloc pages
//The installer_id var (below) is a complicated and a bit confusing name. The id number comes from the widgets table (in manna) and represents the parent id (sic widget id number) of the parent of THIS website (i.e. orlandoreferralgroup in this case) which is 1stbitcoinbank.com (where org is registered). That number is stored in the WP plugin's options. This form retrieves that setting and forwards it as a hidden var (via POST) to itself, which then gets used by the Registration class
$display_blockmp .= '
     <img src="/wp-content/plugins/'.$plugin_name.'/tools/showCaptcha.php" alt="captcha" />
      <label>'.WORDING_REGISTRATION_CAPTCHA.'</label>
        <input type="text" name="captcha" required style="width: 150px;"/>
<input type="hidden" name="installer_id" value="'.get_option('installer_id').'">
        <input type="submit" name="register" value="'.WORDING_REGISTER.'" />
   </form>
  <a href="./index.php">'. WORDING_BACK_TO_LOGIN.'</a>
';
echo  $display_blockmp;
}
include(dirname( __FILE__, 3 )."/js/registration.js");
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
