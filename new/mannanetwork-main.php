<?php
/** 
 *
@package Manna Network*/
//might need to add switch_to_blog($blog_id);
 if(is_multisite()){
  $blog_id = get_blog_option($blog_id,'siteurl');
   $blog_details = get_blog_details(1);
//if (!defined('MNPREFX')) {
      define("MNPREFX","mn_".$blog_details->blog_id);
 //}
}else{
//handle regular WP
//if (!defined('MNPREFX')) {
define("MNPREFX","mn_");
//}
}

$mn_agent_confgs = get_option('mn_agent_confgs');
if(!empty($mn_agent_confgs)){

$ex = explode(",", $mn_agent_confgs);
$mn_agent_url = $ex[0];
$mn_agent_folder = $ex[1];
$mn_agent_id = $ex[2];

$mn_plgn_confgs = get_option(MNPREFX.'plgn_confgs');
$ex2 = explode(",", $mn_plgn_confgs);
$mn_remote_link_id = $ex2[0];
$mn_local_lnk_num = $ex2[0];
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
 echo '<div style="display: inline">
    <div style="width:30%; display: inline-block; float:left; margin-left: 40px; margin-right: 10px;"><img src="'.get_site_url().'/wp-content/plugins/manna-network/images/dashboard.png" alt="Click the mannanetwork link in your admin dashboard to configure the plugin" width="500" height="600"></div>
    <div style="width: 50%; display: inline-block; border: 1px solid red"><h1 style="color:red;"> You need to configure the Manna Network plugin (see your dashboard)</h1></div>
</div>';
 exit();

}

if (!defined('REGISTRATION_CATEGORY_HEADING')) {
include('translations/en.php')  ;
}
require 'translations/en.js';

if(isset($plugin_is_registered) && $plugin_is_registered !== "yes"){

	if ( '' === $mn_local_lnk_num || '' === $mn_local_lnk_num ) {
	$file = 'https://' . $mn_agent_url . '/' . $mn_agent_folder . '/wp_errors/no_link_id.php';
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
				'http_host' => get_site_url(),
			),
			'cookies'     => array(),
		)
	);

	if ( is_wp_error( $response ) ) {
		$error_message = esc_attr( $response->get_error_message() );
		echo 'Something went wrong: (' . esc_attr( $error_message ) . ' )';
	} else {
		/** Dev Note: the following line generates a PHPCS error about escaping but doing so with kses created parsing problems
*/
		echo $response['body'];

	}
	exit();
}
else
{
 echo '<div style="display: inline">
    <div style="width:30%; display: inline-block; float:left; margin-left: 40px; margin-right: 10px;"><img src="'.get_site_url().'/wp-content/plugins/manna-network/images/dashboard.png" alt="Click the mannanetwork link in your admin dashboard to configure the plugin" width="500" height="600"></div>
    <div style="width: 50%; display: inline-block; border: 1px solid red"><h1 style="color:red;"> You need to configure the Manna Network plugin (see your dashboard)</h1></div>
</div>';
 exit();
}
}

//echo '</div>';//experiment - to close the <div class="entry-content"> in source code created by WP. There will be an extra close div tag as a result
echo '<div id="mn_main_container"><div id="mn_main_menu_container"><ul class="nav">';

