<?php if (isset($_POST['fname']) AND ($_POST['lname'])) echo ' selected="selected"'; ?>
<?php 
$fname = $_POST["fname"];
$lname = $_POST["lname"];
echo 'Thank you '. $_POST['fname'] . ' ' . $_POST['lname'] . ', says the PHP file';
//$q = "SELECT user_id FROM users WHERE fname = '1' ";
//$q = "INSERT INTO users ( fname, lname, ) VALUES (' ',  'fname', 'lname' )";	
if($_POST["fname"] && $_POST["lname"] )
{

//$q = "INSERT INTO users ( fname, lname, ) VALUES (' ',  '$fname', '$lname' )";
//if(mysql_query("INSERT INTO users VALUES('$money','$m_marker','$tokens','$prestige')"))
if(mysql_query("INSERT INTO users ( fname, lname, ) VALUES (' ',  '$fname', '$lname' )"))
{
	echo "Success Grasshopper";
}
else
{
	echo "Insertion failed";
}
/*
$money = $_POST["money"];
$m_marker = $_POST["m_marker"];
$tokens = $_POST["tokens"];
$prestige = $_POST["prestige"];*/
// Here, you can also perform some database query operations with above values.
echo "Welcome ". $fname ."!"; // Success Message
}
?>