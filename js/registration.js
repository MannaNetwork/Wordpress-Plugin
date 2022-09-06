<script>

function showSubLoc1(str, main_cat_nonce,currentLevel,cat_id,type) 
//function showSubMenu(str, currentLevel,cat_id,type) 
{
/*
Process description:
1) Query remote server, receive JSON string of next menu items
2) Create the next html menu from the data - store as variable "output"
3) Add the next holder for the next menu to ouput var - name it with # currentlevel + 1
4) Replace the div created by previous menu with the new code (note the name of the replaced div will be the same as the current level number)

*/
var myarr = str.split(":");
/*window.alert('myarr[0] = '+myarr[0]);
window.alert('selected catid myarr[1] = '+myarr[1]);
window.alert('selected cat name myarr[2] = '+myarr[2]);
*/
var nextLevel= parseFloat(currentLevel) + 1;
if(type=="regions"){
var currentBlockNameStr= 'locHint'+(parseFloat(currentLevel));
var nextBlockNameStr= 'locHint'+(parseFloat(currentLevel) + 1);
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
/* Am leaving these window alerts because the comparison operator (if =) gave me so much trouble.

window.alert('combo_list just before if not = '+combo_list);
window.alert('typeof combo_list before if = '+ typeof(combo_list));
window.alert('JSON.stringify( just before if not = '+JSON.stringify(combo_list));
var nosubs='"NO MORE SUB CATEGORIES"';
window.alert('nosubs with added quotes = '+nosubs);
window.alert('typeof( nosubs with added quotes = '+typeof(nosubs));
var noregs= '"Sorry, No More Regional Filters Found."'
//if(nosubs !== JSON.stringify(combo_list) || noregs !== JSON.stringify(combo_list)){ 
if(typeof(combo_list)!=='string'){
window.alert('testing if(combo_list != "NO MORE SUB CATEGORIES" || combo_list != "Sorry, No More Regional Filters Found.") - wasn\'t found and entered test area');
window.alert('typeof combo_list in test if = '+ typeof(combo_list));
window.alert('combo_list = ' +combo_list);  

} */
if(typeof(combo_list)!=='string'){
//window.alert('CL is not a string');
//}
//if(combo_list !== "NO MORE SUB CATEGORIES" || combo_list !== "Sorry, No More Regional Filters Found."){
//NO MORE SUB CATEGORIES

var output = '<select name="';
	if(type=="regions"){
	output += 'selected_region_id" onchange="showSubMenu(this.value,\''+nextLevel+'\',\''+myarr[1]+'\',\''+type+'\')">';
	output += '<option value="">' + wording_ajax_regional_menu1 + '</option>';
	}
	else
	{
	output += 'selected_cat_id" onchange="showSubMenu(this.value,\''+nextLevel+'\',\''+myarr[1]+'\',\''+type+'\')">';
	output += '<option value="">' + wording_ajax_menu1 + '</option>';
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
	if(type=="regions"){
	output += '<input type="hidden" id="location_name" name="location_name" class ="location_name" value="">';
	output += '<input type="hidden" id="location_id" name="location_id" class ="location_id" value="'+myarr[1]+'"></select>';
	//window.alert('before get element- currentBlockNameStr = '+currentBlockNameStr+'and output = '+output);
	      document.getElementById(currentBlockNameStr).innerHTML=output+'<div class="'+nextBlockNameStr+'" id="'+nextBlockNameStr+'" name="'+nextBlockNameStr+'" >'+still_more_cats_reg+'</div>';
	      document.getElementById("selected_region_menu_name").value = myarr[2];
	      document.getElementById("location_name").value = myarr[2];
	document.getElementById("selected_region_name").value = myarr[2];
	document.getElementById("selected_region_id").value = myarr[1];
	}
	else
	{
	//selected_cat_menu_name
	output += '<input type="hidden" id="cat_name" name="cat_name" class ="cat_name" value="">';
	output += '<input type="hidden" id="cat_id" name="cat_id" class ="cat_id" value="'+myarr[1]+'"></select>';
	    document.getElementById(currentBlockNameStr).innerHTML=output+'<div class="'+nextBlockNameStr+'" id="'+nextBlockNameStr+'" name="'+nextBlockNameStr+'" >'+still_more_cats+'</div>';
	//window.alert('before document.getElementById("selected_cat_menu_name").value = (myarr[2]) = '+myarr[2]);

	   document.getElementById("selected_cat_menu_name").value = myarr[2];
	document.getElementById("selected_cat_name").value = myarr[2];
	//window.alert('cat_id line 93 = '+cat_id);
	//window.alert('before doc get elbyid (before in was string) selected_cat_id asmyarr[1]= '+myarr[1]);
	document.getElementById("selected_cat_id").value = myarr[1]; 
	}
}
else//if(combo_list == "NO MORE SUB CATEGORIES" || combo_list == "Sorry, No More Regional Filters Found.")
{
// window.alert('found "Sorry, No More Regional Filters Found" from data ='+data);

 document.getElementById(currentBlockNameStr).innerHTML=combo_list+'<div class="'+nextBlockNameStr+'" id="'+nextBlockNameStr+'" name="'+nextBlockNameStr+'" style="background-color: yellow;"></div>';
	 if(type=="regions"){
	 document.getElementById("selected_region_id").value = myarr[1];
	  document.getElementById("selected_region_menu_name").value = myarr[2];
	 document.getElementById("city_street_address").innerHTML="<span>Your street address (optional)<input type='text' name='city_street_address' value='' />       Link To Map (optional)<input type='text' name='map_link' value='' /></span>";
	 }
	 else
	 {
	 //window.alert('cat_id line 48 = '+cat_id);
//window.alert('selected_cat_id in else (was not a string) as myarr[1]= before document.getElementById("selected_cat_id"'+myarr[1]);
	 document.getElementById("selected_cat_id").value = myarr[1]; 
	 document.getElementById("selected_cat_menu_name").value = myarr[2];
	}
}   
    
    ///////
 }
  }
//document.getElementById("tregional_num").value = myarr[1];
//document.getElementById("regional_name").value = myarr[2];
if(type=="regions"){
  xmlhttp.open("GET","getsubloc1.php?tregional_num="+myarr[1]+"&type=regions");
}
else
{
xmlhttp.open("GET","getsubloc1.php?q="+myarr[1]+"&type=categories");
}
  xmlhttp.send();
}
</script>
