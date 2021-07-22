<script>

function showSubLoc1(str, main_cat_nonce,currentLevel,cat_id,type) 
{

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

var combo_list = JSON.parse(data);
if(combo_list == "NO MORE SUB CATEGORIES")
{
 document.getElementById(currentBlockNameStr).innerHTML=combo_list+'<div class="'+nextBlockNameStr+'" id="'+nextBlockNameStr+'" name="'+nextBlockNameStr+'" style="background-color: yellow;"></div>';
}
else
{
//shouldn't the onchange also call the update Go button? No, that is done by mannanetwork-main


var output = '<form action=""><select name="subLoc1" onchange="showSubLoc1(this.value,\''+main_cat_nonce+'\',\''+nextLevel+'\',\''+cat_id+'\',\''+type+'\'),updategoButton(';

if(type=="regions"){

output += '\'false\',this.value,\''+main_cat_nonce+' \',\''+myarr[1]+' \',\''+cat_id+'\')"><option value="">' + wording_ajax_regional_menu1 + '</option>';
}
else
{
output += 'this.value,\'false\',\''+main_cat_nonce+' \',\''+myarr[1]+' \',\''+cat_id+'\')"><option value="">' + wording_ajax_menu1 + '</option>';

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
	/*output += '<input type="hidden" id="select_name" name="location_name" class ="location_name" value=""><input type="hidden" id="location_id" name="location_id" class ="location_id" value=""></select></form>';*/
	
	output += '</select></form>';
if(type=="regions"){
      document.getElementById(currentBlockNameStr).innerHTML=output+'<div class="'+nextBlockNameStr+'" id="'+nextBlockNameStr+'" name="'+nextBlockNameStr+'" >'+still_more_cats_reg+'</div>';
      document.getElementById("selected_region_id").value = myarr[1];
document.getElementById("selected_region_name").value = myarr[2];

}
else
{
   document.getElementById(currentBlockNameStr).innerHTML=output+'<div class="'+nextBlockNameStr+'" id="'+nextBlockNameStr+'" name="'+nextBlockNameStr+'" >'+still_more_cats+'</div>';
   document.getElementById("selected_cat_id").value = myarr[1];
document.getElementById("selected_cat_name").value = myarr[2];

}
     }
 }
  }
if(type=="regions"){

  xmlhttp.open("GET","/wp-content/plugins/manna-network/getsubloc1.php?tregional_num="+myarr[1]+"&main_cat_nonce='"+main_cat_nonce+"&type=regions");
}
else
{

xmlhttp.open("GET","/wp-content/plugins/manna-network/getsubloc1.php?q="+myarr[1]+"&main_cat_nonce='"+main_cat_nonce+"&type=categories");
 
}
  xmlhttp.send();
}


function deleteAllLevels(category_id,main_cat_nonce,original_cat_id) 
{
//deprecated - removed the 'Clear button from the display
//replace regional drop down menu
//window.alert('main cat nonce = '+main_cat_nonce);
	var regional_dropdown = "<form action=''><table id='mn_location_table'><tr><td><select name='regional_menu' onchange=\"updategoButton('false',this.value,'"+main_cat_nonce+"' ,"+original_cat_id+"),showSubLoc1(this.value,'"+main_cat_nonce+"' ,1,"+category_id+",'regions')><option value=''>"+ wording_ajax_menu1+" </option><option value='y:2566:Africa'>Africa</option><option value='y:2567:America - Central'>America - Central</option><option value='y:2568:America - North'>America - North</option><option value='y:2569:America - South'>America - South</option><option value='y:2572:Asia'>Asia</option><option value='y:2573:Australia/Oceania'>Australia/Oceania</option><option value='y:2756:Caribbean'>Caribbean</option><option value='y:2575:Europe'>Europe</option><option value='y:2740:Middle East'>Middle East</option></select> <input type='hidden' id='regional_name' name='regional_name' class ='regional_name' value=''><input type='hidden' id='tregional_num' name='tregional_num' class='tregional_num'></td></tr></table></form><div id='locHint1' name='locHint1' class='locHint1'><b>"+still_more_cats_reg+"</b></div>";
//window.alert(regional_dropdown);
document.getElementById("mn_location_container").innerHTML = regional_dropdown;
document.getElementById("goLink").innerHTML=""; 
//replace category dropdown
var str="'y':"+original_cat_id+":";
var currentBlockNameStr= 'catHint'+ 1;


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
var output = '<form action=""><table id=\'mn_location_table\'><tr><td><select name=\'regional_menu\' onchange="showSubLoc1(this.value, \''+main_cat_nonce+'\' ,1, \''+original_cat_id+'\' ,\'categories\'),updategoButton(this.value,\'false\',\''+main_cat_nonce+'\',\''+original_cat_id+'\')"><option value=""> '+wording_ajax_menu1+' </option>';
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
}
	output += '<div class="catHint1" id="catHint1" name="catHint1"><b>' +still_more_cats+ '</b></div><input type="hidden" id="category_name" name="category_name" class ="category_name" value=""><input type="hidden" id="category_id" name="category_id" class ="category_id" value=""<input type="hidden" id="tregional_num" name="tregional_num" class ="tregional_num" value="" ></select></form>';
