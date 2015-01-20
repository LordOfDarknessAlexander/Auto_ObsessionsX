<?php
//meta php file containing several web-pages,
//displays conditiponally based on argument passed in url
require_once 'include/html.php';
//require_once './secure.php';
//secureLogin();    //this alolows for a single call to secure login across multiple pages!
$AO_NAME = 'Auto Obsessions';
function subheader($title){
    html::hr();?>
<h2><?php echo $title;?></h2>
<?php
}
$page = $_GET['page'];
//this conditional means only passing specific params to the url
//will display a functional page
if(is_string($page) && $page == 'terms' ){
    html::simpleHead('Terms of Service');
?>
<h1><?php echo $AO_NAME;?> Terms of Service</h1>
By using the AutoObsessions.com web site ("Service"), or any services of <?php echo $AO_NAME;?>, Inc ("<?php echo $AO_NAME;?>"), you are agreeing to be bound by the following terms and conditions ("Terms of Service").
<br>
IF YOU ARE ENTERING INTO THIS AGREEMENT ON BEHALF OF A COMPANY OR OTHER LEGAL ENTITY, YOU REPRESENT THAT YOU HAVE THE AUTHORITY TO BIND SUCH ENTITY, ITS AFFILIATES AND ALL USERS WHO ACCESS OUR SERVICES THROUGH YOUR ACCOUNT TO THESE TERMS AND CONDITIONS, IN WHICH CASE THE TERMS "YOU" OR "YOUR" SHALL REFER TO SUCH ENTITY, ITS AFFILIATES AND USERS ASSOCIATED WITH IT. IF YOU DO NOT HAVE SUCH AUTHORITY, OR IF YOU DO NOT AGREE WITH THESE TERMS AND CONDITIONS, YOU MUST NOT ACCEPT THIS AGREEMENT AND MAY NOT USE THE SERVICES.
<br>
Please note, accessing any <?php echo $AO_NAME;?> service in your capacity as a government entity, there are special terms that may apply to you. Please see Section G.17, below, for more details.
<br>
If <?php echo $AO_NAME;?> makes material changes to these Terms, you will be notified by email or by posting a notice on our site before the changes are effective. Any new features that augment or enhance the current Service, including the release of new tools and resources, shall be subject to the Terms of Service. Continued use of the Service after any such changes shall constitute your consent to such changes. You can review the most current version of the <a href=''>Terms of Service</a>
<br>
Violation of any of the terms below will result in the termination of your Account. While <?php echo $AO_NAME;?> prohibits such conduct and Content on the Service, you understand and agree that <?php echo $AO_NAME;?> cannot be responsible for the Content posted on the Service and you nonetheless may be exposed to such materials. You agree to use the Service at your own risk.
<?php subheader('A: Account Terms');?>
<?php subheader('B:API Terms');?>
<ul>
</ul>
<?php subheader('C:Accounts, Payments, Refunds and Transactions');?>
<ul>
</ul>
<?php subheader('D:Cancellation and Termination');?>
<ul>
</ul>
<?php subheader('E:Modifications to Service and Prices');?>
<ul>
</ul>
<?php subheader('F:Copyright/Ownership');?>
<ul>
</ul>
<?php subheader('G:General Conditions');?>
<ul>
</ul>
<?php
}
else if($page == 'privacy'){
    html::simpleHead('Privacy');
?>
<h1><?php echo $AO_NAME;?> Privacy Policy</h1>
<?php subheader('General Information');?>
We collect the e-mail addresses of those who communicate with us via e-mail, aggregate information on what pages consumers access or visit, and information volunteered by the consumer (such as survey information and/or site registrations). The information we collect is used to improve the content of our Web pages and the quality of our service, and is not shared with or sold to other organizations for commercial purposes, except to provide products or services you've requested, when we have your permission, or under the following circumstances:
<ul>
    <li>It is necessary to share information in order to investigate, prevent, or take action regarding illegal activities, suspected fraud, situations involving potential threats to the physical safety of any person, violations of Terms of Service, or as otherwise required by law.</li>
    <li>If <?php echo $AO_NAME;?> is acquired by or merged with another company. You shall be notified by <?php echo $AO_NAME;?> before information about you is transferred, becoming subject to a different privacy policy.</li>
</ul>
<?php subheader('Information Gathering and Usage');?>
When registering with <?php echo $AO_NAME;?>, information such as your name, email address, billing address, or payment information shall be requested. Members who register for a free account are not required to submit payment details.<br>
<?php echo $AO_NAME;?> uses collected information for the following general purposes:
<ul>
    <li>products and services provision</li>
    <li>billing</li>
    <li>identification and authentication</li>
    <li>services improvement</li>
    <li>contact</li>
    <li>research</li>
</ul>
<?php
subheader('Data Storage');
echo $AO_NAME;?> uses third-party vendors and hosting partners to provide the necessary hardware, software, networking, storage, and related technology required to execute this site. While <?php echo $AO_NAME;?> owns the code, databases, and all rights to the <?php echo $AO_NAME;?> web-page, application and all its derivatives, you retain all rights to your data.
<?php
subheader('Disclosure');
echo $AO_NAME;?> may disclose personally identifiable information under special circumstances, such as to comply with subpoenas or when your actions violate the <a href=''>Terms of Service Agreement</a>.
<?php
subheader('Change');
echo $AO_NAME;?> may periodically update this policy.<br>
You shall be notified about significant changes in the treatment of personal information by sending a notice to the primary email address specified in your <?php echo $AO_NAME;?> account.
<?php subheader('Questions');?>
Any questions about this Privacy Policy should be addressed to ...
<?php
}
else if($page == 'contact'){
    html::simpleHead('Contact');
?>
Please contact us at...
<?php
}
else if($page == 'security'){
    html::simpleHead('Security');
?>
Here's some stuff we do to make the user feel secure!
<?php
}
else{
?>
ERROR LOADING PAGE! YOU FAIL.
<?php
}
html::footer();
?>
