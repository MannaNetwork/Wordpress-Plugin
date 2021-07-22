<?php
$file = "https://".$mn_agent_url."/".$mn_agent_folder."/mannanetwork-dir/combgetNumberOfPages.php";
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
				'category_id'     => $category_id,
				'tregional_num'     => $tregional_num,
			),
			'cookies'     => array(),
		)
	);

	if ( is_wp_error( $response ) ) {
		$error_message = htmlspecialchars( $response->get_error_message() );
		echo "Something went wrong: htmlspecialchars($error_message)";
	} else {
$number_of_pages = $response['body'];
return $number_of_pages;
}
?>