include(dirname( __FILE__, 1 ).'/includes/_menu.php');
//include(dirname( __FILE__, 1 ).'/includes/_dropdownmenu.php');
	if ( isset( $_GET['register'] ) ) {
		include 'js/registration.js';
		include 'endorsements/register.php';
		exit();
	} elseif ( isset( $_GET['earn_income'] ) ) {
		include 'endorsements/earn_income.php';
		exit();
	} elseif ( isset( $_GET['about_bitcoin'] ) ) {
		include 'endorsements/about_bitcoin.php';
		exit();
	} elseif ( isset( $_GET['get_hosting'] ) ) { 
		include 'endorsements/get_hosting.php';
		exit();
	} elseif ( isset( $_GET['get_plugin'] ) ) {
		include 'endorsements/get_plugin.php';
		exit();
	} elseif ( isset( $_GET['get_php_code'] ) ) {
		include 'endorsements/get_php_code.php';
		exit();
	} elseif ( isset( $_GET['get_filters_info'] ) ) {
		include 'endorsements/get_filters_info.php';
		exit();
	}
	 elseif ( isset( $_GET['contact_us'] ) ) {
		include 'endorsements/contact_us.php';
		exit();
	}
	 elseif ( isset( $_GET['faq'] ) ) {
		include 'endorsements/faq.php';
		exit();
	}
	echo '</div>';
	
	if ( array_key_exists( 'gocat', $_GET ) && isset( $_GET['gocat'] ) ) {

				/** NOTE gocat comes in from gobutton. Those variables sent by GoButton are the only ones that GET ever provides*/
				$category_id = sanitize_text_field( wp_unslash( $_GET['gocat'] ) );
	} elseif ( array_key_exists( 'q', $_GET ) && isset( $_GET['q'] ) ) {
		// q comes in from AJAX javascript function !
		$category_id = sanitize_text_field( wp_unslash( $_GET['q'] ) );
	} elseif ( array_key_exists( 'category_id', $_GET ) && isset( $_GET['category_id'] ) ) {
		/** // NOTE THIS CATEGORY ID COMES IN FROM THE PAGINATOR MENU */
		$category_id = sanitize_text_field( wp_unslash( $_GET['category_id'] ) );
	} elseif ( array_key_exists( 'category_id', $_POST ) && isset( $_POST['category_id'] ) ) {
		/** // NOTE this comes in from MAIN MENU
It will NEVER have a regional number
*/
		$category_id = sanitize_text_field( wp_unslash( $_POST['category_id'] ) );
	}
	//Note: If it has a trgional_num it ALWAYS was sent by the Go Button. In othere words, the ONLY way the tregional_num variable will ever have a value is IF it comes in as GET. The other thing is that the GoButton is sending that value as a colon separated string. Either we need to change that at the Go Button function (and only send the location id) or we need to explode it here
	if ( array_key_exists( 'tregional_num', $_GET ) && isset( $_GET['tregional_num'] ) ) {
	$tregional_num = $_GET['tregional_num'];
	}
	if ( array_key_exists( 'currentPage', $_GET ) && isset( $_GET['currentPage'] ) ) {
				/** NOTE gocat comes in from gobutton */
		$currentPage = sanitize_text_field( wp_unslash( $_GET['currentPage'] ) );
	} 
	else
	{
	$currentPage = 1;
	}
	
	if ( array_key_exists( 'contact_us', $_GET ) && isset( $_GET['contact_us'] ) ) {
				/** NOTE gocat comes in from gobutton */
		$contact_us = sanitize_text_field( wp_unslash( $_GET['contact_us'] ) );
	} 
	

	/**     // both determiine what links are shown via category id var  */
	if ( isset( $category_id ) && '' !== $category_id ) {
		if ( isset( $_GET['main_cat_nonce'] )
		&& ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['main_cat_nonce'] ) ), 'main_cat_action' )
		) {
			print '201 Sorry, your nonce did not verify.';
			exit;
		} else {
			if ( isset( $_POST['main_cat_nonce'] ) ) {
				$main_cat_nonce = sanitize_text_field( wp_unslash( $_POST['main_cat_nonce'] ) );
			} elseif ( isset( $_GET['main_cat_nonce'] ) ) {
				$main_cat_nonce = sanitize_text_field( wp_unslash( $_GET['main_cat_nonce'] ) );
			}

			$bsv_pop_mouseover      = 'bsv_pop_mouseover';
			$bsv_pop_link_title     = 'bsv_pop_link_title';
			$bsv_pop_blockt_message = 'bsv_pop_blockt_message';

echo '<h3 style="text-align:center;">More Selections - Filter By Location</h3>
<table style="width:50%; margin-left: auto;
  margin-right: auto;">
<tr><td><div id="upper-left">';
include 'subcatsDropdown.php';
echo'</div></td>
<td><div id="go-button"><p id="goLink" class="goLink">&nbsp;</p><p id="clear_button" class="clear_button">&nbsp;</p></div></td>
<td><div id="upper-right">';
 include 'regionalDropdown.php';
 echo '</div></td>
</tr>
</tbody>
</table>
</div>
	<!--test code -->
	</div>';
  //We have a new function to get the lft rgt of the region at lftRgtRegion($regional_number)
  //We will use it to get the links for the selected category within the "id" array it returns 
  //Once we get the array of locations to select for, we'll query the links table for links in the cat and a location id IN the array. Then whatever number of links we get will be used to calculate number of pages
/*  if($tregional_num > 0){
  include ('numberofpagesregional.php'); //
  }
  else
  {
   include ('numberofpages.php'); //
  }
  */
  //renamed to number0fpagesregional to numofpagesallinone.php - returns a string - $number_of_pages.":".$lft.":".$rgt.":".$count_of_counter;
  include ('numofpagesallinone.php');
$pieces = explode(":", $number_of_pages);
$number_of_pages = $pieces[0];
$lft = $pieces[1];
$rgt= $pieces[2];
$number_of_links= $pieces[3];
//important note: If and/or when there are more than one page, the script generates the paginator menu providing links to the other pages. It is important to realize all those page links use java script, will retrieve the new list of links using the values above and will replace the currently displayed list with the new one using AJAX. In other words, the values above are only loaded at page load but are reused by the JS and paginator to generate more pages.
$display_block = "";
if($number_of_pages ==0){ //could also use $number_of_links=0
    if($tregional_num>0){ 
     $display_block .= NO_LINK_QUERY_RESULTS_REGIONAL;
    }
   else
   {
    $display_block .= NO_LINK_QUERY_RESULTS;
   }
}
else
{
	if ( $number_of_pages > 1) {
	 include('includes/paginator.php');
	}
	//importantnote: Since the javascript and paginator produce the "page_id", this included getLinksAllInOne.php page won't have one yet and is given a default page_id of 1. Subsequent "page loads" will always come from the link(s) in the paginator, will use the javascript function to retrieve the new list of links and will replace the current list here using AJAX. In other words, this included page is only used once at page load.
 include ('getLinksAllInOne.php'); 
}
if(isset($linksList_2)){
	$links_list_3 = json_decode( $linksList_2, true );
		foreach ( $links_list_3 as $key => $value ) {
		$display_block .= '<tr><td><a target="_blank" href="' . esc_attr( $links_list_3[ $key ]['url'] ) . '">' . esc_attr( $links_list_3[ $key ]['name'] ) . '	<br>' . esc_attr( $links_list_3[ $key ]['description'] );
				if ( isset( $links_list_3[ $key ]['website_street'] ) ) {
					$display_block .= '<br>' . esc_attr( $links_list_3[ $key ]['website_street'] );
					$display_block .= '<br>' . esc_attr( $links_list_3[ $key ]['website_district'] );
				}
				$display_block .= '</a></td> </tr>';
				}
	}
echo '<div style="width:80%; margin-left: auto;
  margin-right: auto;"><table id="mn_results_table"><caption>Results Page</caption><tbody>';
echo $display_block;
echo '</table></div>';
			include 'js/mn_ajax.js';
		}
	} else 
	{
	/** // Display the opening, main category list  */
	
	echo '<div class="row" style="width: 60% ;  margin: auto ; border: 3px solid #4287f5; "><form name="main_category_form" method="post" > ' . wp_nonce_field( 'main_cat_action', 'main_cat_nonce' ) . '<input type="hidden" name="category_id" />';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'60\')">Accessories</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'1307\')">Games</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'65\')">Art/Photo/Music</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'1330\')">Health</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'69\')">Automotive</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'1375\')">Home</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'10023\')">Bitcoin</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'1401\')">Kids &amp; Teens</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'102\')">Books/Media</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'10037\')">Members</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'111\')">Business</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'1415\')">News</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'125\')">Careers</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'2822\')">Professional</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'126\')">Clothes/Apparel</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'3\')">Real Estate</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'134\')">Commerce</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'1275\')">Recreation</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'9\')">Computers/Internet</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'1438\')">Reference</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'10037\')">Deals</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'8\')">Religion</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'148\')">Education</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'10010\')">Sales_Reps</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'147\')">Electronics</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'2799\')">Services</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'2198\')">Environment</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'2027\')">Shopping</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'2702\')">Finance</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'2068\')">Society</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'10000\')">Food/Restaurants</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'2098\')">Sports</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'&nbsp;\')"></a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'124\')">Travel</a></div>';
		echo '</form></div></div>';
		
		include 'js/mn_main_page.js';
	}
