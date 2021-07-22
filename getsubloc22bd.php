<?php
require_once '../../../wp-load.php';

if ( get_option( 'mn_agent_url' ) && 'changeme' !== get_option( 'mn_agent_url' ) ) {
	$mn_agent_url = get_option( 'mn_agent_url' );
} else {
	$mn_agent_url = 'change_me';
}
if ( get_option( 'mn_agent_folder' ) && 'changeme' !== get_option( 'mn_agent_folder' ) ) {
	$mn_agent_folder = get_option( 'mn_agent_folder' );
} else {
	$mn_agent_folder = 'change_me';
}

$regional_num = '';

if ( isset( $_GET['tregional_num'] ) ) {
	$regional_num = sanitize_text_field( wp_unslash( $_GET['tregional_num'] ) );}
if ( strpos( get_site_url(), 'https://' ) !== false ) {
	$http_host = str_replace( 'https://', '', get_site_url() );
} elseif ( strpos( get_site_url(), 'http://' ) !== false ) {
	$http_host = str_replace( 'http://', '', get_site_url() );
}

$file     = 'http://' . $mn_agent_url . '/' . $mn_agent_folder . '/mannanetwork-dir/get_regions_json.php';
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
			'tregional_num'    => $regional_num,
			
		),
		'cookies'     => array(),
	)
);

if ( is_wp_error( $response ) ) {
	$error_message = esc_attr( $response->get_error_message() );
	echo 'Something went wrong: (' . esc_attr( $error_message ) . ' )';
} else {
	require_once 'translations/en.php';
$temp_var = json_decode( $response['body'] );
//		echo wp_json_encode( $temp_var );
echo $response['body'];
}
?>
