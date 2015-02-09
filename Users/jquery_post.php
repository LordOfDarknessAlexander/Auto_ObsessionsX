<?php
if($_POST["fname"])
{
$name = $_POST["fname"];
$money = $_POST["money"];
$m_marker = $_POST["m_marker"];
$tokens = $_POST["tokens"];
$prestige = $_POST["prestige"];
// Here, you can also perform some database query operations with above values.
echo "Welcome ". $name ."!"; // Success Message
}
?>