<?php
require_once './secure.php';
?>
<div id='nav'><!--The side menu column contains the vertical menu-->
    <a href='index.php' title='Play Game'><?php echo isLoggedIn() ? 'Play' : 'Play as Guest';?></a><br>
    <a href='tutorial.php' title='Tutorial'>Tutorial</a><br>
    <a href='credits.php' title='Credits'>Credits</a><br>
    <a href='profiles.php' title='Player Profile'>Profile</a><br>
    <a href='<?php echo isLoggedIn() ? '' : 'members.php';?>' title='Home'>Home</a><br>
</div><!--end of side column and menu -->