<?php
//Sam-Check note at line 147
//echo '<br>in views/add_a_link.php';
//print_r($_POST);
$root = dirname(dirname(dirname(dirname( __FILE__, 2 ))));
if (file_exists($root.'/wp-load.php')) {
// WP 2.6
require_once($root.'/wp-load.php');
} 
if (file_exists($root.'/manna_network/manna-configs/db_cfg/agent_config.php')) {
require_once($root.'/manna_network/manna-configs/db_cfg/agent_config.php');
}
require_once(dirname( __FILE__, 2 )."/js/mn_ajax.js");
require_once(dirname( __FILE__, 2 )."/translations/en/add_url.js");
include(dirname(__DIR__, 3)."/manna-network/members/css/members_menu.css");

get_header();

echo file_get_contents('views/_menu.php', true);

/* *~*~*~*~*~*~*~*~*~*~*~*~*~*~*~ This page is designed to encourage edits from this point forward *~*~*~*~*~*~*~*~*~*~*~*~*~*~ */


if(isset($_POST['confirm'])){


//echo 'in confirm';
//print_r($_POST);
$website_title = $_POST['website_title']; 
$website_description = $_POST['website_description']; 
$website_url = $_POST['website_url'];  
$category_id = $_POST['selected_cat_id']; 
$category_named = $_POST['selected_cat_name']; 
$agent_ID = AGENT_ID; 
$installer_id = $_POST['installer_id'];
$location_id = $_POST['selected_region_id'];
$website_street =  $_POST['website_street'];
//$users_balances_string = $_POST['users_balances_string'];



// now that it is confirmed it has to submit it to the classes/Add_Url.php (which is a copy of Registration.php class)
$installer_id = get_option('installer_id');

//why am I using curl to the local folder?
// all we need to do is install in two tables - one here and one in MN

  include(dirname( __FILE__, 5 )."/".AGENT_FOLDERNAME."/manna-network/members/classes/AddURL.php");
$addalink = new addurl();


$new_links_id = $addalink->addNewLink($captcha, $recruiter_lnk_num, $website_title, $website_description, $website_url, $category_id, $newcatsuggestion, $location_id, $website_street, $website_district, $installer_id, $user_id);

//now send user registration to central 
		$file="http://exchange.manna-network.com/incoming/add_a_link.php";
		$args = array(
		'agent_id' => AGENT_ID,
		'remote_user_id' => $user_id,
		'remote_link_id' => $new_links_id,
		'recruiter_lnk_num' => $recruiter_lnk_num,
		'user_registration_datetime' => $user_registration_datetime,
		'website_title' => $website_title,
		'website_description' => $website_description,
		'website_url' => $website_url,
		'category_id' => $category_id,
		'newcatsuggestion' => $newcatsuggestion,
		'location_id' => $location_id,
		'website_street' => $website_street,
		'website_district' => $website_district,
		'installer_id' => $installer_id,
		'promo_credit' => $promo_amount
		);

/* deprecate $recruiter_lnk_num
$new_links_id = $addalink->addNewLink($captcha, $website_title, $website_description, $website_url, $category_id, $newcatsuggestion, $location_id, $website_street, $website_district, $installer_id, $user_id);

//now send user registration to central 
		$file="http://exchange.manna-network.com/incoming/add_a_link.php";
		$args = array(
		'agent_id' => AGENT_ID,
		'remote_user_id' => $user_id,
		'remote_link_id' => $new_links_id,
		'user_registration_datetime' => $user_registration_datetime,
		'website_title' => $website_title,
		'website_description' => $website_description,
		'website_url' => $website_url,
		'category_id' => $category_id,
		'newcatsuggestion' => $newcatsuggestion,
		'location_id' => $location_id,
		'website_street' => $website_street,
		'website_district' => $website_district,
		'installer_id' => $installer_id,
		'promo_credit' => $promo_amount
		);  */
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $file);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, array('locus_array' => $locus_array,'link_record_num' => $link_record_num,'link_page_total' => $link_page_total, 'link_page_id' => $link_page_id, 'pagem_url_cat' => $pagem_url_cat,'link_page_num' => $link_page_num, 'cat_page_num' => $cat_page_num, 'url_cat' => $url_cat, 'affiliate_num' => $affiliate_num  ));
		curl_setopt($ch, CURLOPT_POSTFIELDS,$args);

		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
    		    $curl_errno = curl_errno($ch);
		    $curl_error = curl_error($ch);
		    if ($curl_errno > 0) {
			    echo "cURL Error line 575 ($curl_errno): $curl_error\n";
		    } else {   
//echo $data ; 
//now that the user info was duplicated on M.N., all the info was duplicated from tempuser table to remote_mn_id_bridge. We can safely delete the info from tempuser

//the reason why this delete is happening is because this user's info is added to a temp table on MN until they confirm their email. Then it is copied over to links and the bridge table and will be broadcast so it can now be deleted from temp table on MN



		$file="http://exchange.manna-network.com/incoming/delete_tmps.php";
		$args = array(
		'agent_id' => AGENT_ID,
		'remote_user_id' => $user_id,
		'remote_link_id' => $link_id,
		'recruiter_lnk_num' => $recruiter_lnk_num,
		'user_registration_datetime' => $user_registration_datetime,
		'website_title' => $website_title,
		'website_description' => $website_description,
		'website_url' => $website_url,
		'category_id' => $category_id,
		'newcatsuggestion' => $newcatsuggestion,
		'location_id' => $location_id,
		'website_street' => $website_street,
		'website_district' => $website_district,
		'installer_id' => $installer_id,
		'promo_credit' => $promo_amount
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $file);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, array('locus_array' => $locus_array,'link_record_num' => $link_record_num,'link_page_total' => $link_page_total, 'link_page_id' => $link_page_id, 'pagem_url_cat' => $pagem_url_cat,'link_page_num' => $link_page_num, 'cat_page_num' => $cat_page_num, 'url_cat' => $url_cat, 'affiliate_num' => $affiliate_num  ));
		curl_setopt($ch, CURLOPT_POSTFIELDS,$args);

		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
    		    $curl_errno = curl_errno($ch);
		    $curl_error = curl_error($ch);
		    if ($curl_errno > 0) {
			    echo "cURL Error line 575 ($curl_errno): $curl_error\n";
		    } else {    
//echo '<h1> the info shou;ld be from tempuser</h1>';
		curl_close($ch);
		
}
		echo($data);
