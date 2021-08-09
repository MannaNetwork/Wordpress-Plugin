<?php
/** 
 *
@package Manna Network*/

if ( get_option( 'mn_local_lnk_num' ) && get_option( 'mn_local_lnk_num' ) !== 'changeme' ) {
	$mn_local_lnk_num = get_option( 'mn_local_lnk_num' );
} else {
	$mn_local_lnk_num = 'change_me';
}
if ( get_option( 'mn_agent_ID' ) && get_option( 'mn_agent_ID' ) !== 'changeme' ) {
	$mn_agent_id = get_option( 'mn_agent_ID' );
} else {
	$mn_agent_id = 'change_me';
}
if ( get_option( 'mn_agent_url' ) && get_option( 'mn_agent_url' ) !== 'changeme' ) {
	$mn_agent_url = get_option( 'mn_agent_url' );
} else {
	$mn_agent_url = '1stbitcoinbank.com';
}
if ( get_option( 'mn_agent_folder' ) && get_option( 'mn_agent_folder' ) !== 'changeme' ) {
	$mn_agent_folder = get_option( 'mn_agent_folder' );
} else {
	$mn_agent_folder = 'manna_network';
}
if ( get_option( 'wp_page_name' ) && get_option( 'wp_page_name' ) !== 'changeme' ) {
	$wp_page_name = get_option( 'wp_page_name' );
} else {
	$wp_page_name = 'change_me';
}

$plugin_is_registered = get_option('plugin_is_registered');
if (!defined('REGISTRATION_CATEGORY_HEADING')) {
include('translations/en.php')  ;
}
require 'translations/en.js';

/*
Dev Notes: Have alot of problems with css between different themes. The following css makes all the lettering of the Paginator's page loads (not the first page loaded) have white text (which makes it invisible unless mouseovered). Commenting out the css gets the text displayed with black color
*/

if($plugin_is_registered !== "yes"){
	if ( 'change_me' === $mn_local_lnk_num || '' === $mn_local_lnk_num ) {
	$file = 'https://' . $mn_agent_url . '/' . $mn_agent_folder . '/wp_errors/no_link_id.php';
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

 echo '<img src="/'.dirname( __FILE__, 1 ).'/images/screenshot.png" alt="Click the mannanetwork link in your admin dashboard to configure the plugin" width="500" height="600"> ';
  
 exit();
}

$file = 'http://exchange.manna-network.com/incoming/check_for_widget.php';
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
		echo 'Something went wrong: (' . esc_attr( $error_message ) . ' )';
	} else {
		echo ( esc_attr( $response['body'] ) );
//if the widget was detected chyange the option value
//if (FALSE === get_option('plugin_is_registered') && FALSE === update_option('plugin_is_registered',FALSE)) add_option('plugin_is_registered',"true");
	}

}
	include(dirname( __FILE__, 1 ).'/css/members_menu.css');

//	echo '<div id="mn_main_container"><div id="mn_main_menu_container"> <a href="' . esc_attr( get_site_url() ) . '/' . esc_attr( $wp_page_name ) . ' ">Top Level</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?register=true&lnk_num=' . esc_attr( $mn_local_lnk_num ) . '&agent_id=' . esc_attr( $mn_agent_id ) . '">Add URL</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?earn_income=true&lnk_num=' . esc_attr( $mn_local_lnk_num ) . '&agent_id=' . esc_attr( $mn_agent_id ) . '">Earn Income</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?about_bitcoin=true&lnk_num=' . esc_attr( $mn_local_lnk_num ) . '&agent_id=' . esc_attr( $mn_agent_id ) . '">About Bitcoin</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://' . esc_attr( $mn_agent_url ) . '/' . esc_attr( $mn_agent_folder ) . '/manna-network/members">Login</a>';
echo '<div id="mn_main_container"><div id="mn_main_menu_container" style="width: 90% ;
  margin-left: 0 ;
  margin-right: auto ;">
<ul class="navmenu">';

