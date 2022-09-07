<?php

if(get_option('remote_link_id') AND get_option('remote_link_id')!=""){
$mn_local_lnk_num = get_option('remote_link_id');
}
else
{
$mn_local_lnk_num = "";
}
if(get_option('mn_agent_ID') AND get_option('mn_agent_ID')!=""){
$mn_agent_ID = get_option('mn_agent_ID');
}
else
{
$mn_agent_ID = "";
}
if(get_option('mn_agent_url') AND get_option('mn_agent_url')!=""){
$mn_agent_url = get_option('mn_agent_url');
}
else
{
$mn_agent_url = "";
}
if(get_option('mn_agent_folder') AND get_option('mn_agent_folder')!=""){
$mn_agent_folder = get_option('mn_agent_folder');
}
else
{
$mn_agent_folder = "";
}
if(get_option('mn_installer_id') AND get_option('mn_installer_id')!=""){
$mn_installer_id = get_option('mn_installer_id');
}
else
{
$mn_installer_id = "";
}
if(get_option('mn_widget_id') AND get_option('mn_widget_id')!=""){
$mn_widget_id = get_option('mn_widget_id');
}
else
{
$mn_widget_id = "";
}
?>
