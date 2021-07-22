<?php

$file = 'https://' . $mn_agent_url . '/' . $mn_agent_folder . '/mannanetwork-dir/get_links_json.php';

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
				'http_host'   => $http_host,
				'category_id' => $category_id,

			),
			'cookies'     => array(),
		)
	);

	if ( is_wp_error( $response ) ) {
		$error_message = esc_attr( $response->get_error_message() );
		echo 'Something went wrong: (' . esc_attr( $error_message ) . ')';
	} else {

		$links_list_2 = $response['body'];

	}

