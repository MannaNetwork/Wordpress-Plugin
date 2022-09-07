<?php 
$root = dirname(dirname(dirname(dirname( __FILE__, 2 ))));
if (file_exists($root.'/wp-load.php')) {
// WP 2.6
require_once($root.'/wp-load.php');
} else {
// Before 2.6
require_once($root.'/wp-config.php');
}
get_header();
include(dirname(__DIR__, 1)."/includes/get_wp_option_values.php");

$plugin_is_registered = get_option('mn_plugin_is_registered');
if($plugin_is_registered == "no" || $plugin_is_registered == "")
{
include(dirname(__DIR__, 1).'/translations/en_no_config.php');
exit();
}
$affiliate_num = $_GET['lnk_num'];
?>

<div id="openModal" class="modalWindow">
   <div>
     <div> 
       <div class="modalHeader"><h1 align="center">Earn Income!</h1></div> 
            <p align="left">Our web directory is one of a network of many on individually owned and operated websites that co-operate together to advertise each other's websites and it offers you the opportunity to earn income (either in the form of BitcoinSV or advertising credits) too! </p>
   
<p  align="left">And it is available for free!
<h1 style="text-align: center;">Options</h1>

<p class="smallerFont" >We have three different programs to fit your needs.
</td></tr>
<tr><td colspan="2" width="100%"><h2>1) If You Have A Website ...</h2>
<div  class="grid_12"  style="background-color:lightgrey; width:97%; height:550px; border: 2px solid; border-radius: 25px; padding:10px 10px 10px;  margin-left: auto ;
  margin-right: auto ;">
<h3>1) Those With A Wordpress Site Download The Web Directory Plugin</h3>
<p class="smallerFont" >The plugin also comes with free web directory management services from BungeeBones. It also comes complete with categories and links. When your visitors decide to "Add Their Link" to it, the link is also distributed to all other web directories (thus making your advertising offer more valuable).
<a href="?get_plugin=true&affiliate_num=<?echo $affiliate_num;?>"><h4>Download Plugin</h4></a>
</td></tr>

<tr><td colspan="2" width="100%"><h2>For Those With A PHP Website</h2>
<h3>2) Download A PHP Web Directory Script</h3>

<p class="smallerFont" >The web directory also comes as a PHP script that you enter into one of your own website pages. It is completely brandable to your own website and like the other versions comes complete with categories, links and management ... all free!
<a href="?get_php_code=true&affiliate_num=<?echo $affiliate_num;?>"><h4>Download PHP Script</h4></a>
</div>
</td></tr>

<tr><td colspan="2" width="100%"><h2>2) If You Are A Website Professional...</h2>
<div  class="grid_12"  style="background-color:lightgrey; width:97%; height:80px; border: 2px solid; border-radius: 25px; padding:10px 10px 10px;  margin-left: auto ;
  margin-right: auto ;">
<p class="smallerFont" >The Network offers an Enterprise Level system that offers more features that professionals providing website services will want</p>
</div>
</td></tr>
<tr><td colspan="2" width="100%"><h2>3) Affiliate Program...</h2>
<div  class="grid_12"  style="background-color:lightgrey; width:97%; height:80px; border: 2px solid; border-radius: 25px; padding:10px 10px 10px;  margin-left: auto ;
  margin-right: auto ;">
<p class="smallerFont" >Even if you don't operate a website the Network offers an affiliate system that provides opportunities to earn BitcoinSV selling the network's web traffic!</p>
	</div>
</td></tr>

</div>     

   <div class="modalFooter">
           
                  <div class="acc-section">
			
            <div class="clear"></div>
        </div>
  </div>
</div>
</div>

