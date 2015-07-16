<?php
//meta php file containing several web-pages,
//displays conditiponally based on argument passed in url

require_once 'legal.php';
require_once 'dbConnect.php';
$title = '';
//require_once 'secure.php';

    html::hr();?>
<h2><?php echo $title;?></h2>
<?php
require_once 'metaHeader.php';
//match against regex, should only contain lowercase letters
$page = (isset($_GET['page']) && isAlpha($_GET['page']) ) ? $_GET['page'] : '';
//this conditional means only passing specific params to the url
//will display a functional page
if($page == 'members'){
    html::simpleHead('Members');
?>



<?php
subheader('Data Storage');
ao::eName();?> uses third-party vendors and hosting partners to provide the necessary hardware, software, networking, storage, and related technology required to execute this site. While <?php ao::eName();?> owns the code, databases, and all rights to the <?php ao::eName();?> web-page, application and all its derivatives, you retain all rights to your data.
We do use local storage on your machine for guests. We are not responsible for the use or changes in your local storage that may cause damages or misuse.<?php
subheader('Disclosure');
ao::eName();?> may disclose personally identifiable information under special circumstances, such as to comply with subpoenas or when your actions violate the <a href='<?php echo rootURL() . 'legal.php?page=terms';?>'>Terms of Service</a>.
<?php
subheader('Change');
ao::eName();?> may periodically update this policy.<br>
As we update and improve our services, new features may require modifications to the privacy statement. 
    Accordingly, please check back periodically. We will do our best to notify our users of these changes in the treatment of personal information by sending a notice to the primary 
    email address specified in your <?php ao::eName();?> account. 

<?php subheader('Questions');?>
Any questions about this Privacy Policy should be addressed to ...
<?php
subheader('')
?>
Policy and Terms updated: 07/03/2015
<?php
}
else if($page == 'contact'){
    html::simpleHead('Contact');
?>
<h1>Contact <?php ao::eName();?></h1>
<?php 
    if(isSetP() && !empty($_POST)){
        //$n = $_POST['name'];
        //$e = $_POST['email'];
        //$s = $AO_DB->strip('subject');
       // $c =$AO_DB->strip('content');
        echo $s;
    }
?>
Questions, Concerns or Comments.
<form action='' method='post'>
    Name:<input id='name' type='text' name='name' size='16' maxlength='32'/><br>
    Email:<input id='email' type='text' name='email' size='32' maxlength="64"/><br>
    Subject:<input id='subject' type='text' name='subject' size='32' maxlength='32'><br>
    Content:<br><textarea id='content' name='Content' rows='8'  maxlength='256' cols='32'></textarea><br>
    <input type='submit' value='Send'>    
</form>
<?php
}
else if($page == 'security'){
    html::simpleHead('Security');
?>
<h1><?php ao::eName();?> Security</h1>
Here's some stuff we do to make the user feel secure!
<?php subheader('Systems');?>
<?php subheader('Operations');?>
<?php subheader('Communications');?>
<?php subheader('Data Storage');?>
<?php subheader('Employee Access');?>
For any additional questions or concerns, please <a href='<?php echo rootURL() . 'legal.php?page=contact';?>'>contact us</a>.
<?php
}
else{
?>
ERROR LOADING PAGE!
<?php
}
html::footer();
?>
