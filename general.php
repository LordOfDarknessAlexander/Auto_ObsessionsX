<?php
function email()
{
	mail($to, $subject, $body, 'From: auto_obsessions@851entertainment.com');
}

function logged_In_Redirect()
{
	if(logged_In()== true)
	{
		header('Location : index.php');
		exit();
	}
}

function protect_Page()
{
	if(logged_In()== false)
	{
		header('Location : protected.php');
		exit();
	}
}

function sanitize($data)
{
	return mysqli_real_escape_string($data);
}

?>