//this was here... What is this supposed to comment out????*/
}

header( "Location: http://".AGENT_URL."/".AGENT_FOLDERNAME."/manna-network/members/success.php", true, 303 );
exit($data);

//get_footer();

}
elseif(isset($_POST['register'])){
$dont_show_array = array("submenu", "regional", "location_id", "_wpnonce", "captcha");
$error_test="";
echo '<div class="reg_form_page"><h1 align="center">Confirm Your Registration Details For Accuracy</h1>
 <div class="reg_form_content">
<form class = "frms" method="POST" action="" name="registerform">';
echo '<hr>';
	foreach($_POST as $key=>$value){
if(!in_array($key, $dont_show_array, TRUE) && !empty($value)){

	echo '<input type="hidden" name="'.$key.'" value="'.$value.'"><br>', $key;
	echo '       = ', $value;
/*if($key == "recruiter_lnk_num"){
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
} */
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
$display_blockmp = '<h3 align="center">'.ADD_URL_WELCOME_TITLE.'</h3>'.ADD_URL_WELCOME_BODY.'   
<form class = "frms" method="POST" action="" name="addalinkform">';
 


if(array_key_exists("flag", $_GET) OR isset($_GET['flag'])){
$display_blockmp .= '<input type="hidden" name="flag" value="'.$_GET['flag'].'">';
}



$display_blockmp .= '<input type="hidden" name="recruiter_lnk_num" value="'. get_option( 'mn_local_lnk_num' ).'">
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
$file = 'http://' . AGENT_URL . '/' . AGENT_FOLDERNAME . '/mannanetwork-dir/get_category_json.php';

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
//echo '<br> $category_list = ';
//print_r($category_list);

$category_list = str_replace('[', '', $category_list);
$category_list = str_replace(']', '', $category_list);

$display_blockmp .= '
<script>
var main_cat_nonce = "'.esc_attr( $nonce ).'"
var original_cat_id = "'.esc_attr( $selected_cat_id ) . '"
</script>';

		$display_blockmp .= '<span id="mn_subcat_container"> <table id="mn_subcat_table"><tr><td><h2>'.WORDING_REGISTRATION_CATEGORY_HEADING.'</h2><select name="submenu" onchange="showSubMenu(this.value,\'' . esc_attr( $nonce ) . '\',1,\'' . esc_attr( $selected_cat_id ) . '\',\'categories\')"><option value="">' . esc_attr( WORDING_AJAX_MENU1 ) . '</option> ';
		$display_blockmp .= "<option value='y:" . esc_attr( $selected_cat_id ) . ":'></option>";
		foreach ( $category_list as $key => $value ) {
			if ( $category_list[ $key ]['lft'] + 1 < $category_list[ $key ]['rgt'] ) {
				$display_blockmp .= "<option value='y:" . esc_attr( $category_list[ $key ]['id'] ) . ':' . esc_attr( $category_list[ $key ]['name'] ) . "'>" . esc_attr( $category_list[ $key ]['name'] ) . '</option>';
			} else {
				$display_blockmp .= "<option value='n:" . esc_attr( $category_list[ $key ]['id'] ) . ':' . esc_attr( $category_list[ $key ]['name'] ) . "'>" . esc_attr( $category_list[ $key ]['name'] ) . '</option>';
			}
		}
		$display_blockmp .= '</select>&nbsp;&nbsp;&nbsp;&nbsp;<span class="dropt" style="font-size: large;" title="'.REG_BLOKT_CATEGORY_MOUSEOVER.'"><img height="42" width="42" src="/wp-content/plugins/manna-network/images/green_arrow.png">  <span style="width:500px;">'.REG_BLOKT_CATEGORY_MESSAGE.'</span></span>
		      <div class="catHint1" id="catHint1" name="catHint1"><b>' . esc_attr( WORDING_AJAX_1 ) . '</b></div><!--</form>--><div width: 250px;style="font-size: larger; font-weight:stronger;">Your Current Selection *: <input style="font-size: larger; font-weight:stronger;width: 250px;" type="text" id="selected_cat_menu_name"  class="selected_cat_menu_name" name="selected_cat_menu_name" value=""><!--<input type="hidden" id="selected_cat_name" name="selected_cat_name" class ="selected_cat_name" value="">
<input type="hidden" id="selected_cat_id" name="selected_cat_id" class ="selected_cat_id" value="">--></td></tr></table></span>';

	}



$display_blockmp .= '<span id="mn_location_container"> 
<!--<form action="">--> <table id="mn_location_table">
<tr><td><h2>'.WORDING_REGISTRATION_REGIONAL_HEADING.'</h2><select name="regional" id="regional" onchange="
showSubMenu(this.value,\'' . esc_attr( $nonce ) . '\',1,\'' . esc_attr( $selected_cat_id ) . '\',\'regions\')"><option value="">'.WORDING_AJAX_REGIONAL_REG1.'</option>';
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
WORDING_REGISTRATION_RECIPROCAL;

   
}

$plugin_name = basename( plugin_dir_path(  dirname( __FILE__ , 2 ) ) );
$display_blockmp .= wp_nonce_field(); //this will ADD a nonce field to the form which will then need to be detected on exch of the showsubcat and showsubloc pages
$display_blockmp .= '
     <img src="/wp-content/plugins/'.$plugin_name.'/tools/showCaptcha.php" alt="captcha" />
      <label>'.WORDING_REGISTRATION_CAPTCHA.'</label>
        <input type="text" name="captcha" required style="width: 150px;"/>
<input type="hidden" name="installer_id" value="'.get_option('installer_id').'">
        <input type="submit" name="register" value="'.WORDING_REGISTER.'" />
   </form>
  <a href="./index.php">'. WORDING_BACK_TO_LOGIN.'</a>
';
$display_blockmp .= '<style>
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
</style></div>';
echo  $display_blockmp;


}
/* *~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~ No editing beyond this point!! *~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~ */

get_footer();
?>
