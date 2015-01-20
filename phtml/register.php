<div id="Register">
<?php
 //require_once('AOUsers_include.php');
?>	
    <h2>Membership Registration</h2>
		<h3 class="content">Items marked with an asterisk * are essential</h3>
			<h3 class="content">When you click the 'Register' button, you will 
			be switched to a page<br>for paying your membership fee with PayPal or a Credit/Debit 
			card</h3>
			<p class="cntr"><b>Membership classes:</b> Standard 1 year: &pound;30, Standard 5years: 
			&pound;125, Armed Forces 1 year: &pound;5,<br>Under 21 one year: &pound;2,&nbsp; Other: If 
			you can't afford &pound;30 please give what you can, minimum &pound;15 </p>
			<fieldset>
	<form action="Users/safer-register-page.php" method="post">
		<label class="label" for="title">Title*</label><input id="title" type="text" name="title" size="15" maxlength="12" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
		<br><label class="label" for="fname">First Name*</label><input id="fname" type="text" name="fname" size="30" maxlength="30" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>">
		<br><label class="label" for="lname">Last Name*</label><input id="lname" type="text" name="lname" size="30" maxlength="40" value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>">
		<br><label class="label" for="email">Email Address*</label><input id="email" type="text" name="email" size="30" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" >
		<br><label class="label" for="psword1">Password*</label><input id="psword1" type="password" name="psword1" size="12" maxlength="12" value="<?php if (isset($_POST['psword1'])) echo $_POST['psword1']; ?>" >&nbsp;8 
		to 12 characters
		<br><label class="label" for="psword2">Confirm Password*</label><input id="psword2" type="password" name="psword2" size="12" maxlength="12" value="<?php if (isset($_POST['psword2'])) echo $_POST['psword2']; ?>" >
		<br><label class="label" for="uname">Secret User Name*</label><input id="uname" type="text" name="uname" size="12" maxlength="12" value="<?php if (isset($_POST['uname'])) echo $_POST['uname']; ?>">&nbsp;6 
		to 12 characters
		<br><label class="label" for="class">Membership Class*</label>
		<select name="class">
		<option value="">- Select -</option>
		<option value="30"<?php if (isset($_POST['class']) AND ($_POST['class'] == '30')) echo ' selected="selected"'; ?>>Standard 1 year &pound;30</option>
		<option value="125"<?php if (isset($_POST['class']) AND ($_POST['class'] == '125')) echo ' selected="selected"'; ?>>Standard 5 years &pound;125</option>
		<option value="5"<?php if (isset($_POST['class']) AND ($_POST['class'] == '5')) echo ' selected="selected"'; ?>>Armed Forces 1 year &pound;5</option>
		<option value="2"<?php if (isset($_POST['class']) AND ($_POST['class'] == '2')) echo ' selected="selected"'; ?>>Under 22 1 year &pound;2**</option>
		<option value="15"<?php if (isset($_POST['class']) AND ($_POST['class'] == '15')) echo ' selected="selected"'; ?>>Minimum 1 year &pound;15</option>
		</select>
		<br><label class="label" for="addr1">Address*</label><input id="addr1" type="text" name="addr1" size="30" maxlength="30" value="<?php if (isset($_POST['addr1'])) echo $_POST['addr1']; ?>">
		<br><label class="label" for="addr2">Address</label><input id="addr2" type="text" name="addr2" size="30" maxlength="30" value="<?php if (isset($_POST['addr2'])) echo $_POST['addr2']; ?>">
		<br><label class="label" for="city">City*</label><input id="city" type="text" name="city" size="30" maxlength="30" value="<?php if (isset($_POST['city'])) echo $_POST['city']; ?>">
		<br><label class="label" for="county">County*</label><input id="county" type="text" name="county" size="30" maxlength="30" value="<?php if (isset($_POST['county'])) echo $_POST['county']; ?>">
		<br><label class="label" for="pcode">Post Code*</label><input id="pcode" type="text" name="pcode" size="15" maxlength="15" value="<?php if (isset($_POST['pcode'])) echo $_POST['pcode']; ?>">
		<br><label class="label" for="phone">Telephone</label><input id="phone" type="text" name="phone" size="30" maxlength="30" value="<?php if (isset($_POST['phone'])) echo $_POST['phone']; ?>">
		<p><input id="submit" type="submit" name="submit" value="Register"></p>
	</form>
</fieldset>
</div>
<!---
<div id='fg_membersite_content'>
    <h2>Auto-Obsessions Membership</h2>
    <ul>
    <li><a href='Scripts/register.php'>Register</a></li>
    <li><a href='Scripts/confirmreg.php'>Confirm registration</a></li>
    <li><a href='Scripts/login.php'>Login</a></li>
    <li><a href='Scripts/access-controlled.php'>Auto-Obsessions member's only page</a></li>
    </ul>
</div>
--->

<!--
<form id='register'>

 <h1>Registration Form</h1>
 
    Name:<input id='userID' type='text'><br>
            Address:<input id='userPW' type='text'><br>
            City:<input id='userCity' type='text'><br>
            State/Prov:<input id='userSP' type='text'><br>
            Country:<input id='userCountry' type='text'><br>
            Zip/Postal:<input id='userZP' type='text'><br>
            D.O.B.:<input id='userDOB' type='text'><br><!--change to date selector?--> 
         <!--   
            Username:<input id='userName' type='text'><br>
            Password:<input id='userPW' type='text'><br>
            Confirm Password:<input id='userPWConfirm' type='text'><br>
        <input type='submit' value='SUBMIT'>
        </form>
        -->
    
            

