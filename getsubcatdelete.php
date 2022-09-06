<?php
require_once '../../../wp-load.php';
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

/** Dev Note: the following two lines generate a nonce error in PHPCS. The problem is that the variable being flagged (i.e. $q) is created by javascript and AJAX so the nonce would need to be created there, in the javascript which would be quite complicated. We'll let the error ride for now */

if ( isset( $_GET['category_id'] ) ) {
	$category_id = sanitize_text_field( wp_unslash( $_GET['category_id'] ) ); }

$file = 'https://' . $mn_agent_url . '/' . $mn_agent_folder . '/mannanetwork-dir/get_category_json.php';

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
				'regional_num'    => $regional_num,
				'link_record_num' => $link_record_num,
				'link_page_total' => $link_page_total,
				'link_page_id'    => $link_page_id,
				'pagem_url_cat'   => $pagem_url_cat,
				'link_page_num'   => $link_page_num,
				'cat_page_num'    => $cat_page_num,
				'category_id'     => $category_id,
				'lnk_num'         => $lnk_num,
			),
			'cookies'     => array(),
		)
	);

	if ( is_wp_error( $response ) ) {
		$error_message = esc_attr( $response->get_error_message() );
		echo 'Something went wrong: (' . esc_attr( $error_message ) . ' )';
	} else {
/*$combo_list = json_decode( $response['body'], true );
		if ( 'NO MORE SUB CATEGORIES' === $combo_list ) {
			echo $combo_list;
		} else { */
$temp_var = json_decode($response['body']);
echo wp_json_encode($temp_var);
		//}
	}

