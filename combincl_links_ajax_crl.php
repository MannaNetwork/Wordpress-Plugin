<?php
$link_page_num = $_GET['pageid']; 
$category_id = $_GET['catid']; 
$tregional_num = $_GET['tregional_num']; 


 $args3 = array(
'link_page_num' => $_GET['pageid'], 
'category_id' => $_GET['catid'], 
'tregional_num' => $_GET['tregional_num'], 
'http_host' =>   $_SERVER['HTTP_HOST']
 );

 $url3 = "https://".$_GET['mn_agent_url']."/".$_GET['mn_agent_folder']."/mannanetwork-dir/combget_links_json_ajax.php";

     $ch = curl_init();    // initialize curl handle
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_URL, $url3); 
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);          
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 50); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $args3); 
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);

    $links_list_2 = curl_exec($ch);
    $curl_errno = curl_errno($ch);
    $curl_error = curl_error($ch);
 if ($curl_errno > 0) {
         echo "cURL Error ($curl_errno): $curl_error\n";
 } else { 
     //returns $send_array = array($url, $name, $description, $website_street, $website_district)
     /*$url_array = $linksList2[0];
     $name_array = $linksList2[1];
     $description_array = $linksList2[2];
     $website_street_array = $linksList2[3];
     $website_district_array = $linksList2[4];
     */
     echo $links_list_2;
 }
    ?>
