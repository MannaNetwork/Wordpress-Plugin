<?php

if(get_option('mn_local_lnk_num') AND get_option('mn_local_lnk_num')!="changeme"){
$mn_local_lnk_num = get_option('mn_local_lnk_num');
}
else
{
$mn_local_lnk_num = "change_me";
}
if(get_option('mn_agent_ID') AND get_option('mn_agent_ID')!="changeme"){
$mn_agent_ID = get_option('mn_agent_ID');
}
else
{
$mn_agent_ID = "change_me";
}
if(get_option('mn_agent_url') AND get_option('mn_agent_url')!="changeme"){
$mn_agent_url = get_option('mn_agent_url');
}
else
{
$mn_agent_url = "change_me";
}
if(get_option('mn_agent_folder') AND get_option('mn_agent_folder')!="changeme"){
$mn_agent_folder = get_option('mn_agent_folder');
}
else
{
$mn_agent_folder = "change_me";
}
if(get_option('installer_id') AND get_option('installer_id')!="changeme"){
$installer_id = get_option('installer_id');
}
else
{
$installer_id = "change_me";
}

?>
