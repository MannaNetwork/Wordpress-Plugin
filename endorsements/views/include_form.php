<?php
$display_blockmp = '<h3 align="center" style="padding:5px 10px;">'.REG_FORM_WELCOME_TITLE.'</h3>';
/*
Test Form
$file = 'https://' . $mn_agent_url . '/' . $mn_agent_folder . '/mannanetwork-dir/get_category_json.php';
echo '<br>$file = ', $file;
/* Dev Note PHPCS reports "ERROR   | Processing form data without nonce verification" for all these POSt variables but this page is included and the nonce verification was done on the previous page 
$selected_cat_id = 1;
echo '<form name="test" action="'.$file.'" method="post"><input type="text" name="selected_cat_id" value="'.$selected_cat_id.'"><input type="submit" value="Submit">
</form> ';  */
echo'
<div style="padding:20px 30px;">'.REG_FORM_WELCOME_BODY.'   
<form style="padding:20px 30px;" class = "reg_form" method="POST" action="/wp-content/plugins/manna-network/endorsements/register.php" name="registerform" >';
 
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



$display_blockmp .= '<input type="hidden" name="recruiter_lnk_num" value="'.$mn_remote_link_id.'">
 <label for="user_name">'.WORDING_REGISTRATION_USERNAME.'</label>
  <input id="user_name" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" style="width: 20em;" required />
   <label for="user_email">'.WORDING_REGISTRATION_EMAIL.'</label><span class="dropt" style="font-size: large;" title="'.REG_BLOKT_EMAIL_MOUSEOVER.'"><img height="21" width="21" src="/wp-content/plugins/manna-network/images/green_arrow.png">
  <span style="width:500px;">'.REG_BLOKT_EMAIL_MESSAGE.'</span></span>
    <input id="user_email" type="email" name="user_email" style="width: 20em;" required />
  <br>     <label for="user_password_new">'. WORDING_REGISTRATION_PASSWORD.'</label><span class="dropt" style="font-size: large;" title="'.REG_BLOKT_PASSWORD_MOUSEOVER.'"><img height="21" width="21" src="/wp-content/plugins/manna-network/images/green_arrow.png">
  <span style="width:500px;">'.REG_BLOKT_PASSWORD_MESSAGE.'</span></span>
    <br>    <input id="user_password_new" type="password" name="user_password_new" pattern=".{6,}" style="width: 20em;" required autocomplete="off" />
    <br>     <label for="user_password_repeat">'. WORDING_REGISTRATION_PASSWORD_REPEAT.'</label>
   <br>       <input id="user_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" style="width: 20em;" required autocomplete="off" />
  <br>   <label for="website_title">'. WORDING_REGISTRATION_TITLE.'</label><span class="dropt" style="font-size: large;" title="'.REG_BLOKT_TITLE_MOUSEOVER.'"><img height="21" width="21" src="/wp-content/plugins/manna-network/images/green_arrow.png">
  <span style="width:500px;">'.REG_BLOKT_TITLE_MESSAGE.'</span></span>
   <br>   <input id="website_title" type="text"  name="website_title" style="width: 20em;" required />
    <br>   <label for="website_description">'. WORDING_REGISTRATION_DESCRIPTION.'</label><span class="dropt" style="font-size: large;" title="'.REG_BLOKT_DESCRIPTION_MOUSEOVER.'"><img height="21" width="21" src="/wp-content/plugins/manna-network/images/green_arrow.png">
  <span style="width:500px;">'.REG_BLOKT_DESCRIPTION_MESSAGE.'</span></span>
     <br>   <textarea  id="website_description" type="text-area"  name="website_description" required  rows="5" cols="40"></textarea>
    <br>   <label for="protocol_title">'. WORDING_PROTOCOL_TITLE.'</label><span class="dropt" style="font-size: large;" title="'.PROT_BLOKT_TITLE_MOUSEOVER.'"><img height="21" width="21" src="/wp-content/plugins/manna-network/images/green_arrow.png"><br>
  <span style="width:500px;">'.PROT_BLOKT_TITLE_MESSAGE.'</span></span>
            <input type="radio" name="protocol"  value="https://" checked="checked" />
            <label for="protocol">https://</label>
        </br>
        <br>
            <input type="radio" name="protocol"  value="http://" />
            <label for="protocol">http://</label>
        </br>
      <br>   <label for="website_url">'. WORDING_REGISTRATION_URL.'</label><span class="dropt" style="font-size: large;" title="'.REG_BLOKT_URL_MOUSEOVER.'"><img height="21" width="21" src="/wp-content/plugins/manna-network/images/green_arrow.png">  <span style="width:500px;">'.REG_BLOKT_URL_MESSAGE.'</span></span>
      <br>    <input size="50" onfocus="this.value=\'\'" id="website_url" type="text"  name="website_url" value="'.REG_BLOKT_URL_INPUT_MESSAGE.'" required />
      </br>
  <br>   <label for="page_name">'. WORDING_REGISTRATION_PAGE_NAME.'</label><span class="dropt" style="font-size: large;" title="'.REG_BLOKT_PAGE_MOUSEOVER.'"><img height="21" width="21" src="/wp-content/plugins/manna-network/images/green_arrow.png">  <span style="width:500px;">'.REG_BLOKT_PAGE_MESSAGE.'</span></span>
      <br>    <input size="50" onfocus="this.value=\'\'" id="page_name" type="text"  name="page_name" value="'.REG_BLOKT_PAGE_INPUT_MESSAGE.'"  /> </br>
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

