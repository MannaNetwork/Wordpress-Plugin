<?php
unset($links_list_2);
unset($response);
unset($file);

$file = 'https://' . $mn_agent_url . '/' . $mn_agent_folder . '/mannanetwork-dir/combget_links_json_one_page.php';

if ( strpos( get_site_url(), 'https://' ) !== false ) {
	$http_host = str_replace( 'https://', '', get_site_url() );
} elseif ( strpos( get_site_url(), 'http://' ) !== false ) {
	$http_host = str_replace( 'http://', '', get_site_url() );
}

//$content .= '<br>line 13 of plugins/comblinks_wp_one_page.php (which is included in plugins mn-main.php)  in place where $category_id is passed on = '. $category_id . ' to mannanetwork-dir/combget_links_json_one_page.php via wp_remote_post';

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
				'category_id'     => $category_id,
				'tregional_num' => $tregional_num,
				
			),
			'cookies'     => array(),
		)
	);

	if ( is_wp_error( $response ) ) {
		$error_message =  $response->get_error_message() ;
		echo 'Something went wrong: (' .  $error_message . ')';
	} else {
		$links_list_string =  $response['body'];   
return $links_list_string; 
	}

