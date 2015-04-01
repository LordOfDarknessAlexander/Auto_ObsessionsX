<?php
function email()
{
	mail($to, $subject, $body, 'From: asanchez@auto-obsessions.me');
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