include(dirname( __FILE__, 1 ).'/includes/_menu.php');

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
	} elseif ( isset( $_GET['get_hosting'] ) ) { /** // those first three called from main web directory page and the menu above */
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
	echo '</div>';
	if ( array_key_exists( 'gocat', $_GET ) && isset( $_GET['gocat'] ) ) {

				/** NOTE gocat comes in from gobutton */
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
	if ( array_key_exists( 'tregional_num', $_GET ) && isset( $_GET['tregional_num'] ) ) {
		$tregional_num = sanitize_text_field( wp_unslash( $_GET['tregional_num'] ) );
	} else {
		$tregional_num = 0;
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

			// I don't think goLink is necessary here on registration page?

			echo '<div class="container">
<div class="column-center" id="column-center"><p id="goLink" name="goLink" class="goLink">&nbsp;</p><p id="clear_button" name="clear_button" class="clear_button">&nbsp;</p></div><div class="column-left" id="column-left">';


			include 'incl_subcats_wp.php';

			echo '</div>
   <div class="column-right" id="column-right">';
			include 'incl-regional-wp.php';

			echo '</div><!--</div> -->';

			include 'combnumberofpageswp.php';
			if ( $number_of_pages > 1 ) {
				echo '<div id="mn_paginator_menu_container">';
				echo '<table id="mn_paginator_menu_table"><caption>Select More Results Pages</caption><tr>';

				foreach ( range( 1, $number_of_pages ) as $number ) {
					if ( 1 === $number ) {
								$lower_limit = 0;
								$upper_limit = 19;
						$link_page_num       = 1;
								echo "<td style=\"text-align:center;\"><a class=\"mn_btn\" href=\"\" onclick=\" combgetAdDisplayPageReg('" . esc_attr( $category_id ) . "','" . esc_attr( $number ) . "','" . esc_attr( $mn_agent_url ) . "','" . esc_attr( $mn_agent_folder ) . "','" . esc_attr( $tregional_num ) . "','" . esc_attr( $main_cat_nonce ) . "'); return false;\">" . esc_attr( WORDING_LINKEXCHANGE_PAGE_NAME ) . ' #' . esc_attr( $number ) . '</a>';
					} elseif ( $number > 1 && $number !== $number_of_pages ) {
						$lower_limit       = 20 * ( $number - 1 );
						$upper_limit       = ( 20 * $number ) - 1;
							$link_page_num = $number;
						echo "<td style=\"text-align:center;\"><a class=\"mn_btn\"href=\"\" onclick=\"combgetAdDisplayPageReg('" . esc_attr( $category_id ) . "','" . esc_attr( $number ) . "','" . esc_attr( $mn_agent_url ) . "','" . esc_attr( $mn_agent_folder ) . "','" . esc_attr( $tregional_num ) . "','" . esc_attr( $main_cat_nonce ) . "'); return false;\">" . esc_attr( WORDING_LINKEXCHANGE_PAGE_NAME ) . ' #' . esc_attr( $number ) . '</a>';
					} else {
								$lower_limit                  = 20 * ( $number - 1 );
								$number_of_links_on_last_page = count( $url_array ) % 20;
								$upper_limit                  = $lower_limit + $number_of_links_on_last_page;
									$link_page_num            = $number;
								echo " <td style=\"text-align:center;\"><a class=\"mn_btn\" href=\"\" onclick=\" combgetAdDisplayPageReg('" . esc_attr( $category_id ) . "','" . esc_attr( $number ) . "','" . esc_attr( $mn_agent_url ) . "','" . esc_attr( $mn_agent_folder ) . "','" . esc_attr( $tregional_num ) . "','" . esc_attr( $main_cat_nonce ) . "'); return false;\">" . esc_attr( WORDING_LINKEXCHANGE_PAGE_NAME ) . ' #' . esc_attr( $number ) . '</a>';
					}
				}
				echo '</td></tr></table></div>';

				echo '<div><table id="mn_results_table">';
				// get the opening, first page of links. Since the paginator loaded links to retrieve all the pages, these will be replaced by javascript when user selects a page !

				include 'comblinks_wp_first_page.php';
				$links_list_3 = json_decode( $links_list_2, true );
				foreach ( $links_list_3 as $key => $value ) {
					echo '<tr><td><a target="_blank" href="' . esc_attr( $links_list_3[ $key ]['url'] ) . '">' . esc_attr( $links_list_3[ $key ]['name'] ) . '	<br>' . esc_attr( $links_list_3[ $key ]['description'] );
					if ( isset( $links_list_3[ $key ]['website_street'] ) ) {
						echo '<br>' . esc_attr( $links_list_3[ $key ]['website_street'] );
						echo '<br>' . esc_attr( $links_list_3[ $key ]['website_district'] );
					}
					echo '</a></td> </tr>';

				}

				echo '</table></div>';
			} else {
				/** Echo '<h1> this is where to handle only 1 page of results</h1>'; */
				include 'comblinks_wp_one_page.php';
				
				
				$links_list_3 = json_decode( $response['body'], true );
				echo '<div><table id="mn_results_table"><caption>Results Page</caption><tbody>';


				foreach ( $links_list_3 as $key => $value ) {
					echo '<tr><td><a target="_blank" href="' . esc_attr( $links_list_3[ $key ]['url'] ) . '">' . esc_attr( $links_list_3[ $key ]['name'] ) . '	<br>' . esc_attr( $links_list_3[ $key ]['description'] );
					if ( isset( $links_list_3[ $key ]['website_street'] ) ) {
							echo '<br>' . esc_attr( $links_list_3[ $key ]['website_street'] );
							echo '<br>' . esc_attr( $links_list_3[ $key ]['website_district'] );
					}
					echo '</a></td> </tr>';
				}
			}

			if ( strpos( get_site_url(), 'https://' ) !== false ) {
						$http_host = str_replace( 'https://', '', get_site_url() );
			} elseif ( strpos( get_site_url(), 'http://' ) !== false ) {
				$http_host = str_replace( 'http://', '', get_site_url() );
			}

			echo '<!--</tbody></table>--></div>';
			include 'js/mn_ajax.js';
		}
	} else {
		/** // Display the opening, main category list  */

		echo '
<table id="mn_main_cats_table"><caption>Main Categories</caption><tbody><form name="main_category_form" method="post" action=""> ' . wp_nonce_field( 'main_cat_action', 'main_cat_nonce' ) . '<input type="hidden" name="category_id" />';
		echo '<tr><td><a href="javascript:select_main_category(\'60\')">Accessories</a></td><td><a href="javascript:select_main_category(\'1307\')">Games</a></td></tr>';
		echo '<tr><td><a href="javascript:select_main_category(\'65\')">Art/Photo/Music</a></td><td><a href="javascript:select_main_category(\'1330\')">Health</a></td></tr>';
		echo '<tr><td><a href="javascript:select_main_category(\'69\')">Automotive</a></td><td><a href="javascript:select_main_category(\'1375\')">Home</a></td></tr>';
		echo '<tr><td><a href="javascript:select_main_category(\'10023\')">Bitcoin</a></td><td><a href="javascript:select_main_category(\'1401\')">Kids &amp; Teens</a></td></tr>';
		echo '<tr><td><a href="javascript:select_main_category(\'102\')">Books/Media</a></td><td><a href="javascript:select_main_category(\'10037\')">Members</a></td></tr>';
		echo '<tr><td><a href="javascript:select_main_category(\'111\')">Business</a></td><td><a href="javascript:select_main_category(\'1415\')">News</a></td></tr>';
		echo '<tr><td><a href="javascript:select_main_category(\'125\')">Careers</a></td><td><a href="javascript:select_main_category(\'2822\')">Professional</a></td></tr>';
		echo '<tr><td><a href="javascript:select_main_category(\'126\')">Clothes/Apparel</a></td><td><a href="javascript:select_main_category(\'3\')">Real Estate</a></td></tr>';
		echo '<tr><td><a href="javascript:select_main_category(\'134\')">Commerce</a></td><td><a href="javascript:select_main_category(\'1275\')">Recreation</a></td></tr>';

		echo '<tr><td><a href="javascript:select_main_category(\'9\')">Computers/Internet</a></td><td><a href="javascript:select_main_category(\'1438\')">Reference</a></td></tr>';
		echo '<tr><td><a href="javascript:select_main_category(\'10037\')">Deals</a></td><td><a href="javascript:select_main_category(\'8\')">Religion</a></td></tr>';

		echo '<tr><td><a href="javascript:select_main_category(\'148\')">Education</a></td><td><a href="javascript:select_main_category(\'10010\')">Sales_Reps</a></td></tr>';
		echo '<tr><td><a href="javascript:select_main_category(\'147\')">Electronics</a></td><td><a href="javascript:select_main_category(\'2799\')">Services</a></td></tr>';
		echo '<tr><td><a href="javascript:select_main_category(\'2198\')">Environment</a></td><td><a href="javascript:select_main_category(\'2027\')">Shopping</a></td></tr>';
		echo '<tr><td><a href="javascript:select_main_category(\'2702\')">Finance</a></td><td><a href="javascript:select_main_category(\'2068\')">Society</a></td></tr>';
		echo '<tr><td><a href="javascript:select_main_category(\'10000\')">Food/Restaurants</a></td><td><a href="javascript:select_main_category(\'2098\')">Sports</a></td></tr>';
		echo '<tr><td><a href="javascript:select_main_category(\'&nbsp;\')"></a></td><td><a href="javascript:select_main_category(\'124\')">Travel</a></td></tr>';
		echo '</table></form> <br> ';

		include 'js/mn_main_page.js';

	}

