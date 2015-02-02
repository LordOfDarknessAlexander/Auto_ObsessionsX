<?php

function ep($str){
    //echo var at _POST
    if(is_string($str) && isset($_POST[$str]) )
        echo $_POST[$str];
}
?>	
<div id="Register">
    <h2>Membership Registration</h2>
		<h3 class="content">Items marked with an asterisk * are essential</h3>
    <fieldset>
	<form action="Users/safer-register-page.php" method="post">
		<label class="label" for="title">Title*</label><input id="title" type="text" name="title" size="15" maxlength="12" value='<?php ep('title'); ?>'>
		<br><label class="label" for="fname">First Name*</label><input id="fname" type="text" name="fname" size="30" maxlength="30" value='<?php ep('fname');?>'>
		<br><label class="label" for="lname">Last Name*</label><input id="lname" type="text" name="lname" size="30" maxlength="40" value='<?php ep('lname');?>'>
		<br><label class="label" for="email">Email Address*</label><input id="email" type="text" name="email" size="30" maxlength="60" value='<?php ep('email');?>'>
		<br><label class="label" for="psword1">Password*</label><input id="psword1" type="password" name="psword1" size="12" maxlength="12" value='<?php ep('psword1');?>'>&nbsp;8 
		to 12 characters
		<br><label class="label" for="psword2">Confirm Password*</label><input id="psword2" type="password" name="psword2" size="12" maxlength="12" value='<?php ep('psword2');?>'>
		<br><label class="label" for="uname">User Name*</label><input id="uname" type="text" name="uname" size="12" maxlength="12" value='<?php ep('uname');?>'>&nbsp;6 
		to 12 characters
		<p><input id="submit" type="submit" name="submit" value="Register"></p>
	</form>
</fieldset>
</div>
