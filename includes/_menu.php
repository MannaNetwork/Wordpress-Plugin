<?php
echo ' 
	<li><a href="' . esc_attr( get_site_url() ) . '/' . esc_attr( $wp_page_name ) . ' ">Top Level</a></li>
	<li><a href="?register=true&lnk_num=' . esc_attr( $mn_local_lnk_num ) . '&agent_id=' . esc_attr( $mn_agent_id ) . '">Advertise</a></li>
	<li><a href="?earn_income=true&lnk_num=' . esc_attr( $mn_local_lnk_num ) . '&agent_id=' . esc_attr( $mn_agent_id ) . '">Earn Income</a></li>
	<li><a href="?about_bitcoin=true&lnk_num=' . esc_attr( $mn_local_lnk_num ) . '&agent_id=' . esc_attr( $mn_agent_id ) . '">About Bitcoin</a></li>
	<li><a target="_blank" href="http://' . esc_attr( $mn_agent_url ) . '/' . esc_attr( $mn_agent_folder ) . '/manna-network/members">Login</a></li>
</ul>';
