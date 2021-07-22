<script>
function showSubLoc1(str, main_cat_nonce,currentLevel,cat_id,type) 
{
//window.alert('str = '+str);
//window.alert(' main_cat_nonce = '+ main_cat_nonce);

//window.alert('currentLevelype = '+currentLevel);

//window.alert('cat_id, = '+cat_id);

//window.alert('type = '+type);

/*
Process:
1) Query remote server, receive JSON string of next menu items
2) Create the next html menu from the data - store as variable "output"
3) Add the next holder for the next menu to ouput var - name it with # currentlevel + 1
4) Replace the div created by previous menu with the new code (note the name of the replaced div will be the same as the current level number)

*/
var myarr = str.split(":");

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

//window.alert('data = '+data);

var combo_list = JSON.parse(data);
//window.alert('combo_list = '+combo_list);

if(combo_list == "NO MORE SUB CATEGORIES" || combo_list == "Sorry, No Regional Entries Found.")
{
 document.getElementById(currentBlockNameStr).innerHTML=combo_list+'<div class="'+nextBlockNameStr+'" id="'+nextBlockNameStr+'" name="'+nextBlockNameStr+'" style="background-color: yellow;"></div>';
}
else
{
//shouldn't the onchange also call the update Go button? No, that is done by mannanetwork-main


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
	output += '<input type="hidden" id="location_name" name="location_name" class ="location_name" value=""><input type="hidden" id="location_id" name="location_id" class ="location_id" value=""></select></form>';
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
if(!isNaN(myarr[1] )){
//window.alert('testing myarr 1 -value = '+myarr[1]);
document.getElementById("tregional_num").value = myarr[1];
}
if(!isNaN(myarr[2]) && myarr[2] !=='1'){
//window.alert('testing myarr 2 -value should be a number = '+myarr[2]);

document.getElementById("regional_name").value = myarr[2];
}
if(type=="regions"){

//window.alert('url = /wp-content/plugins/manna-network/getsubloc1.php?tregional_num='+myarr[1]+"&main_cat_nonce='"+main_cat_nonce+"&type=regions");
  xmlhttp.open("GET","/wp-content/plugins/manna-network/getsubloc1.php?tregional_num="+myarr[1]+"&main_cat_nonce='"+main_cat_nonce+"&type=regions");
}
else
{
xmlhttp.open("GET","/wp-content/plugins/manna-network/getsubloc1.php?q="+myarr[1]+"&main_cat_nonce='"+main_cat_nonce+"&type=categories");
 
}
  xmlhttp.send();
}



</script>