document.getElementById("mn_subcat_container").innerHTML = output;

}
xmlhttp.open("GET","/wp-content/plugins/manna-network/getsubcat1.php?q="+original_cat_id+"&main_cat_nonce='"+main_cat_nonce+"&type=categories");

   xmlhttp.send();
}


function updategoButton(submitted_category, submitted_regional_num, nonce, original_cat_id)
{
    var currenturl = document.getElementById("goLink").innerHTML;
    if (currenturl.indexOf("?") == -1 ) {
	//script handles the very first onchange event and creates a insert URL (for the getelementbyID) for the GO button
	//is either sent a category arg or a regional num arg (along with the category id of their current cat location)
	
     var a = submitted_category.toString().indexOf(":");
    if (a == -1)
    {
     var mycatarr = ['y',original_cat_id,'name'];
    }
    else
    {
    var mycatarr = submitted_category.split(":");
    }
if (submitted_regional_num === 'false' ) {
/*var inserturl = '<a href="?gocat=' + mycatarr[1] + '&tregional_num=0' + '&main_cat_nonce=' + nonce +'"><h1>GO</h1></a><br><input type="reset" onclick="<a href="?get_filters_info=true" target="_blank" onClick="window.open(\'?get_filters_info=true\',\'pagename\',\'resizable,height=600,width=800\'); return false;"><img height="42" width="42" src="../wp-content/plugins/manna-network/images/more_info_icon.png"></a>'; */
var inserturl = '<a href="?gocat=' + mycatarr[1] + '&tregional_num=0' + '&main_cat_nonce=' + nonce +'"><h1>GO</h1></a><a href="?get_filters_info=true" target="_blank" onClick="window.open(\'?get_filters_info=true\',\'pagename\',\'resizable,height=600,width=800\'); return false;"><img height="42" width="42" src="../wp-content/plugins/manna-network/images/more_info_icon.png"></a>';

}
else
{
var myregarr = submitted_regional_num.split(":");
//the category_id submitted to delete all levels MUST BE the category id of the page currently displayed to them (NOT the category currently selected by the dropdown
var inserturl = '<a href="?gocat=' + mycatarr[1] + '&tregional_num=' + myregarr[1] + '&main_cat_nonce=' + nonce +'"><h1>GO</h1></a><a href="?get_filters_info=true" target="_blank" onClick="window.open(\'?get_filters_info=true\',\'pagename\',\'resizable,height=600,width=800\'); return false;"><img height="42" width="42" src="../wp-content/plugins/manna-network/images/more_info_icon.png"></a>';
}
}
else
{ 

var currenturlpieces = currenturl.split('"><h1>'); //leaves <a href="?gocat=485&tregional_num=#### at currenturlpieces[0])
var twoarguments = currenturlpieces[0].split('?'); //leaves gocat=485&tregional_num=####
var twoargumentssplit = twoarguments[1].split('&amp;'); //leaves gocat=485 in 0 and tregional_num=#### 
if (submitted_regional_num.indexOf(":") > 0) {
	//IF so, we need to find, copy and save the existing argument 
	// the needed value will be var twoargumentssplit[0];
	var myregarr = submitted_regional_num.split(":");
	var inserturl = '<a href="?' + twoargumentssplit[0] + '&tregional_num=' + myregarr[1] + '&main_cat_nonce=' + nonce +'"><h1>GO</h1></a>';
	}
else
{
var mycatarr = submitted_category.split(":");
var inserturl = '<a href="?gocat=' + mycatarr[1] + '&' + twoargumentssplit[1] + '&main_cat_nonce=' + nonce +'"><h1>GO</h1></a>';
}
//window.alert(	insertclearButton(category_id,main_cat_nonce,original_cat_id));
	}
  document.getElementById("goLink").innerHTML=inserturl; 
    }

