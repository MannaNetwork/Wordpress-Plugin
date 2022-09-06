<?php

if (array_key_exists ( "agent_id" , $_POST ) AND isset($_POST["agent_id"])) {
	if ( filter_var($_POST["agent_id"], FILTER_VALIDATE_INT) === false ) {
	  echo "Your variable is not an integer - 5";
	}
	else
	{
	$_POST['agent_id']=trim($_POST['agent_id']);
	}
}
if (array_key_exists ( "remote_user_id" , $_POST ) AND isset($_POST["remote_user_id"])) {
	if ( filter_var($_POST["remote_user_id"], FILTER_VALIDATE_INT) === false ) {
	  echo "Your variable is not an integer - 12";
	}
	else
	{
	$_POST['remote_user_id']=trim($_POST['remote_user_id']);
	}
}
if (array_key_exists ( "remote_link_id" , $_POST ) AND isset($_POST["remote_link_id"])) {
	if ( filter_var($_POST["remote_link_id"], FILTER_VALIDATE_INT) === false ) {
	  echo "Your variable is not an integer - 23";
	}
	else
	{
	$_POST['remote_link_id']=trim($_POST['remote_link_id']);
	}
}

if (array_key_exists ( "user_registration_datetime" , $_POST ) AND isset($_POST["user_registration_datetime"])) {
$_POST['user_registration_datetime']=trim($_POST['user_registration_datetime']);
}
if (array_key_exists ( "category_id" , $_POST ) AND isset($_POST["category_id"])) {
	if ( filter_var($_POST["category_id"], FILTER_VALIDATE_INT) === false ) {
	  echo "Your variable is not an integer - 45";
	}
	else
	{
	$_POST['category_id']=trim($_POST['category_id']);
	}
}

if (array_key_exists ( "location_id" , $_POST ) AND isset($_POST["location_id"])) {
echo '<br>in exchange add a link and is passing if (array_key_exists ( "location_id" , $_POST ) AND isset($_POST["location_id"]))';
	if(empty($_POST['location_id'])){
	echo '<br>in exchange add a link and is passing location_id is empty';
$_POST['location_id'] = "NULL";//this is the only "optional integer received from the form and if empty, it results in an error in the query. This converts it to NULL and then it works
echo '<br>location id = ', $_POST['location_id'];
}
	else
	{
	$_POST['location_id']=trim($_POST['location_id']);
	}
}
/* experiment deactivate - this var is not? in the POST vars?
if (array_key_exists ( "promo_credit" , $_POST ) AND isset($_POST["promo_credit"])) {
$promo_credit = $_POST['promo_credit'];
}
else
{
$promo_credit = 0;
}  */

if (array_key_exists ( "installer_id" , $_POST ) AND isset($_POST["installer_id"])) {
	if ( filter_var($_POST["installer_id"], FILTER_VALIDATE_INT) === false ) {
	  echo "Your variable is not an integer - 82";
	}
	/*else
	{
	$installer_id = $_POST['installer_id'];
	} */
}
//now sanitize all the strings
if (array_key_exists ( "website_title" , $_POST ) AND isset($_POST["website_title"])) {
$website_title = strip_tags($_POST['website_title']);
$website_title = htmlspecialchars($website_title, ENT_QUOTES);	
	$_POST["website_title"] = (strlen($website_title) > 40) ? substr($website_title, 0, 40) . '...' : $website_title;
}
if (array_key_exists ( "website_description" , $_POST ) AND isset($_POST["website_description"])) {
$website_description = strip_tags($_POST['website_description']);
$website_description = htmlspecialchars($website_description, ENT_QUOTES);
$_POST["website_description"] = (strlen($website_description) > 254) ? substr($website_description, 0, 251) . '...' : $website_description;
}
if (array_key_exists ( "protocol" , $_POST ) AND isset($_POST["protocol"])) {
$protocol = strip_tags($_POST['protocol']);
$protocol = htmlspecialchars($protocol, ENT_QUOTES);	
	$_POST["protocol"] = (strlen($protocol) > 8) ? substr($protocol, 0, 8) . '...' : $protocol;
}
 if (array_key_exists ( "website_url" , $_POST ) AND isset($_POST["website_url"])) {
$website_url = strip_tags($_POST['website_url']);
$website_url = htmlspecialchars($website_url, ENT_QUOTES);	
	$_POST["website_url"] = (strlen($website_url) > 254) ? substr($website_url, 0, 254) . '...' : $website_url;
}
if (array_key_exists ( "page_name" , $_POST ) AND isset($_POST["page_name"])) {
$page_name = strip_tags($_POST['page_name']);
$page_name = htmlspecialchars($page_name, ENT_QUOTES);	
	$_POST["page_name"] = (strlen($page_name) > 60) ? substr($page_name, 0, 60) . '...' : $page_name;
}
if (array_key_exists ( "city_street_address" , $_POST ) AND isset($_POST["city_street_address"])) {
//$website_street=filter_var($_POST['city_street_address'], FILTER_SANITIZE_STRING);
//not sure why the different names?
$website_street = strip_tags($_POST['city_street_address']);
$website_street = htmlspecialchars($city_street_address, ENT_QUOTES);	
	$_POST["website_street"] = (strlen($city_street_address) > 80) ? substr($city_street_address, 0, 80) . '...' : $city_street_address;
}
elseif(array_key_exists ( "website_street" , $_POST ) AND isset($_POST["website_street"])) {
$website_street = strip_tags($_POST['website_street']);
$website_street = htmlspecialchars($website_street, ENT_QUOTES);	
	$_POST["website_street"] = (strlen($website_street) > 80) ? substr($website_street, 0, 80) . '...' : $website_street;
}
if (array_key_exists ( "map_link" , $_POST ) AND isset($_POST["map_link"])) {
$map_link = strip_tags($_POST['map_link']);
$map_link = htmlspecialchars($map_link, ENT_QUOTES);	
	$_POST["map_link"] = (strlen($map_link) > 250) ? substr($map_link, 0, 250) . '...' : $map_link;
}
if (array_key_exists ( "catkeys" , $_POST ) AND isset($_POST["catkeys"])) {
	$catkeys = strip_tags($_POST['catkeys']);
$catkeys = htmlspecialchars($catkeys, ENT_QUOTES);	
	$_POST["catkeys"] = (strlen($catkeys) > 255) ? substr($catkeys, 0, 255) . '...' : $catkeys;
}
if (array_key_exists ( "lockeys" , $_POST ) AND isset($_POST["lockeys"])) {
	$lockeys = strip_tags($_POST['lockeys']);
$lockeys = htmlspecialchars($lockeys, ENT_QUOTES);	
	$_POST["lockeys"] = (strlen($lockeys) > 255) ? substr($lockeys, 0, 255) . '...' : $lockeys;
}

?>
