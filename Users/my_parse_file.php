<?php 
require ('config.php');

$fname = $_POST["fname"];
$lname = $_POST["lname"];	
if (isset($_POST['fname']) AND ($_POST['lname']))
{
	echo ' selected="selected"';
	echo 'Thank you '. $_POST['fname'] . ' ' . $_POST['lname'] . ', says the PHP file';
	$q = "INSERT INTO users ( fname, lname, ) VALUES ('$fname', '$lname' )";		
	$result = mysqli_query ($dbcon, $q);
	if (@mysqli_num_rows($result) == 1) 
	{
		echo "Welcome ". $fname ."!"; // Success Message
		//Turn the results in to an array
		while($rows = $result->fetch_assoc())
		{
			if(mysqli_query("INSERT INTO users ('',fname, lname, ) VALUES (NULL,'$fname', '$lname' )"))
			{
				echo "Success Grasshopper";
			}
			else
			{
				echo "Insertion failed";
			}
		}
	}
	else
	{
		echo "shit";
	}
}
else
{
	echo "shitakes";
}
?>
<?php 
/*
if($_POST["fname"] && $_POST["lname"] )
{

	//$q = "INSERT INTO users ( fname, lname, ) VALUES (' ',  '$fname', '$lname' )";
	//if(mysql_query("INSERT INTO users VALUES('$money','$m_marker','$tokens','$prestige')")
	$q = "INSERT INTO users ( fname, lname, ) VALUES (' ',  '$fname', '$lname' )";		
	$result = mysqli_query ($dbcon, $q);
	//Count the returned rows
	if (@mysqli_num_rows($result) == 1) 
	{
		//Turn the results in to an array
		while($rows = $result->fetch_assoc())
		{
			if(mysqli_query("INSERT INTO users ( '',fname, lname, ) VALUES (' ',  '$fname', '$lname' )"))
			{
				echo "Success Grasshopper";
			}
			else
			{
				echo "Insertion failed";
			}
		}
	}
	else
	{
		echo "shit";
	}

	/*
	$money = $_POST["money"];
	$m_marker = $_POST["m_marker"];
	$tokens = $_POST["tokens"];
	$prestige = $_POST["prestige"];*/
	// Here, you can also perform some database query operations with above values.
	/*
	echo "Welcome ". $fname ."!"; // Success Message
}
/*
if(!$_POST('submit'))
{
	echo "Please fill the fields";
}
else
{
	//mysql_query = "INSERT INTO users('user_id','fname','lname')VALUES (NULL,'$fname','$lname')";
	mysqli_query("INSERT INTO users ( fname, lname, ) VALUES (' ',  '$fname', '$lname' )");
}
*/
?>