function combgetAdDisplayPageReg(catid, pageid,mn_agent_url,mn_agent_folder,tregional_num,nonce)
{
 if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
 } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
  xmlhttp.onreadystatechange=function() 
{
    if (this.readyState==4 && this.status==200) {
var data = this.responseText;
var ads = JSON.parse(data);
 var output = "<h1>Results</h1>";
for ( j = 0; j < ads.length; j++) {
output += "<tr class='mn_ads'><td id='mn_url'><a target='_blank' href='http://" + ads[j].url + "'>"+ads[j].name + "</a></td></tr><tr  class='mn_ads'><td id='mn_description'> " +ads[j].description + ")</td></tr>";
}
  document.getElementById("mn_results_table").innerHTML=output;
  }
 }

xmlhttp.open("GET","/wp-content/plugins/manna-network/combincl_links_ajax_crl_reg.php?catid="+catid+"&pageid="+pageid+"&mn_agent_url="+mn_agent_url+"&mn_agent_folder="+ mn_agent_folder+"&tregional_num="+ tregional_num+"&main_cat_nonce="+ nonce,true);
  xmlhttp.send();
}


function getAdDisplayPageReg(catid, pageid,mn_agent_url,mn_agent_folder,tregional_num,nonce)
{
 if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
 } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
  xmlhttp.onreadystatechange=function() 
{
    if (this.readyState==4 && this.status==200) {
var data = this.responseText;
var ads = JSON.parse(data);
 var output = "<h1>Results</h1>";
for ( j = 0; j < ads.length; j++) {
output += "<tr class='mn_ads'><td id='mn_url'><a target='_blank' href='http://" + ads[j].url + "'>"+ads[j].name + "</a></td></tr><tr  class='mn_ads'><td id=]mn_description'> " +ads[j].description + ")</td></tr>";
}
  document.getElementById("mn_results_table").innerHTML=output;
  }
 }

xmlhttp.open("GET","/wp-content/plugins/manna-network/incl_links_ajax_crl_reg.php?catid="+catid+"&pageid="+pageid+"&mn_agent_url="+mn_agent_url+"&mn_agent_folder="+ mn_agent_folder+"&tregional_num="+ tregional_num,true);
  xmlhttp.send();
}


function getAdDisplayPage(catid, pageid,mn_agent_url,mn_agent_folder)
{
 if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
 } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
  xmlhttp.onreadystatechange=function() 
{
    if (this.readyState==4 && this.status==200) {
var data = this.responseText;
var ads = JSON.parse(data);
 var output = "<h1>Results</h1>";
for ( j = 0; j < ads.length; j++) {
output += "<tr class='mn_ads'><td id='mn_url'><a target='_blank' href='http://" + ads[j].url + "'>"+ads[j].name + "</a></td></tr><tr  class='mn_ads'><td id=]mn_description'> " +ads[j].description + ")</td></tr>";
}
  document.getElementById("mn_results_table").innerHTML=output;
  }
 }

xmlhttp.open("GET","/wp-content/plugins/manna-network/incl_links_ajax_crl.php?catid="+catid+"&pageid="+pageid+"&mn_agent_url="+mn_agent_url+"&mn_agent_folder="+ mn_agent_folder,true);
  xmlhttp.send();
}



