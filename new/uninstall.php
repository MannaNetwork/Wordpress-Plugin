<?php

// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
 
 
  if(is_multisite()){
 $blog_id = get_blog_option($blog_id,'siteurl');
   $blog_details = get_blog_details(1);
   define("MNPREFX","mn_".$blog_details->blog_id);
}else{
//handle regular WP
define("MNPREFX","mn_");
}
 delete_option(MNPREFX.'agent_confgs');
delete_option(MNPREFX.'plgn_confgs');  
 
// for site options in Multisite
//not used - we store multisite options in regular options table using naming convention of blog_id concatentated to mn_
//delete_site_option($option_name);

?>
