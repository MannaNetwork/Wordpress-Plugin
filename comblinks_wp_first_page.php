<?php


unset($links_list_2);
unset($response);
unset($file);
$file = "https://".$mn_agent_url."/".$mn_agent_folder."/mannanetwork-dir/combget_links_json_first_page.php";

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
                'link_page_num' => 1,
                'category_id'     => $category_id,
                'tregional_num' => $tregional_num, 
            ),
            'cookies'     => array(),
        )
    );

    if (is_wp_error($response) ) {
        $error_message =  $response->get_error_message();
        echo 'Something went wrong: (' .  $error_message . ')';
    } else {
        $links_list_2 =  $response['body'];   
    }
?>