function updatelinks(str) 
{
var getpieces = str.split("|");
var current_page_number = getpieces[0];
str = '<table><tbody>' + getpieces[1] + '</tbody></table>';
document.getElementById("manna_link_container").innerHTML = str;
} 


  function select_page(selected_page )
{
  document.paginator_form.page_number.value = selected_page ;
  document.paginator_form.submit() ;
}

function getSummaryReport(catid)
{
//if there is a catid then it came in from the category dropdown so set its myarr value to the catid session var
//if there isn't a cat id its because I sent in an empty value from the toggle report links
var myarr = catid.split(":");
 if (catid=="") {
    document.getElementById("summary").innerHTML="";
    return;
  }


var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
document.getElementById("summary_header").value = wording_ajax_summary_header;
      document.getElementById("summary").innerHTML=this.responseText;
    }
  }

document.getElementById("summary_header").value = wording_ajax_summary_header;
document.getElementById("summary").value = myarr[1];
  xmlhttp.open("GET","getsummaryreport.php?q="+myarr[1],true);
  xmlhttp.send();

}

function getLocationReport(catid, regionalid)
{
//if there is a catid then it came in from the category dropdown so set its myarr value to the catid session var
//if there isn't a cat id its because I sent in an empty value from the toggle report links
var myarr = catid.split(":");

 if (catid=="") {
    document.getElementById("summary2").innerHTML="";
    return;
  }
}

