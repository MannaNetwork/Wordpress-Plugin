<?php
echo $menu_str;


foreach($comboList[0] as $key=>$value){
   if($row['lft']+1 < $row['rgt']){
	 echo "<option value='y:" . $comboList[0][$key]['id'] .":".$comboList[0][$key]['name'] ."'>".$comboList[0][$key]['name']."</option>";
	}
	else
	{
	 echo "<option value='n:" . $comboList[0][$key]['id']  .":".$comboList[0][$key]['name'] . "'>".$comboList[0][$key]['name']."</option>";
	}
}
//echo str_replace(array("\n", "\t", "\r"), '', '</select></form>');
echo str_replace(array("\n", "\t", "\r"), '', '</select>');

?>
