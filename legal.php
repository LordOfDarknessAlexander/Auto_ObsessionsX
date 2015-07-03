<?php
//meta php file containing several web-pages,
//displays conditiponally based on argument passed in url
require_once 'html.php';
require 'ao.php';
require_once 're.php';
//require_once 'secure.php';
//secure::Login();    //this allows for a single call to secure login across multiple pages!
//$AO_NAME = 'Auto Obsessions';

function subheader($title){
    html::hr();?>
<h2><?php echo $title;?></h2>
<?php
}//match against regex, should only contain lowercase letters
$page = (isset($_GET['page']) && isAlpha($_GET['page']) ) ? $_GET['page'] : '';
//this conditional means only passing specific params to the url
//will display a functional page
if($page == 'terms'){
    html::simpleHead('Terms of Service');
?>
<h1><?php ao::eName()?> Terms of Service</h1>
By using or accessing the AutoObsessions.com web site ("Service"), or any services of <?php ao::eName();?>, Inc ("<?php ao::eName();?>"), you are agreeing to be bound by the following terms and conditions ("Terms of Service").
<br><br>
<ul>
Intellectual Property
<li>The Site and all of its original content are the sole property of <?php ao::eName();?> and are, as such, fully protected by the appropriate international copyright and other intellectual property rights laws.</li>
<li>All other content (ex. Images of vehicles) being used has been provided to us along with the permissions to use them. The items on the site (images, code, etc) are not to be redistributed by you (the user) for </li>
<li>commercial purposes, or for any other reason without our explicit written consent.</li>
</ul>
<br>

<br><br>
Termination
<br>
<?php ao::eName();?> reserves the right to terminate your access to the Site, without any advance notice, but will do it's best to provide you with information of your termination upon request. 
<br>
One such reason may be:
<br>
By violating this terms of service will result in warning, with continued misuse resulting in the termination of your account and possible ban.
<br><br>
Governing Law
<br>
This Agreement is governed in accordance with the laws of Ontario, Canada.
<br><br>
Changes to This Agreement
<br>
<?php ao::eName();?> reserves the right to modify these Terms of Service at any time. This can be done a number of ways including email notifications. Your decision to continue to visit and 
<br>
make use of the Site after such changes have been made constitutes your formal acceptance of the new Terms of Service.
<br>
Therefore, we ask that you check and review this Agreement for such changes on an occasional basis. Should you not agree to any provision of this Agreement or any changes we make to this 
<br>
Agreement, we ask and advise that you do not use or continue to access the <?php ao::eName();?> site immediately.
<br><br>
Security
<br>
Our servers are used by a third party service, and we adhere to it's standards and practices in terms of web security.
<br><br>
Contact Us
<br>
If you have any questions about this Agreement, please feel free to contact us at eEmail
<br><br>
<?php
subheader('')
?>
Policy and Terms updated: 07/03/2015


<?php
}
else if($page == 'privacy'){
    html::simpleHead('Privacy');
?>
<h1><?php ao::eName();?> Privacy Policy</h1>
<?php subheader('General Information');?>
<?php ao::eName();?> and its wholly-owned subsidiaries (collectively "<?php ao::eName();?>") believe that privacy is important to the success and use of the Internet. This statement sets forth <?php ao::eName();?> policy and describes the practices that we will follow with respect to the privacy of the information of users of this site. Should you have any questions about this policy or our practices, please send an email to eEmail.
<br><br>
We collect the e-mail addresses of those who communicate with us via e-mail, aggregate information on what pages consumers access or visit, and information volunteered by the consumer (such as survey information and/or site registrations). The information we collect is used to improve the content of our Web pages and the quality of our service, and is not shared with or sold to other organizations for commercial purposes, except to provide products or services you've requested, when we have your permission, or under the following circumstances:
<ul>
    <li>It is necessary to share information in order to investigate, prevent, or take action regarding illegal activities, suspected fraud, situations involving potential threats to the physical safety of any person, violations of Terms of Service, or as otherwise required by law.</li>
    <li>If <?php ao::eName();?> is acquired by or merged with another company. You shall be notified by <?php ao::eName();?> before information about you is transferred, becoming subject to a different privacy policy.</li>
</ul>
<?php subheader('Information Gathering and Usage');?>
<?php ao::eName();?> collects your personal information online when you voluntarily provide it to us. If you choose to register online, we ask you to provide limited personal information, such as your name, address, telephone number and/or email address, billing address. We also collect information that will allow you to establish a username and password if you decide to register.<br>
When registering with <?php ao::eName();?>, information such as your name, email address, billing address, or payment information shall be requested. Members who register for a free account are not required to submit payment details.<br>
<?php ao::eName();?> uses collected information for the following general purposes:
<ul>
    <li>products and services provision</li>
    <li>billing</li>
    <li>identification and authentication</li>
    <li>services improvement</li>
    <li>contact</li>
    <li>research</li>
</ul>

How We Use Personal Information That We Collect
<br>
Internal Uses
<br>
We may use your personal information within <?php ao::eName();?>: 
<ul>
    <li>(1) to provide you with the services and products you request; </li>
    <li>(2) to answer questions about our services; billing, payment methods or use of our website; </li>
    <li>(3) to process or collect payments for our services,</li>
    <li>(4) to contact you about the products and services that we offer.</li>
</ul>
<br>
Disclosure of Personal Information to Third Parties
<br>
We will not disclose any personal information to any third party (excluding our contractors to whom we may provide such information for the limited purpose of providing services to us and who are obligated to keep the information confidential), unless 
<ul>
    <li>(1) you have authorized us to do so; </li>
    <li>(2) we are legally required to do so, for example, in response to a subpoena, court order or other legal process and/or, </li>
    <li>(3) it is necessary to protect our property rights related to this website.</li>
</ul>
We also may share aggregate, non-personal information about website usage with unaffiliated third parties. This aggregate information does not contain any personal information about our users.

<?php 
subheader('How to Review and Change Your Personal Information');
?>
If you register for a <?php ao::eName();?> account, you may review and change your personal information by logging into Sit<?php ao::eName();?>, then clicking on "Member" in the small menu near the top right and then clicking on "Profile".

<?php
subheader('How We Protect Information Online')
?>
We exercise great care to protect your personal information. This includes, among other things, using industry standard techniques such as firewalls, encryption, and intrusion detection. As a result, 
<br>
while we strive to protect your personal information, we cannot ensure or warrant the security of any information you transmit to us or receive from us. This is especially true for information you 
<br>
transmit to us via email since we have no way of protecting that information until it reaches us since email does not have the security features that are built into our websites.
<br>
In addition, we limit <?php ao::eName();?> employees and contractors' access to personal information. Only those employees and contractors with a business reason to know have access to this 
<br>
information. We educate our employees about the importance of maintaining confidentiality of customer information.
<br>
We review our security arrangements from time to time as we deem appropriate.

<?php
subheader('How can you help protect your information?')
?>
If you are using a <?php ao::eName();?> website for which you registered and choose a password, don't tell your password to anyone. We will not ask you for your password in an unsolicited phone call or 
<br>
in an unsolicited email. Remember to sign out of the <?php ao::eName();?> website and close your browser window when you have finished your work. This is to ensure that others cannot access 
<br>
your personal information and correspondence if others have access to your computer.


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
Questions, Concerns or Comments.
<form action='' method='post'>
    Name:<input type='text' name='name' size='16' maxlength='18'/><br>
    Email:<input type='text' name='email' size='30' maxlength="100"/><br>
    Subject:<input type='text' name='subject' size='30' maxlength='30'><br>
    Content:<input type='text' name='content' size='30' maxlength='30'><br>
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
