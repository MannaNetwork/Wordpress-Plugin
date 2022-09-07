<?php
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

get_header();
include(dirname(__DIR__, 3)."/manna-network/members/classes/member_page_class.php");
include(dirname(__DIR__, 3)."/manna-configs/db_cfg/agent_config.php");//load order 1
include(dirname(__DIR__, 3)."/manna-network/members/css/members_menu.css");

if (array_key_exists('store', $_POST)) {
include(dirname( __FILE__, 1 ). "/dbconfig/auth.php");
include(dirname( __FILE__, 1 ). "/dbconfig/pdoconnect.php");

try{
$stmt = $dbh->prepare("INSERT INTO bcvorg (BCValue, Username) VALUES (:BCValue, :Username)");
$stmt->bindParam(':BCValue', $_POST['amount']);
$stmt->bindParam(':Username', $_POST['userid']);

// insert one row
$stmt->execute();
$stmt->debugDumpParams();

/*$stmt = $dbh->query("SELECT * FROM table_one");
$user = $stmt->fetch();
print_r($user); */
}  ///prepared statement 
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}

//defining the variables
$vsb_balance = "";
$dmc_balance = "";


echo '<r>Now we will post to the database<br>';
print_r($_POST);
}
elseif (array_key_exists('confirm', $_POST)) {
print_r($_POST);
$linkInfo = new member_page_info();
 
$user_id = $_SESSION['user_id'];
echo '<br>$_POST[\'agentId\'] = ', $_POST['agentId'];
$agentid = $_POST['agentId'];
$confirmAgentID = $linkInfo->get_num($_POST['agentId']) ;
echo '<h1>$confirmAgentID = ', $confirmAgentID;
echo '</h1>';
//dev code check and test
if(is_numeric($_POST['agentId']))
echo '<br><h2>Agent id is numeric</h2>';

echo '<br>Now we will make a form showing the inputs in another form (for confirmation)<br>';
print_r($_POST);

?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<input type='hidden' name='store' id='store' value='true'/>
<input type='hidden' name='amount' id='amount' value='<?php echo $_POST['amount'];?>'/>
<input type='hidden' name='userid' id='userid' value='<?php echo $_POST['userid'];?>'/>'/>



Ad Credits: Amount <?php echo $_POST['amount'];?>/><br>
Recipient: <?php echo $_POST['userid'];?>/>

<input type="submit" name="submit" value="Submit">

</form>
<?php
}
else
{
// before anything, let's get the users balances for each coin type to make sure they can't transfer coin they don't have!
$memberInfo = new member_page_info();
$users_balances_string = $memberInfo->getUserBalanceFromCentral ($user_id, AGENT_ID);
//returns  array( $bitcoin_cash_balance|$democoin_balance ); (the pipe [|] is the delimiter
//so we explode the string into a two-item array
$users_balances = explode("|",$users_balances_string);
echo file_get_contents('views/_menu.php', true);

/* *~*~*~*~*~*~*~*~*~*~*~*~*~*~*~ This page is designed to encourage edits from this point forward *~*~*~*~*~*~*~*~*~*~*~*~*~*~ */


?>

<div class="box_content" id="box_content" name="box_content">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php

if($users_balances_string[0] >0 && $users_balances_string[1] >0){
echo '<p>';
echo EXCHANGE_COIN_TYPE_BOTH;//CONSTANTS in translations/en.php
echo '</p>
<div>BitcoinSV Backed <input type="radio" id="bsv" name="coinType" value="BSV"><br>
Demo Coin(free) <input type="radio" id="css" name="fav_language" value="Demo">';
}
elseif($users_balances_string[0] >0)
{
echo '<div style="background-color: #ABBAEA;">'.EXCHANGE_COIN_TYPE_BSV;
}
else
{
echo '<div style="background-color: #ABBAEA;">'.EXCHANGE_COIN_TYPE_DEMO;
}
echo '</div><hr>';
?>
<div class="box_content" id="box_content" name="box_content">

<input type='hidden' name='confirm' id='confirm' value='true'/></div>
<input type='hidden' name = 'agentId' id='agentId' value='<?php echo AGENT_ID;?>'>
<p>Ad Credits: Amount <input type='text' name='amount' id='amount' />
<br>
Recipient: <input type='text' name='userid' id='userid' />

<input type="submit" name="submit" value="Submit">

</form> </div>
<div class="box_content" id="box_content" name="box_content">"<?php echo PROMO_FOOTER; ?>"</div></div>

<?php }

/* *~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~ No editing beyond this point!! *~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~ */

get_footer();
