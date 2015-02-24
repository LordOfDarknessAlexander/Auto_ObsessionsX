<?php
$SITE_NAME = 'Auto-Obsessions';
function rootURL(){
    static $localExecution = true;  //change to false for execution on server
    return $localExecution?
        'http://localhost/Auto_ObsessionsX/'
        :
        //'http://triosdevelopers.com/A.Sanchez/Assets/AutoObsessionsGame/'
        'http://851entertainment.com/Auto_ObsessionsX/';
}
?>
<p id='legal'><?php echo $SITE_NAME;?> &copy; 2015, All Rights Reserved.
    <a href='<?php echo rootURL() . 'legal.php?page=terms';?>'>Terms</a>
    <a href='<?php echo rootURL() . 'legal.php?page=privacy';?>'>Privacy</a>
    <a href='<?php echo rootURL() . 'legal.php?page=security';?>'>Security</a>
    <a href='<?php echo rootURL() . 'legal.php?page=contact';?>'>Contact</a>
    <a href=''>Credits</a>
</p>
