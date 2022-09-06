<?php
require_once(dirname( __FILE__, 4).'/wp-load.php');

$regional_num = '';

if ( isset( $_GET['tregional_num'] ) ) {
	$regional_num = sanitize_text_field( wp_unslash( $_GET['tregional_num'] ) );}
else
{$regional_num = 0;
}
if ( isset( $_GET['agent_url'] ) ) {
	$mn_agent_url = sanitize_text_field( wp_unslash( $_GET['agent_url'] ) );}
else
{$mn_agent_url = "";
}
if ( isset( $_GET['agent_folder'] ) ) {
	$mn_agent_folder = sanitize_text_field( wp_unslash( $_GET['agent_folder'] ) );}
else
{$mn_agent_folder = "";
}
if ( isset( $_GET['q'] ) && is_numeric( $_GET['q'] ) ) {
$selected_cat_id = sanitize_text_field( wp_unslash( $_GET['q'] ) ); 
}
else
{
$selected_cat_id = 0;
}
//remove https:// and/or http:// from the value to be searched for (because the url stored in MN db doesn't store either)
 if ( strpos( get_site_url(), 'https://' ) !== false ) {
	$http_host = str_replace( 'https://', '', get_site_url() );
} elseif ( strpos( get_site_url(), 'http://' ) !== false ) {
	$http_host = str_replace( 'http://', '', get_site_url() );
} 
if ( isset( $_GET['type'] ) ) {
	$type = sanitize_text_field( wp_unslash( $_GET['type'] ) );}
if($type=="regions"){
$file     = 'https://' . $mn_agent_url . '/' . $mn_agent_folder . '/mannanetwork-dir/get_regions_json.php';
}
else
{
$file     = 'https://' . $mn_agent_url . '/' . $mn_agent_folder . '/mannanetwork-dir/get_category_json.php';
}
//echo '<br>in plugin/getsubloc1.php $file for curl call = ', $file;
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
'selected_cat_id'    => $selected_cat_id,
'type'     => $type,			
		),
		'cookies'     => array(),
	)
);

if ( is_wp_error( $response ) ) {
	$error_message = esc_attr( $response->get_error_message() );
	echo 'Something went wrong: (' . esc_attr( $error_message ) . ' )';
} else {
	require_once 'translations/en.php';
echo $response['body'];
}
?>
