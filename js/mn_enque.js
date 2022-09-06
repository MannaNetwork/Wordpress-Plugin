function paginatorMenu(catid, pageid,mn_agent_url,mn_agent_folder,tregional_num,numberOfPages,nonce)
{
//is this function used? Where? is NOT in MAIN. OH, is used in itself (below). So it replaces the paginator_menu on main (which calls the combgetAdDisplayPageReg function instead of this one). That doesn't look right? The combgetAdDisplayPageReg function lacks the numberOfPages argument present in this function.
//So to test, we will create a window.alert
window.alert('In paginatorMenu function - creating a new paginator menu');
//apparently, this function is not used in the script at present. It is not at all comparable to the combgetAdDisplayPageReg function because it doen't even query the database like combgetAdDisplayPageReg function does? AND, the two "for loops" USE the same vars (numberOfPages) while the for loop in paginator.php uses $mn_pgn8tr_menu_items and $number_of_rows. 
     /*FIRST, build a replacement for the paginator menu */
   if(numberOfPages > 5){
  /*add the previous page arrows and button to end of pages */ 
  var output = '<caption>Select More Results Pages</caption><tr>';
for ( j = 0; j < numberOfPages; j++) {
if ( j === 1 ) {
	var lower_limit = 0;
	var upper_limit = 19;
	var link_page_num       = 1;
	output += "<td style=\"text-align:center;\"><a class=\"mn_btn\" href=\"\" onclick=\" paginatorMenu('" +catid+ "','" +pageid+ "','" +mn_agent_url+ "','" +mn_agent_folder+ "','" +tregional_num+ "','" +numberOfPages+ "','" +nonce+ "'); return false;\">Temp Constant"+pageid+'</a>';
} else if ( j > 1 && j !== $number_of_pages ) {
	var lower_limit       = 20 * ( j - 1 );
	var upper_limit       = ( 20 * j ) - 1;
	var link_page_num = j;
	output += "<td style=\"text-align:center;\"><a class=\"mn_btn\" href=\"\" onclick=\" paginatorMenu('" +catid+ "','" +pageid+ "','" +mn_agent_url+ "','" +mn_agent_folder+ "','" +tregional_num+ "','" +numberOfPages+ "','" +nonce+ "'); return false;\">Temp Constant"+pageid+'</a>';
} else {
	var lower_limit                  = 20 * ( j - 1 );
	var number_of_links_on_last_page = count( $url_array ) % 20;
	var upper_limit                  = $lower_limit + $number_of_links_on_last_page;
	var link_page_num            = j;
	output += "<td style=\"text-align:center;\"><a class=\"mn_btn\" href=\"\" onclick=\" paginatorMenu('" +catid+ "','" +pageid+ "','" +mn_agent_url+ "','" +mn_agent_folder+ "','" +tregional_num+ "','" +numberOfPages+ "','" +nonce+ "'); return false;\">Temp Constant"+pageid+'</a>';
	}
     }
output += "</td></tr></table></div>";
 
   } else {
 /* Only tag the currently selected page with different color if not > 5 */  
  var output = '<caption>Select More Results Pages</caption><tr>';
for ( j = 0; j < numberOfPages; j++) {
if ( j === 1 ) {
	var lower_limit = 0;
	var upper_limit = 19;
	var link_page_num       = 1;
	output += "<td style=\"text-align:center;\"><a class=\"mn_btn\" href=\"\" onclick=\" paginatorMenu('" +catid+ "','" +pageid+ "','" +mn_agent_url+ "','" +mn_agent_folder+ "','" +tregional_num+ "','" +numberOfPages+ "','" +nonce+ "'); return false;\">Temp Constant"+pageid+'</a>';
} else if ( j > 1 && j !== $number_of_pages ) {
	var lower_limit       = 20 * ( j - 1 );
	var upper_limit       = ( 20 * j ) - 1;
	var link_page_num = j;
	output += "<td style=\"text-align:center;\"><a class=\"mn_btn\" href=\"\" onclick=\" paginatorMenu('" +catid+ "','" +pageid+ "','" +mn_agent_url+ "','" +mn_agent_folder+ "','" +tregional_num+ "','" +numberOfPages+ "','" +nonce+ "'); return false;\">Temp Constant"+pageid+'</a>';
} else {
	var lower_limit                  = 20 * ( j - 1 );
	var number_of_links_on_last_page = count( $url_array ) % 20;
	var upper_limit                  = $lower_limit + $number_of_links_on_last_page;
	var link_page_num            = j;
	output += "<td style=\"text-align:center;\"><a class=\"mn_btn\" href=\"\" onclick=\" paginatorMenu('" +catid+ "','" +pageid+ "','" +mn_agent_url+ "','" +mn_agent_folder+ "','" +tregional_num+ "','" +numberOfPages+ "','" +nonce+ "'); return false;\">Temp Constant"+pageid+'</a>';
	}
     }
output += "</td></tr></table></div>";
}
  document.getElementById("mn_paginator_menu_table").innerHTML=output;

}

