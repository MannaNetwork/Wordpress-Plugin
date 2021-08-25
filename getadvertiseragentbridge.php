<?php

$file     = 'http://exchange.manna-network.com/incoming/get_advertiser_agent_bridge.php';
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
					
		),
		'cookies'     => array(),
	)
);

if ( is_wp_error( $response ) ) {
	$error_message = esc_attr( $response->get_error_message() );
	echo 'Something went wrong: (' . esc_attr( $error_message ) . ' )';
} else {
$agent_url = json_decode($response['body'], true);
return $agent_url;
} 
?>
