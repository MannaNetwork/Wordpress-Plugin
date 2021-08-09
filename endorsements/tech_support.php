<?php
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

get_header();
include(dirname(__DIR__, 3)."/manna-network/members/classes/member_page_class.php");
include(dirname(__DIR__, 3)."/manna-configs/db_cfg/agent_config.php");//load order 1
include(dirname(__DIR__, 3)."/manna-network/members/css/members_menu.css");

echo file_get_contents('views/_menu.php', true);

/* *~*~*~*~*~*~*~*~*~*~*~*~*~*~*~ This page is designed to encourage edits from this point forward *~*~*~*~*~*~*~*~*~*~*~*~*~*~ */

echo '<h1>Coming Soon!</h1></div>';

/* *~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~ No editing beyond this point!! *~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~ */

get_footer();
