<?php

if($response['body'] == "Found website")
{

echo '<h3 style="color:red;">We have detected that your plugin is not configured. See the following screenshot to see where to locate the plugin configuration form:
</h3>';
//website is registered. Check that the website you configured as the agent url in the wp-content/plugins/mannanetwork/agent_config.php  page is, indeed, where you actually registered at. </h3><h3>You configured your agent url to be '.AGENT_URL;

echo '<h3>Please do not hesitate to contact us if you have any problems, questions, concerns or suggestions!</h3>';

	echo '</h3><h3 style="color:red;">If you haven\'t registered yet then please either <a target="_blank" href="https://'.AGENT_URL."/".AGENT_FOLDERNAME.'?register=true&lnk_num=1&agent_id=17">visit that agent\'s registration page</a> or select one of the other agents in the list at <a target=_blank" href="https://manna-network.com/register/">agent\'s list</a></h3>';
	echo '<h3 style="color:red;">If you did, indeed, register at the above website then <a target="_blank" href="https://'.AGENT_URL."/".'contact.php">please contact the tech support of your agent</a> with as many details of your registration process as possible so that we can track down the issue.</h3>';
echo '<br>change the option to true';
}
else
{
$http_host =  $_SERVER['HTTP_HOST'];
echo '<h3>Click the Manna Network link in your wordpress dashboard to verify the configuration</h3>';

}

echo '<img src = "/wp-content/plugins/manna-network/translations/screenshot.png">';

?>
