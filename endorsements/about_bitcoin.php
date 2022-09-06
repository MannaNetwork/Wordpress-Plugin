<?php
$plugin_is_registered = get_option('mn_plugin_is_registered');

if($plugin_is_registered == "no" || $plugin_is_registered == "")
{

include(dirname(__DIR__, 2).'/manna-network/translations/en_no_config.php');
exit();
}
?>

<div id="openModal" class="modalWindow">
        <div class="modalHeader"><h1 align="center">About Bitcoin</h1></div>
            <p align="left">Bitcoin is a new and revolutionary web technology that can be used for many things. In the case of our blogging club and monetization system, we use it as the payment system. Any web site that chooses purchase a more prominent position use Bitcoin (unless the buyer has earned advertising credits and is using those instead) because all commissions are paid to club members (i.e. for their advertising sales) out in Bitcoin too.</p>
            <p  align="left">You can find a lot of information about Bitcoin on the web. It has been out now about 10 years and there are many excellent YouTube videos, many excellent web sites, and many excellent news articles. The Manna Network uses the Bitcoin SV version.    
         
</div>     
            <div class="clear"></div>
