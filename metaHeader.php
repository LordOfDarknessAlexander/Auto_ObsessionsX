<?php //this script includes headers for the main pages of the site
require_once 're.php';?>
<div id='header'>
<?php
$h1 = 'Auto-Obsessions';    //ao::NAMES['title'];

if(isset($_GET) ){
    //filter out whitespace, number and special characters
    $p = isAlpha($_GET['page']) ? $_GET['page'] : '';
    //should be a string containing only letters
    if($p == 'login'){
        $h1 .= ' Login';
    }
    elseif($p == 'logout'){
        $h1 .= ' Logout';
    }
    elseif($p == 'members'){
        $h1 .= ' Members';
    }
    elseif($p == 'admin'){
        $h1 .= ' Admin';
    }
    elseif($p == 'register'){
        $h1 .= ' Registration';
    }
    //elseif($p == 'closeAccount'){}
}
//if get not used, display empty page!
?>
<h1><?php echo $h1;?></h1>
    <div id='reg-navigation'>
<?php
if(isset($_GET) AND isset($_GET['page']) ){
    //should be a string containing only letters
    $p = isAlpha($_GET['page']) ? $_GET['page'] : '';

    if($p == 'login'){?>
<!--a href='index.php?page=logout'>Logout</a><br>
<a href='index.php?page=cancel'>Cancel</a><br-->
<?php
    }
    elseif($p == 'logout'){
        //$h1 .= ' Logout';
    }
    elseif($p == 'members'){?>
<!--a href='index.php?page=logout'>Logout</a><br>
<a href='register-password.php'>New Password</a><br-->
<?php
    }
    elseif($p == 'admin'){?>
<!--a href='index.php?page=logout'>Logout</a><br>
<a href='admin_view_users.php'>View Members</a><br>
<a href='upload_images.php'>Upload Images</a><br>
<a href='search_users.php'>Usernames</a><br>
<a href='search_users.php'>Disband</a><br>
<a href='register-password.php'>New Password</a><br-->
<?php
    }
    elseif($p == 'register'){?>
<!--a href='index.php?page=cancel'>Cancel</a><br-->
<?php
    }
    //elseif($p == 'disband'){
        
    //}
}
//if get not used, display empty page!
?>
    </div>
</div>