<?php

include_once('Users/mysqli_connect.php');

$money = $_POST['money'];
$m_marker = $_POST['mmarker'];
$tokens = $_POST['tokens'];
$prestige = $_POST['prestige'];

if(mysql_query("INSERT INTO users VALUES('$money','$m_marker','$tokens','$prestige')"))
{
	echo "Success Grasshopper";
}
else
{
	echo "Insertion failed";
}


?>