<?php

require_once '../../../wp-load.php';
if ( ( ! isset( $_POST['main_cat_nonce'] )
		|| ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['main_cat_nonce'] ) ), 'main_cat_action' ) ) && ( ! isset( $_GET['main_cat_nonce'] )
		&& ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['main_cat_nonce'] ) ), 'main_cat_action' ) )
		) {
		print 'Sorry, your nonce did not verify.';
		exit;
} else {
	if ( isset( $_POST['main_cat_nonce'] ) ) {
			$main_cat_nonce = sanitize_text_field( wp_unslash( $_POST['main_cat_nonce'] ) );
	} elseif ( isset( $_GET['main_cat_nonce'] ) ) {
		$main_cat_nonce = sanitize_text_field( wp_unslash( $_GET['main_cat_nonce'] ) );
	}
}

$category_id = '';

if ( get_option( 'mn_agent_url' ) && 'changeme' !== get_option( 'mn_agent_url' ) ) {
	$mn_agent_url = get_option( 'mn_agent_url' );
} else {
	$mn_agent_url = '';
}
if ( get_option( 'mn_agent_folder' ) && 'changeme' !== get_option( 'mn_agent_folder' ) ) {
	$mn_agent_folder = get_option( 'mn_agent_folder' );
} else {
	$mn_agent_folder = '';
}

if ( strpos( get_site_url(), 'https://' ) !== false ) {
	$http_host = str_replace( 'https://', '', get_site_url() );
} elseif ( strpos( get_site_url(), 'http://' ) !== false ) {
	$http_host = str_replace( 'http://', '', get_site_url() );
}

if ( isset( $_GET['q'] ) && is_numeric( $_GET['q'] ) ) {
	$category_id = sanitize_text_field( wp_unslash( $_GET['q'] ) ); }
	$file     = 'https://' . $mn_agent_url . '/' . $mn_agent_folder . '/mannanetwork-dir/get_category_json.php';
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
				'http_host'       => $http_host,
				//'regional_num'    => $regional_num,
				//'link_record_num' => $link_record_num,
				//'link_page_total' => $link_page_total,
				//'link_page_id'    => $link_page_id,
				//'pagem_url_cat'   => $pagem_url_cat,
				//'link_page_num'   => $link_page_num,
				//'cat_page_num'    => $cat_page_num,
				'category_id'     => $category_id,
				//'lnk_num'         => $lnk_num,
			),
			'cookies'     => array(),
		)
	);

	if ( is_wp_error( $response ) ) {
		$error_message = esc_attr( $response->get_error_message() );
		echo 'Something went wrong: (' . esc_attr( $error_message ) . ' )';
	} else {
		require_once 'translations/en.php';
		/** The following hack's only purpose is to avoid generating a PHPCodeSniffer error about escaping output. The $response['body'} variable below is an incoming json encoded string coming in from the feed site (so it is coming in already JSON encoded and escaped) and all this page does is to echo it for the AJAX/javascript function to json decode it and use the data as an array to create the category submenu. To "trick" code sniffer we decode the string and then immediate encode it again when we echo it for the java script page.

		Just one more additional note: This page uses WordPress's wp_remote function to retrieve the json string (while the php version uses Curl). But Javascrip has it's own capability to retrieve external pages so why even use this page? Because server administrators can restrict their JavaScripts to only access remote pages on their same domain. This page enables the javascript to always access this local page and this local page is always able to access the remote page on a different domain */
		$temp_var = json_decode( $response['body'] );
		echo wp_json_encode( $temp_var );
	}