/*
function showSubLoc2(str, main_cat_nonce,currentLevel,cat_id) 
{
window,alert('showSubLoc2 func str = '+str);
var myarr = str.split(":");
window,alert('myarr1 func str = '+myarr[1]);
var nextLevel= parseFloat(currentLevel) + 1;
var nextLevelStr= 'nextLevel'+(parseFloat(currentLevel) + 1);
window.alert('showSubLoc = '+nextLevelStr);
window.alert("/wp-content/plugins/manna-network/getsubloc1.php?tregional_num="+myarr[1]+"&main_cat_nonce='"+main_cat_nonce);


  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {

    if (this.readyState==4 && this.status==200) {
var data = this.responseText;


window.alert('data = '+data);


var combo_list = JSON.parse(data);
if(combo_list == "NO MORE SUB CATEGORIES")
{
 document.getElementById("locHint2").innerHTML=combo_list+'<div class="locHint'+nextLevel+'" id="locHint'+nextLevel+'" name="locHint'+nextLevel+'" style="background-color: yellow;"><b></b></div>';
}
else
{
//shouldn't the onchange also call the update Go button? No, that is done by mannanetwork-main
var output = '<form action=""><select name="subLoc2" onchange="showSubLoc3(this.value,\''+main_cat_nonce+'\',\''+nextLevel+'\'),updategoButton(\'false\',this.value,\''+main_cat_nonce+' \',\''+myarr[1]+' \',\''+'\',\''+cat_id+'\')"><option value="">' + wording_ajax_menu1 + '</option>';
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
	output += '<input type="hidden" id="location_name" name="location_name" class ="location_name" value=""><input type="hidden" id="location_id" name="location_id" class ="location_id" value=""></select><br></form>';

window,alert('showSubLoc'+currentLevel+' func'+output+'<div class="locHint'+nextLevel+'" id="locHint'+nextLevel+'" name="locHint'+nextLevel+'" >'+still_more_cats+'</div>');
window.alert("/wp-content/plugins/manna-network/getsubloc1.php?tregional_num="+myarr[1]+"&main_cat_nonce='"+main_cat_nonce);

      document.getElementById("locHint2").innerHTML=output+'<div class="locHint'+nextLevel+'" id="locHint'+nextLevel+'" name="locHint'+nextLevel+'" >'+still_more_cats+'</div>';
     }
 }
  }
document.getElementById("tregional_num").value = myarr[1];
document.getElementById("regional_name").value = myarr[2];
  xmlhttp.open("GET","/wp-content/plugins/manna-network/getsubloc1.php?tregional_num="+myarr[1]+"&main_cat_nonce='"+main_cat_nonce+"'");

  xmlhttp.send();
}


function showSubLoc3(str, main_cat_nonce,currentLevel,cat_id) 
{
window,alert('showSubLoc3 func str = '+str);
var myarr = str.split(":");
window,alert('myarr1 func str = '+myarr[1]);
var nextLevel= parseFloat(currentLevel) + 1;
var nextLevelStr= 'nextLevel'+(parseFloat(currentLevel) + 1);
window.alert('showSubLoc = '+nextLevelStr);
window.alert("/wp-content/plugins/manna-network/getsubloc1.php?tregional_num="+myarr[1]+"&main_cat_nonce='"+main_cat_nonce);


  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {

    if (this.readyState==4 && this.status==200) {
var data = this.responseText;


window.alert('data unexpected non-whitespace character after JSON data at line 3 = '+data);


var combo_list = JSON.parse(data);
window.alert('combo_list = '+combo_list);

if(combo_list == "NO MORE SUB CATEGORIES")
{
 document.getElementById("locHint3").innerHTML=combo_list+'<div class="locHint'+nextLevel+'" id="locHint'+nextLevel+'" name="locHint'+nextLevel+'" style="background-color: yellow;"><b></b></div>';
}
else
{
//shouldn't the onchange also call the update Go button? No, that is done by mannanetwork-main
var output = '<form action=""><select name="subLoc4" onchange="showSubLoc4(this.value,\''+main_cat_nonce+'\',\''+nextLevel+'\'),updategoButton(\'false\',this.value,\''+main_cat_nonce+' \',\''+myarr[1]+' \',\''+'\',\''+cat_id+'\')"><option value="">' + wording_ajax_menu1 + '</option>';
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
	output += '<input type="hidden" id="location_name" name="location_name" class ="location_name" value=""><input type="hidden" id="location_id" name="location_id" class ="location_id" value=""></select><br></form>';

window,alert('showSubLoc'+currentLevel+' func'+output+'<div class="locHint'+nextLevel+'" id="locHint'+nextLevel+'" name="locHint'+nextLevel+'" >'+still_more_cats+'</div>');
window.alert("wp-content/plugins/manna-network/getsubloc1.php?tregional_num="+myarr[1]+"&main_cat_nonce='"+main_cat_nonce);

      document.getElementById("locHint3").innerHTML=output+'<div class="locHint'+nextLevel+'" id="locHint'+nextLevel+'" name="locHint'+nextLevel+'" >'+still_more_cats+'</div>';
      
     }
 }
  }
document.getElementById("tregional_num").value = myarr[1];
document.getElementById("regional_name").value = myarr[2];
  xmlhttp.open("GET","/wp-content/plugins/manna-network/getsubloc1.php?tregional_num="+myarr[1]+"&main_cat_nonce='"+main_cat_nonce+"'");

  xmlhttp.send();
}

function showSubLoc4(str, main_cat_nonce,currentLevel,cat_id) 
{
window,alert('showSubLoc4 func str = '+str);
var myarr = str.split(":");
window,alert('myarr1 func str = '+myarr[1]);
var nextLevel= parseFloat(currentLevel) + 1;
var nextLevelStr= 'nextLevel'+(parseFloat(currentLevel) + 1);
window.alert('showSubLoc = '+nextLevelStr);
window.alert("/wp-content/plugins/manna-network/getsubloc1.php?tregional_num="+myarr[1]+"&main_cat_nonce='"+main_cat_nonce);


  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {

    if (this.readyState==4 && this.status==200) {
var data = this.responseText;


window.alert('data = '+data);


var combo_list = JSON.parse(data);
if(combo_list == "NO MORE SUB CATEGORIES")
{
 document.getElementById("locHint4").innerHTML=combo_list+'<div class="locHint'+nextLevel+'" id="locHint'+nextLevel+'" name="locHint'+nextLevel+'" style="background-color: yellow;"><b></b></div>';
}
else
{
//shouldn't the onchange also call the update Go button? No, that is done by mannanetwork-main
var output = '<form action=""><select name="subLoc4" onchange="showSubLoc5(this.value,\''+main_cat_nonce+'\',\''+nextLevel+'\'),updategoButton(\'false\',this.value,\''+main_cat_nonce+' \',\''+myarr[1]+' \',\''+'\',\''+cat_id+'\')"><option value="">' + wording_ajax_menu1 + '</option>';
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
	output += '<input type="hidden" id="location_name" name="location_name" class ="location_name" value=""><input type="hidden" id="location_id" name="location_id" class ="location_id" value=""></select><br></form>';

window,alert('showSubLoc'+currentLevel+' func'+output+'<div class="locHint'+nextLevel+'" id="locHint'+nextLevel+'" name="locHint'+nextLevel+'" >'+still_more_cats+'</div>');
window.alert("/wp-content/plugins/manna-network/getsubloc1.php?tregional_num="+myarr[1]+"&main_cat_nonce='"+main_cat_nonce);

      document.getElementById("locHint4").innerHTML=output+'<div class="locHint'+nextLevel+'" id="locHint'+nextLevel+'" name="locHint'+nextLevel+'" >'+still_more_cats+'</div>';
     }
 }
  }
document.getElementById("tregional_num").value = myarr[1];
document.getElementById("regional_name").value = myarr[2];
  xmlhttp.open("GET","/wp-content/plugins/manna-network/getsubloc1.php?tregional_num="+myarr[1]+"&main_cat_nonce='"+main_cat_nonce+"'");

  xmlhttp.send();
}

*/