//function showSubLoc1(str, main_cat_nonce,currentLevel,cat_id,type) 
function showSubLoc1(str, main_cat_nonce,currentLevel,cat_id,type,agent_url,agent_folder) 
{
//window.alert('in showsubloc1');
/*
Process:
1) Query remote server, receive JSON string of next menu items
2) Create the next html menu from the data - store as variable "output"
3) Add the next holder for the next menu to ouput var - name it with # currentlevel + 1
4) Replace the div created by previous menu with the new code (note the name of the replaced div will be the same as the current level number)

*/
var myarr = str.split(":");
/*
var is something like <option value='y:" + combo_list[j].id + ':' + combo_list[j].name + ':' + combo_list[j].lft + ':' + combo_list[j].rgt + "'>
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
if(combo_list == "NO MORE SUB CATEGORIES" || combo_list == "Sorry, No More Selections.")
{ 
//note "Sorry, No More Selections." is for regional
 document.getElementById(currentBlockNameStr).innerHTML=combo_list+'<div class="'+nextBlockNameStr+'" id="'+nextBlockNameStr+'" name="'+nextBlockNameStr+'" style="background-color: yellow;"></div>';
}
else
{
var output = '<form action=""><select name="subLoc1" onchange="showSubLoc1(this.value,\''+main_cat_nonce+'\','+nextLevel+','+cat_id+',\''+type+'\',\''+agent_url+'\',\''+agent_folder+'\'),updategoButton(';
//myarr[1] would be the id. Now we concatenate the lft/rgt value (for regions) to send to the dropdown for use in getting number of pages.

if(type=="regions"){
output += '\'false\',this.value,\''+main_cat_nonce+' \',\''+myarr[1]+'\',\''+cat_id+'\')"><option value="">' + wording_ajax_regional_menu1 + '</option>';
}
else
{
output += 'this.value,\'false\',\''+main_cat_nonce+' \',\''+myarr[1]+' \',\''+cat_id+'\')"><option value="">' + wording_ajax_menu1 + '</option>';
}

	for ( j = 0; j < combo_list.length; j++) {
		if ( '' !== combo_list[j].name ) {
			if ( combo_list[j].lft + 1 < combo_list[j].rgt ) {
			//y or n tells the AJAX functions whether there are any more subcategories
				output += "<option value='y:" + combo_list[j].id + ':' + combo_list[j].name + ':' + combo_list[j].lft + ':' + combo_list[j].rgt + "'>" + combo_list[j].name + '</option>';
			} else {
				output += "<option value='n:" + combo_list[j].id + ':' + combo_list[j].name + ':' + combo_list[j].lft + ':' + combo_list[j].rgt + "'>" + combo_list[j].name + '</option>';
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
  /*
if(type=="regions"){

  xmlhttp.open("GET","/wp-content/plugins/manna-network/getsubloc1.php?tregional_num="+myarr[1]+"&main_cat_nonce='"+main_cat_nonce+"&type=regions");
}
else
{

xmlhttp.open("GET","/wp-content/plugins/manna-network/getsubloc1.php?q="+myarr[1]+"&main_cat_nonce='"+main_cat_nonce+"&type=categories");
 
} */
if(type=="regions"){

  xmlhttp.open("GET","/wp-content/plugins/manna-network/getsubloc1.php?tregional_num="+myarr[1]+"&main_cat_nonce="+main_cat_nonce+"&type=regions&agent_url="+agent_url+"&agent_folder="+agent_folder);
}
else
{
xmlhttp.open("GET","/wp-content/plugins/manna-network/getsubloc1.php?q="+myarr[1]+"&main_cat_nonce="+main_cat_nonce+"&type=categories&agent_url="+agent_url+"&agent_folder="+agent_folder);
}
  xmlhttp.send();
}


