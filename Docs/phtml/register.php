<div id="Register">
<!--
<?php
  // We can include this file in all our files
  // this way, every file will contain all our functions and exceptions
  require_once("Users/bookmark_fns.php");
  require_once('Users/data_valid_fns.php'); 
  require_once('Users/db_fns.php');
  require_once('Users/user_auth_fns.php');
  require_once('Users/output_fns.php');
  require_once('Users/url_fns.php');
?>

-->
<?php
require_once("Users/bookmark_fns.php");
?>


	
   <form method="post" action="Users/register_new.php">
	 <table bgcolor="#cccccc">
	   <tr>
	     <td>Email address:</td>
	     <td><input type="text" name="email" size="30" maxlength="100"/></td></tr>
	   <tr>
	     <td>Preferred username <br />(max 16 chars):</td>
	     <td valign="top"><input type="text" name="username" size="16" maxlength="16"/></td></tr>
	   <tr>
	     <td>Password <br />(between 6 and 16 chars):</td>
	     <td valign="top"><input type="password" name="passwd" size="16" maxlength="16"/></td></tr>
	   <tr>
	     <td>Confirm password:</td>
	     <td><input type="password" name="passwd2" size="16" maxlength="16"/></td></tr>
	   <tr>
	     <td colspan=2 align="center">
	     <input type="submit" value="Register"></td></tr>
	 </table>
   </form>
	
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
    
            

