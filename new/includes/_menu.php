<?php
$get_permalink=get_permalink();


echo	'<li><a href="' . $get_permalink . '">Top Level</a></li>';
echo '<li><a href="?register=true&lnk_num=' . esc_attr( $mn_remote_link_id ) . '&agent_id=' . esc_attr( $mn_agent_id ) . '">Advertise</a></li>';
echo '	<li><a href="?earn_income=true&lnk_num=' . esc_attr( $mn_remote_link_id ) . '&agent_id=' . esc_attr( $mn_agent_id ) . '">Earn Income</a></li>
	<li><a href="?about_bitcoin=true&lnk_num=' . esc_attr( $mn_remote_link_id ) . '&agent_id=' . esc_attr( $mn_agent_id ) . '">About Bitcoin</a></li>';
if(!empty($contact_us)){
echo '	<li><a href="?contact_us=true&lnk_num=' . esc_attr( $mn_remote_link_id ) . '&agent_id=' . esc_attr( $mn_agent_id ) . '">Contact Us</a></li>';
}
echo    '<li><a target="_blank" href="https://' . esc_attr( $mn_agent_url ) . '/' . esc_attr( $mn_agent_folder ) . '/manna-network/members">Login</a></li>
</ul>';
