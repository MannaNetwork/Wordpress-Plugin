<?php
include('agent_config.php');
echo '<br> GET = ';
$q = $_GET['q'];
print_r($_GET);
$args = array();
if(isset($locus_array)){$args['locus_array']=  $locus_array;}
if(isset($link_record_num)){$args['link_record_num']=  $link_record_num;}
if(isset($link_page_total)){$args['link_page_total']=  $link_page_total;} 
if(isset($link_page_id)){$args['link_page_id']=  $link_page_id; }
if(isset($pagem_url_cat)){$args['pagem_url_cat']=  $pagem_url_cat;}
if(isset($link_page_num)){$args['link_page_num']=  $link_page_num;} 
if(isset($cat_page_num)){$args['cat_page_num']=  $cat_page_num;} 
if(isset($_GET['q'])){$args['category_id']=  $_GET['q']; }
if(isset($lnk_num)){$args['lnk_num']=  $lnk_num;}
$args['http_host']=   $_SERVER['HTTP_HOST'];


$handle = curl_init();
$url = "http://".$agent_url."/mannanetwork-dir/index.php";
echo '<br>url = ', $url;
echo '<br>args = ';
print_r($args);
// Set the url
curl_setopt($handle, CURLOPT_URL, $url);
curl_setopt($handle, CURLOPT_POSTFIELDS,$args);
// Set the result output to be a string.
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
 $jsonlinkList = curl_exec($handle);
 curl_close($handle);
$comboList = json_decode($jsonlinkList, true);
foreach($comboList[0] as $key=>$value){
echo '<tr>
                  <td>KEY = ', $key;
echo '  .... .........  ......  VALUE = ';
//print_r($value);
echo '<br>', $comboList[0][$key]['id'];// 879 
echo '<br>', $comboList[0][$key]['name'];// Download Soft Free, Try It and Buy It 
echo '<br>', $comboList[0][$key]['parent'];// 879 
echo '<br>', $comboList[0][$key]['lft'];// 1073 
echo '<br>', $comboList[0][$key]['rgt'];// Download Soft Free, Try It and Buy It 
echo '</td>
                </tr>';
}
?>
