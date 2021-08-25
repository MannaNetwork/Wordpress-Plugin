<?php
ini_set('display_errors', '1');
$root = dirname(dirname(dirname(dirname( __FILE__, 2 ))));
echo '<br>root = ', $root;
if (file_exists($root.'/wp-load.php')) {
// WP 2.6
require_once($root.'/wp-load.php');
} 

$user = wp_get_current_user();
echo '<br>http host (sent to get advertiser agent brideg.php = ',$http_host; 
$file     = 'https://exchange.manna-network.com/incoming/get_advertiser_agent_bridge.php';
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
 $agent_info = json_decode($response['body'], true);
echo '<br><h3>agent info = ';
print_r($agent_info);
echo '</h3><br> Now insert the agent url into curl next file link (
} ';
$file     = 'https://'.$agent_info.'/manna_network/manna-network/incoming/get_users_registration_info.php';
echo '<br>curl line 42 - file link = ', $file;
echo '<br>curl line 43 - user_id = ', $user_id;
echo '<br>curl line 44 - http_host = ', $http_host;
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
			'user_id'       => 63,
			'remote_link_url'       => $http_host,		
		),
		'cookies'     => array(),
	)
);

if ( is_wp_error( $response ) ) {
	$error_message = esc_attr( $response->get_error_message() );
	echo 'Something went wrong: (' . esc_attr( $error_message ) . ' )';
} else {
$users_info_array = json_decode($response['body'], true);
} 

echo '<h3>';
MESSAGE_RESEND_EMAIL;
echo '</h3>';

<form action="https://'.$agent_url.'/manna_network/manna-network/members/resend_email_verification.php" method="post">
<input type="hidden" name="resend" value="resend">
<input type="hidden" name="remote_user_id" value="'. intval($user->ID).'">
<input type="hidden" name="remote_user_email" value="'. $user->user_email.'">
<input type="hidden" name="remote_user_url" value="'. $user->user_url.'">
<p><input type="submit" value="Resend Email Verification"/></p>
</form>
<h3>After verifying, refresh this page.</h3>';
}
?>