function deleteAllLevels(category_id,main_cat_nonce,original_cat_id) 
{
//deprecated - removed the 'Clear button from the display
	var regional_dropdown = "<form action=''><table id='mn_location_table'><tr><td><select name='regional_menu' onchange=\"updategoButton('false',this.value,'"+main_cat_nonce+"' ,"+original_cat_id+"),showSubLoc1(this.value,'"+main_cat_nonce+"' ,1,"+category_id+",'regions')><option value=''>"+ wording_ajax_menu1+" </option><option value='y:2566:Africa'>Africa</option><option value='y:2567:America - Central'>America - Central</option><option value='y:2568:America - North'>America - North</option><option value='y:2569:America - South'>America - South</option><option value='y:2572:Asia'>Asia</option><option value='y:2573:Australia/Oceania'>Australia/Oceania</option><option value='y:2756:Caribbean'>Caribbean</option><option value='y:2575:Europe'>Europe</option><option value='y:2740:Middle East'>Middle East</option></select> <input type='hidden' id='regional_name' name='regional_name' class ='regional_name' value=''><input type='hidden' id='tregional_num' name='tregional_num' class='tregional_num'></td></tr></table></form><div id='locHint1' name='locHint1' class='locHint1'><b>"+still_more_cats_reg+"</b></div>";
document.getElementById("mn_location_container").innerHTML = regional_dropdown;
document.getElementById("goLink").innerHTML=""; 
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
var inserturl = '<a href="?gocat=' + mycatarr[1] + '&tregional_num=0' + '&main_cat_nonce=' + nonce +'"><div class="data-container" style="display: flex; align-items: center; justify-content: center;"><span class="mn_btn" ><img height="50" width="50" src="/wp-content/plugins/manna-network/images/go-button-animation.gif"></span></div></a><div style="width:50px; margin:auto;"><a href="?get_filters_info=true" target="_blank" onClick="window.open(\'?get_filters_info=true\',\'pagename\',\'resizable,height=600,width=800\'); return false;"><img height="42" width="42" src="/wp-content/plugins/manna-network/images/green_arrow.png"></a></div>';
}
else
{
var myregarr = submitted_regional_num.split(":");
//the category_id submitted to delete all levels MUST BE the category id of the page currently displayed to them (NOT the category currently selected by the dropdown
/* BEFORE addinf lft/rgt to gobutton
var inserturl = '<a href="?gocat=' + mycatarr[1] + '&tregional_num=' + myregarr[1] + '&main_cat_nonce=' + nonce +'"><button><span class="mn_btn"><img height="50" width="50" src="/wp-content/plugins/manna-network/images/go-button-animation.gif"</span></button></a><div style="width:300px; margin:auto;"><div style="width:50px; margin:auto;"><a href="?get_filters_info=true" target="_blank" onClick="window.open(\'?get_filters_info=true\',\'pagename\',\'resizable,height=600,width=800\'); return false;"><img height="42" width="42" src="/wp-content/plugins/manna-network/images/green_arrow.png"></a></div>'; */

var inserturl = '<a href="?gocat=' + mycatarr[1] + '&tregional_num=' + myregarr[1] + '&main_cat_nonce=' + nonce +'"><button><span class="mn_btn"><img height="50" width="50" src="/wp-content/plugins/manna-network/images/go-button-animation.gif"</span></button></a><div style="width:300px; margin:auto;"><div style="width:50px; margin:auto;"><a href="?get_filters_info=true" target="_blank" onClick="window.open(\'?get_filters_info=true\',\'pagename\',\'resizable,height=600,width=800\'); return false;"><img height="42" width="42" src="/wp-content/plugins/manna-network/images/green_arrow.png"></a></div>'; 
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
	//window.alert('in mn_ajax.js myregarr[1] = '+myregarr);
	var inserturl = '<a href="?' + twoargumentssplit[0] + '&tregional_num=' + myregarr[1] + '&main_cat_nonce=' + nonce +'"><button><span class="mn_btn"><img height="50" width="50" src="/wp-content/plugins/manna-network/images/go-button-animation.gif"</span></button></a>';
	}
else
{
var mycatarr = submitted_category.split(":");
var inserturl = '<a  href="?gocat=' + mycatarr[1] + '&' + twoargumentssplit[1] + '&main_cat_nonce=' + nonce +'"><button><span class="mn_btn"><img height="50" width="50" src="/wp-content/plugins/manna-network/images/go-button-animation.gif"</span></button></a>';
}
}
  document.getElementById("goLink").innerHTML=inserturl; 
    }

function getLinksAllInOne(page_num, category_id,tregional_num, main_cat_nonce, newnum_of_pages, number_of_links, lft, rgt, mn_agent_url, mn_agent_folder){

//window.alert('in allinone - tregional_num being sent to agent = '+tregional_num);
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
 var output = "<h3>New Results</h3>";
for ( j = 0; j < ads.length; j++) {
output += "<tr class='mn_ads'><td id='mn_url'><a target='_blank' href='http://" + ads[j].url + "'>"+ads[j].name + "</a></td></tr><tr  class='mn_ads'><td id='mn_description'> " +ads[j].description + ")</td></tr>";
}
  document.getElementById("mn_results_table").innerHTML=output;
  }
 }
xmlhttp.open("GET","/wp-content/plugins/manna-network/getLinksAllInOne.php?page_num="+page_num+"&category_id="+category_id+"&tregional_num="+tregional_num+"&newnum_of_pages="+newnum_of_pages+"&number_of_links="+number_of_links+"&lft="+lft+"&rgt="+rgt+"&mn_agent_url="+mn_agent_url+"& mn_agent_folder="+mn_agent_folder,true);
 
  xmlhttp.send();
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

xmlhttp.open("GET","/wp-content/plugins/manna-network/links_crl_regional.php?catid="+catid+"&pageid="+pageid+"&mn_agent_url="+mn_agent_url+"&mn_agent_folder="+ mn_agent_folder+"&tregional_num="+ tregional_num+"&main_cat_nonce="+ nonce,true);
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