$file = 'https://' . $mn_agent_url . '/' . $mn_agent_folder . '/mannanetwork-dir/get_category_json.php';
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
$display_blockmp .= '<span id="mn_subcat_container"> 
 <table id="mn_subcat_table">
<tr><td><h2>'.REGISTRATION_CATEGORY_HEADING.'</h2>
<select name="submenu" onchange="showSubMenu(this.value,\'' . esc_attr( $nonce ) . '\',1,\'' . esc_attr( $selected_cat_id ) . '\',\'categories\',\''.esc_attr( $mn_agent_url).'\',\''.esc_attr( $mn_agent_folder).'\')"><option value="">' . esc_attr( WORDING_AJAX_MENU1 ) . '</option> ';
//orig <select name="submenu" onchange="showSubLoc1(this.value,\'' . esc_attr( $nonce ) . '\',1,\'' . esc_attr( $selected_cat_id ) . '\',\'categories\',\''+agent_url+'\',\''+agent_folder+'\')"><option value="">' . esc_attr( WORDING_AJAX_MENU1 ) . '</option> ';


		$display_blockmp .= "<option value='y:" . esc_attr( $selected_cat_id ) . ":'></option>";
		
		foreach ( $category_list as $key => $value ) {
			if ( $category_list[ $key ]['lft'] + 1 < $category_list[ $key ]['rgt'] ) {
				$display_blockmp .= "<option value='y:" . esc_attr( $category_list[ $key ]['id'] ) . ':' . esc_attr( $category_list[ $key ]['name'] ) . "'>" . esc_attr( $category_list[ $key ]['name'] ) . '</option>';
			} else {
				$display_blockmp .= "<option value='n:" . esc_attr( $category_list[ $key ]['id'] ) . ':' . esc_attr( $category_list[ $key ]['name'] ) . "'>" . esc_attr( $category_list[ $key ]['name'] ) . '</option>';
			}
		}
		$display_blockmp .= '</select>&nbsp;&nbsp;&nbsp;&nbsp;
		      <div class="catHint1" id="catHint1" name="catHint1"><b>' . esc_attr( WORDING_AJAX_1 ) . '</b></div><input type="hidden" id="selected_cat_name" name="selected_cat_name" class ="selected_cat_name" value="">
<input type="hidden" id="selected_cat_id" name="selected_cat_id" class ="selected_cat_id" value=""><div width: 250px;style="font-size: larger; font-weight:stronger;">Your Current Selection *: <input style="font-size: larger; font-weight:stronger;width: 250px;" type="text" id="selected_cat_menu_name"  class="selected_cat_menu_name" name="selected_cat_menu_name" value=""><span class="dropt" style="font-size: large;" title="'.REG_BLOKT_CATEGORY_MOUSEOVER.'"><img height="21" width="21" src="/wp-content/plugins/manna-network/images/green_arrow.png">  <span style="width:500px;">'.REG_BLOKT_CATEGORY_MESSAGE.'</span></span></td></tr></table></span>';
	}

$display_blockmp .= '<span id="mn_location_container"> 
<table id="mn_location_table">
<tr><td><h2>'.REGISTRATION_REGIONAL_HEADING_SEL.'</h2><select name="regional" id="regional" onchange="
showSubMenu(this.value,\'' . esc_attr( $nonce ) . '\',1,\'' . esc_attr( $selected_cat_id ) . '\',\'regions\',\''. esc_attr( $mn_agent_url).'\',\''.  esc_attr( $mn_agent_folder).'\')"><option value="">'.WORDING_AJAX_REGIONAL_REG1.'</option>';
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
	
		$display_blockmp .= '</select>&nbsp;&nbsp;&nbsp;&nbsp;<br>
		      <div id="locHint1" name="locHint1"><b>Smaller Regions Available After Selection.</b></div>
					  <div id="locHint2" name="locHint2"><b></b></div>
					   <div id="locHint3" name="locHint3"><b></b></div>
					    <div id="locHint4" name="locHint4"><b></b></div>
		<div id="locHint5" name="locHint5"><b></b></div>
		<div id="locHint6" name="locHint6"><b></b></div>
		<p id="selectedregion" name="selectedregion"><b></b></p>
<input type="hidden" id="selected_region_id" name="selected_region_id" class ="selected_region_id" value="">
<input type="hidden" id="selected_region_name" name="selected_region_name" class ="selected_region_name" value="">	<div width: 250px;style="font-size: larger; font-weight:stronger;">Your Current Selection *: <input style="font-size: larger; font-weight:stronger;width: 250px;" type="text" id="selected_region_menu_name"  class="selected_region_menu_name" name="selected_region_menu_name" value=""><span class="dropt" style="font-size: large;" title="'.REG_BLOKT_REGIONAL_MOUSEOVER.'"><img height="21" width="21" src="/wp-content/plugins/manna-network/images/green_arrow.png"><span style="width:500px;">'.REG_BLOKT_REGIONAL_MESSAGE.'</span></span>

		</td><td></table></span><div id="city_street_address" name="city_street_address" class="city_street_address"><b></b></div>
		';
//$display_blockmp .= '<span class="dropt" style="font-size: large;" title="'.$mouseover.'">'.$link_title.'<img height="21" width="21" src="/wp-content/plugins/manna-network/images/green_arrow.png">  <span style="width:500px;">'.$blockt_message.'</span></span>';
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
<input type="hidden" name="installer_id" value="'.$mn_widg_id.'">
        <input type="submit" name="register" value="'.WORDING_REGISTER.'" />
   </form>';   
