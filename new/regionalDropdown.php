<?php
$current_category_array_string = 'y:' . $category_id . ':filler_category_name';
/* Dev Note PHPCS reports "ERROR   | Processing form data without nonce verification" for all these POSt varibales but this page is included and the nonce verification was done on the previous page */
if ( isset( $_POST['main_cat_nonce'] ) ) {
	$main_cat_nonce = sanitize_text_field( wp_unslash( $_POST['main_cat_nonce'] ) );
} elseif ( isset( $_GET['main_cat_nonce'] ) ) {
	$main_cat_nonce = sanitize_text_field( wp_unslash( $_GET['main_cat_nonce'] ) );
} else {
	echo 'null';
}
		echo '<div id="mn_location_container" class="mn_location_container"> <form> <table id="mn_location_table">
<tr><td>

<select name="tregional_num" onchange="updategoButton(\'false\',this.value,\'' . esc_attr( $nonce ) . '\',\'' . esc_attr( $category_id ) . '\'), showSubLoc1(this.value,\'' . esc_attr( $nonce ) . '\',1,\'' . esc_attr( $category_id ) . '\',\'regions\',\''.esc_attr( $mn_agent_url ) .'\',\''.esc_attr( $mn_agent_folder ) . '\')"><option value="">' . esc_attr( WORDING_AJAX_REGIONAL_MENU1 ) . '</option> ';
//note - the last argument in the call to showSubLoc1 is the current level (i.e. '1") and indicates it is the first sublevel
			echo "
		<option value='y:2566:Africa'>Africa</option>
		<option value='y:2567:America - Central'>America - Central</option>
		<option value='y:2568:America - North'>America - North</option>
		<option value='y:2569:America - South'>America - South</option>
		<option value='y:2572:Asia'>Asia</option>
		<option value='y:2573:Australia/Oceania'>Australia\/Oceania</option>
		<option value='y:2756:Caribbean'>Caribbean</option>
		<option value='y:2575:Europe'>Europe</option>
		<option value='y:2740:Middle East'>Middle East</option>";
		echo '</select><br>
		      <div id="locHint1"><b>' . esc_attr( WORDING_AJAX_REGIONAL_MENU1 ) . '</b></div>
 <input type="hidden" id="selected_region_name" name="selected_region_name" class ="selected_region_name" value="">
					 <input type="hidden" id="tregional_num" name="tregional_num" class ="tregional_num" value="" > 
					 <input type="hidden" id="selected_region_id" name="selected_region_id" class ="selected_region_id" value="" >
		</td></tr></table></form>	</div>';


