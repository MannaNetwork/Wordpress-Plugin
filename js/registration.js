<script>

function showSubLoc1(str, main_cat_nonce,currentLevel,cat_id,type) 
{
var myarr = str.split(":");
//window.alert('myarr[1] = '+myarr[1]);
var nextLevel= parseFloat(currentLevel) + 1;
if(type=="regions"){
var currentBlockNameStr= 'locHint'+(parseFloat(currentLevel));
var nextBlockNameStr= 'locHint'+(parseFloat(currentLevel) + 1);
//window.alert("currentLevel = "+currentLevel);
if(currentLevel == 4 ){
//someelement.style.cssText =
//window.alert("Selecting a city enables the option to add your street address and a link to a map to the ad (see the inputs below)");
var street_address_output = 'Add A Street Address (optional) <input type="text" name="city_street_address" id="city_street_address" class="city_street_address" value=""></input><br>Add A Link To A Map (optional) <input type="text" name="map_link" id="map_link" class="map_link" value=""></input>&nbsp;&nbsp;&nbsp;&nbsp;<span class="dropt" style="font-size: large;" title="test"><img height="42" width="42" src="/wp-content/plugins/manna-network/images/green_arrow.png"><span style="width:500px;">test2</span></span>';
//window.alert("in level = 4 and type = regions and street_address_output ="+street_address_output);
 document.getElementById("city_street_address").innerHTML=street_address_output;

}
}
else
{
var currentBlockNameStr= 'catHint'+(parseFloat(currentLevel));
var nextBlockNameStr= 'catHint'+(parseFloat(currentLevel) + 1);
}

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {

    if (this.readyState==4 && this.status==200) {
var data = this.responseText;


var combo_list = JSON.parse(data);


if(combo_list == "NO MORE SUB CATEGORIES" || combo_list == "Sorry, No More Selections.")
{
 document.getElementById(currentBlockNameStr).innerHTML=combo_list+'<div class="'+nextBlockNameStr+'" id="'+nextBlockNameStr+'" name="'+nextBlockNameStr+'" style="background-color: yellow;"></div>';


}
else
{

var output = '<form action=""><select name="submenu" onchange="showSubLoc1(this.value,\''+main_cat_nonce+'\',\''+nextLevel+'\',\''+cat_id+'\',\''+type+'\')">';

if(type=="regions"){

output += '<option value="">' + wording_ajax_regional_menu1 + '</option>';
}
else
{
output += '><option value="">' + wording_ajax_menu1 + '</option>';

}

	for ( j = 0; j < combo_list.length; j++) {
		if ( '' !== combo_list[j].name ) {
			if ( combo_list[j].lft + 1 < combo_list[j].rgt ) {
			//y or n tells the AJAX functions whether there are any more subcategories
				output += "<option value='y:" + combo_list[j].id + ':' + combo_list[j].name + "'>" + combo_list[j].name + '</option>';
			} else {
				output += "<option value='n:" + combo_list[j].id + ':' + combo_list[j].name + "'>" + combo_list[j].name + '</option>';
				}
			}
		}
/*	output += '<input type="hidden" id="location_name" name="location_name" class ="location_name" value=""><input type="hidden" id="location_id" name="location_id" class ="location_id" value=""></select></form>'; Attempting to remove deprecated var name "location" from those sent to mannanetwork*/

output += '</select></form>';
if(type=="regions"){
      document.getElementById(currentBlockNameStr).innerHTML=output+'<div class="'+nextBlockNameStr+'" id="'+nextBlockNameStr+'" name="'+nextBlockNameStr+'" >'+still_more_cats_reg+'</div>';

}
else
{
   document.getElementById(currentBlockNameStr).innerHTML=output+'<div class="'+nextBlockNameStr+'" id="'+nextBlockNameStr+'" name="'+nextBlockNameStr+'" >'+still_more_cats+'</div>';
}
     }
 }
  }

if(type=="regions"){

document.getElementById("selected_region_name").value = myarr[2];
document.getElementById("selected_region_menu_name").value = myarr[2];
//window.alert('selected_region_id myarr1 = '+myarr[1]);
document.getElementById("selected_region_id").value = myarr[1];

  xmlhttp.open("GET","/wp-content/plugins/manna-network/getsubloc1.php?tregional_num="+myarr[1]+"&main_cat_nonce='"+main_cat_nonce+"&type=regions");
}
else
{
document.getElementById("selected_cat_name").value = myarr[2];
document.getElementById("selected_cat_menu_name").value = myarr[2];

//window.alert('selected_cat_id = '+myarr[1]);
document.getElementById("selected_cat_id").value = myarr[1];

xmlhttp.open("GET","/wp-content/plugins/manna-network/getsubloc1.php?q="+myarr[1]+"&main_cat_nonce='"+main_cat_nonce+"&type=categories");
 
}
  xmlhttp.send();
}

</script>