function loadDoc() 
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("demo").innerHTML =
            this.responseText;
       }
    };
  xmlhttp.open("GET","/wp-content/plugins/manna-network/ajax_info.txt", true);
    xhttp.send();
}

/*
function showSubCat1(str, main_cat_nonce, orig_cat_id) 
{
/*
Process:
1) Query remote server, receive JSON string of next menu items
2) Create the next html menu from the data - store as variable "output"
3) Add the next holder for the next menu to ouput var - name it with # currentlevel + 1
4) Replace the div created by previous menu with the new code (note the name of the replaced div will be the same as the current level number)


var a = str.toString().indexOf(":");
if (a == -1)
{
var myarr = ['y',str,'catname'];
}
else
{
var myarr = str.split(":");
}
sessionStorage.setItem('catid', myarr[1]);
/* if (str=="") {
    document.getElementById("txtHint1").innerHTML="";
    return;
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
if(combo_list == "NO MORE SUB CATEGORIES")
{
 document.getElementById("txtHint1").innerHTML=combo_list+'<div class="txtHint2" id="txtHint2" name="txtHint2" style="background-color: yellow;"><b></b></div>';
}
else
{
//shouldn't the onchange also call the update Go button? No, that is done by mannanetwork-main
var output = '<form action=""><select name="subCat1" onchange="showSubCat2(this.value,\''+main_cat_nonce+'\')"><option value="">' + wording_ajax_menu1 + '</option>';
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
	output += '<input type="hidden" id="category_name" name="category_name" class ="category_name" value=""><input type="hidden" id="category_id" name="category_id" class ="category_id" value=""></select><br></form>';
      document.getElementById("txtHint1").innerHTML=output+'<div class="txtHint2" id="txtHint2" name="txtHint2" >'+still_more_cats+'</div>';
     }
}
  }
document.getElementById("category_id").value = myarr[1];
  xmlhttp.open("GET","/wp-content/plugins/manna-network/getsubcat1.php?q="+myarr[1]+"&main_cat_nonce='"+main_cat_nonce+"'",true);
  xmlhttp.send();
 }

function showSubCat2(str, main_cat_nonce) 
{
var myarr = str.split(":");
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
if(combo_list == "NO MORE SUB CATEGORIES")
{
 document.getElementById("txtHint2").innerHTML=combo_list+'<div class="txtHint3" id="txtHint3" name="txtHint3" ><b></b></div>';
}
else
{
var output = '<form action=""><select name="subCat2" onchange="showSubCat3(this.value,'+main_cat_nonce+')"><option value="">' + wording_ajax_menu1 + '</option>';
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
	output += '</select><input type="hidden" id="category_name" name="category_name" class ="category_name" value=""><input type="hidden" id="category_id" name="category_id" class ="category_id" value=""><br></form>';
      document.getElementById("txtHint2").innerHTML=output+'<div class="txtHint3" id="txtHint3" name="txtHint3" style="background-color: yellow;">'+still_more_cats+'</div>';
      }
  }
  if (myarr[0]=="y") {
document.getElementById("category_id").value = myarr[1];
  }else{
document.getElementById("category_id").value = myarr[1];
}
}
  xmlhttp.open("GET","/wp-content/plugins/manna-network/getsubcat2.php?q="+myarr[1]+"&main_cat_nonce='"+main_cat_nonce+"'",true);
  xmlhttp.send();
}


function showSubCat3(str, main_cat_nonce) 
{
var myarr = str.split(":");
/*  if (str=="") {
    document.getElementById("txtHint3").innerHTML="";
    return;
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

if(combo_list == "NO MORE SUB CATEGORIES")
{
document.getElementById("txtHint2").style.backgroundColor = "purple";
 document.getElementById("txtHint3").innerHTML=combo_list+'<div class="txtHint4" id="txtHint4" name="txtHint4" style="background-color: yellow;"><b></b></div>';
}
else
{
var output = '<form action=""><select name="subCat3" onchange="showSubCat4(this.value,\''+main_cat_nonce+'\')"><option value="">' + wording_ajax_menu1 + '</option>';
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
	output += '</select><input type="hidden" id="category_name" name="category_name" class ="category_name" value=""><input type="hidden" id="category_id" name="category_id" class ="category_id" value=""><br></form>';
      document.getElementById("txtHint3").innerHTML=output+'<div class="txtHint4" id="txtHint4" name="txtHint4" style="background-color: yellow;">'+still_more_cats+'</div>';
 //document.getElementById("txtHint4").innerHTML=still_more_cats;
     }
  }
   if (myarr[0]=="y") {
document.getElementById("category_id").value = myarr[1];
  }else{
document.getElementById("category_id").value = myarr[1];
document.getElementById("txtHint3").innerHTML=no_more_subs;
 document.getElementById("txtHint4").innerHTML="";
}
}
  xmlhttp.open("GET","/wp-content/plugins/manna-network/getsubcat3.php?q="+myarr[1]+"&main_cat_nonce='"+main_cat_nonce+"'",true);
  xmlhttp.send();
}

function showSubCat4(str, main_cat_nonce) 
{
var myarr = str.split(":");

 if (str=="") {
    document.getElementById("txtHint3").innerHTML="";
   return;
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
if(combo_list == "NO MORE SUB CATEGORIES")
{
 document.getElementById("txtHint4").innerHTML=combo_list+'<div class="txtHint5" id="txtHint5" name="txtHint5" style="background-color: yellow;"><b></b></div>';
}
else
{
var output = '<form action=""><select name="subCat4" onchange="showSubCat5(this.value,\''+main_cat_nonce+'\')"><option value="">' + wording_ajax_menu1 + '</option>';
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
	output += '</select><input type="hidden" id="category_name" name="category_name" class ="category_name" value=""><input type="hidden" id="category_id" name="category_id" class ="category_id" value=""><br></form>';
      document.getElementById("txtHint5").innerHTML=output+'<div class="txtHint6" id="txtHint6" name="txtHint6" style="background-color: yellow;">'+still_more_cats+'</div>';
   }
  }
   if (myarr[0]=="y") {
document.getElementById("category_id").value = myarr[1];
  }else{
document.getElementById("category_id").value = myarr[1];
document.getElementById("txtHint4").innerHTML=no_more_subs;
  }
}
  xmlhttp.open("GET","/wp-content/plugins/manna-network/getsubcat4.php?q="+myarr[1]+"&main_cat_nonce='"+main_cat_nonce+"'",true);
  xmlhttp.send();

}
*/
</script>
