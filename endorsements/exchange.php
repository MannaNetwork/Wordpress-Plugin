<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>

<?php
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

?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<input type='hidden' name='confirm' id='confirm' value='true'/>
Ad Credits: Amount <input type='text' name='amount' id='amount' />
<br>
Recipient: <input type='text' name='userid' id='userid' />

<input type="submit" name="submit" value="Submit">

</form>
</body>
</html>
<?php }
