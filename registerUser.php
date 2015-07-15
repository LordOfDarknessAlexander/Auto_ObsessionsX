<?php

require_once 'html.php';
require_once 'dbConnect.php';
require_once 'create.php';
require_once 're.php';
require_once 'secure.php';
html::doctype();
?>
<html lang=en>
<head>
<?php
html::simpleHead('Members');
html::title('Register');
html::charset();
?>
<link rel='stylesheet' type='text/css' href='includes.css'>
</head>
<body>
  <div id='reg-navigation'>
        <a href='index.php'>Cancel</a><br>
    </div>
</div>
<div id='nav'><!--The side menu column contains the vertical menu-->
    <a href='tutorial.php' title='Tutorial'>Tutorial</a><br>
    <a href='credits.php' title='Credits'>Credits</a><br>
    <a href='profiles.php' title='Player Profile'>Profile</a><br>
    <a href='index.php' title='Home Page'>Home</a><br>
</div><!--end of side column and menu -->

<div id='content'><!-- Start of the login page content. -->
<div id='container'>

  <div id='header'>
    <h1>Registration</h1>
</div>
<?php
// This code inserts a record into the users table
// Has the form been submitted?
Secure::registerUser();
/*
function ep($str){
    //safely echos the entry in $_POST
    if(isset($_POST[$str])){
        //trim removes access whitespace around start and end of entry,
        $t = trim($_POST[$str]);
        echo html::escape($t);
    }
}*/
function fl($name, $text){
    //generates an html form label
    //name:string identifier for the tag
    //text:string content of the element?>
<label class='label' for='<?php echo $name;?>'><?php echo $text;?></label><br>
<?php
}
function itb($name, $size, $maxlength){
    //generates an html input text box
    //name:string identifier for the tag
    //size & maxlength, positive integer values
    $n = html::escape($name);?>
<input id='<?php echo $n;?>' type='text' name='<?php echo $n;?>' size='<?php echo strval($size);?>' maxlength='<?php echo strval($maxlength);?>' value='<?php echo $n?>'><br>
<?php
}
function flti($name, $text, $size, $maxlength){
    //form label text input
    fl($name, $text);
    itb($name, $size, $maxlength);
}
?>

<div id='midcol2'>
    <h2>Membership Registration</h2>
    <h3 class='content'>Items marked with an asterisk * are essential</h3>
	<form action='registerUser.php' method='post'>
<?php
//there are only so many title options, have the user select from list, instead of add text, which has to be validated
?>
        <!--select id='title' name='title'>
            <option value='Mr'>Mr</option>
            <option value='Ms'>Ms</option>
            <option value='Miss'>Miss</option>
            <option value='Undisclosed'>Undisclosed</option>
        </select-->
		<!--label class='label' for='title'>Title*</label><br-->
        <?php fl('title', 'Title*');?>
        <input id='title' type='text' name='title' size='15' maxlength='12' value='<?php html::ep('title'); ?>'>
		<br>
        <?php
        flti('fname', 'First Name*', 30, 30);
        flti('lname', 'Last Name*', 30, 30);
        flti('email', 'Email Address*', 30, 60);        
        fl('psword1', 'Password*');?>        
        <input id='psword1' type='password' name='psword1' size='12' maxlength='12' value='<?php html::ep('psword1');?>'>&nbsp;8 to 12 characters<br>
        <?php fl('psword2', 'Confirm Password*');?>
        <input id='psword2' type='password' name='psword2' size='12' maxlength='12' value='<?php html::ep('psword2');?>'>
		<br>
        <?php flti('uname', 'User Name', 12, 12);?>
		<input id='submit' type='submit' name='submit' value='Register'>

	</form>
</div>
</div><!--content-->
</div><!--container-->
<?php
require 'phtml/legal.php';
html::footer();
?>