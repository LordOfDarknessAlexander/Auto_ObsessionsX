<div id="Register">
    <div id="myContacts">
    <div>N: <span id="fullname" contenteditable="true" onkeyup="storeMyContact(this.id)"></span></div>
    <div>P: <span id="phone" contenteditable="true" onkeyup="storeMyContact(this.id)"></span></div>
    <div>E: <span id="email" contenteditable="true" onkeyup="storeMyContact(this.id)"></span></div>
    <div><a onclick="clearLocal(); getMyContact();" href="javascript:void(0);">Clear All Of My Data</a></div>
</div>


<div id='fg_membersite_content'>
    <h2>Auto-Obsessions Membership</h2>
    <ul>
    <li><a href='Scripts/register.php'>Register</a></li>
    <li><a href='Scripts/confirmreg.php'>Confirm registration</a></li>
    <li><a href='Scripts/login.php'>Login</a></li>
    <li><a href='Scripts/access-controlled.php'>Auto-Obsessions member's only page</a></li>
    </ul>
</div>

<script type='text/javascript'>
// <![CDATA[

var frmvalidator  = new Validator("login");
frmvalidator.EnableOnPageErrorDisplay();
frmvalidator.EnableMsgsTogether();

frmvalidator.addValidation("username","req","Please provide your username");

frmvalidator.addValidation("password","req","Please provide the password");

// ]]>
</script>

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
    
            <form id='register' action='Scripts/register.php' method='post'
                accept-charset='UTF-8'>
            <fieldset >
            <legend>Register</legend>
            <input type='hidden' name='submitted' id='submitted' value='1'/>
            <label for='name' >Your Full Name*: </label>
            <input type='text' name='name' id='name' maxlength="50" /><br>
            <label for='email' >Email Address*:</label>
            <input type='text' name='email' id='email' maxlength="50" /><br>
             
            <label for='username' >UserName*:</label>
            <input type='text' name='username' id='username' maxlength="50" /><br>
             
            <label for='password' >Password*:</label>
            <input type='password' name='password' id='password' maxlength="50" /><br>
            <input type='submit' name='Submit' value='Submit' />
             
            </fieldset>
            </form>

</div>