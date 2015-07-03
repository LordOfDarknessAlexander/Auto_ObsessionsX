<?php
//causing issues
require_once 'ao.php';
$SITE_NAME = 'Auto-Obsessions';
?>
<p id='legal'><?php ao::eName();?> &copy; 2015, All Rights Reserved.
    <a href='<?php echo rootURL() . 'legal.php?page=terms';?>'>Terms</a>
    <a href='<?php echo rootURL() . 'legal.php?page=privacy';?>'>Privacy</a>
    <a href='<?php echo rootURL() . 'legal.php?page=security';?>'>Security</a>
    <a href='<?php echo rootURL() . 'legal.php?page=contact';?>'>Contact</a>
    <!--<a href=''>Credits</a>-->
</p>
