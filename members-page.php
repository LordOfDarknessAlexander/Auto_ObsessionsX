<?php
require 'html.php';
require 'dbConnect.php';
require_once 'ao.php';
require_once 'pasMeta.php';
require_once 're.php';
require_once 'secure.php';

html::doctype();
?>
<html lang=en>
<head>
<?php
	html::simpleHead('Members');
    html::title("Members' page");
    html::charset();
	eS();
 ?>
    <link rel='stylesheet' type='text/css' href='includes.css'>
    <script type='text/javascript' src='//code.jquery.com/jquery-2.1.0.min.js'></script>
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
    <!-- Include JS File Here -->
    
<?php
$page = (isset($_GET['page']) && isAlpha($_GET['page']) ) ? $_GET['page'] : '';
//echo rootURL() . $page;
$title = '';
//eG();

if($page == 'members'){
	$title = 'Members';
}
else if($page == 'tutorial'){
    $title = 'Tutorial';
}
else{
    echo $page;
}

html::simpleHead($title);
html::charset();
?>
    
</head>
<body>
<div id='container'>
   
<?php
//require 'include/nav.php';
//require 'Users/includes/info-col.php';
if($page == 'members'){
    loadUser();  //rename and change as this can also modifies the user's values
?>
	<div id="header-members">
        <h1>Auto-Obsessions Members</h1> <!-- <?php //'$title' ?> </h1>-->
    </div>
	
	<div id='content'><!-- Start of the member's page content. -->
        <h2>Welcome to the Members' Page <?php 
    $un = isSetS() ? strval($_SESSION['uname']) : '';
    echo $un; 
?></h2>
    <div id='midcol'>
<?php
    //Query the database		
    //Call fails if user not logged in
    $result = $AO_DB->query("SELECT * FROM users WHERE uname = '$un'");
    echo json_encode($result);
    //Count the returned rows
    if(mysqli_num_rows($result) == 1){
	    //Turn the results in to an array
	    $rows = $result->fetch_assoc();
	    $uname = floatval($rows['uname']);
	    $money = floatval($rows['money']);
	    $m_marker = intval($rows['m_marker']);
	    $tokens = intval($rows['tokens']);
	    $prest = intval($rows['prestige']);
        $loggedIn = true;
?>	
            <div id ='playerData'>
                <label>Player: $uname</label>
                <label id='cash'>Money: $money</label>
                <label id='tokens'>Tokens: $tokens</label>
                <label id='prest'>Prestige: $prest</label>
                <label id='markers'>Mile Markers: $m_marker</label>
            </div>	
<?php
    }

    else{
	    $AO_DB->eErr();
	    //If there was a problem.
        ?>
            <p class='error'>Please try again.</p><?php
    }
?>     <!--
                <div id='mid-left-col'>
                    <h3>Member's Events</h3>
                    <p>Welcome to the members area.<br>
                    <br>Browse the many portals here: Play as a guest or log in and save your progress.<br>
                    Enter one of our events to win prizes.<br>Get a hold of our Merchandise today!</p>
                </div><!--end mid-left-col-->  
    
                <div id='mid-right-col'>
                    <h3>Special offers to Members only.</h3>
		            <div id='imog'>
		                <p>Auto-Obsessions</p>
		            </div>
                    <br>
                    <p><b>T-Shirts &pound;25.00</b></p>
                    <!-- <img alt='Polo shirt' title='Polo shirt' height='207' src='Users/images/polo.png' width='280'><br>-->
		            <br>
                </div><!--end  mid-rid-col-->
        
            </div><!--end mid-col-->
        </div><!-- End Div Content -->
    </div><!--end container-->


<?php
    require 'phtml/legal.php';
    html::footer();
}
else if($page == 'tutorial'){
?>
    </head>
    <body>
<div id='container'>

        <div id="header-tutorial">
            <h1>Auto-Obsessions Tutorial</h1>
        </div>

    
<?php
    loadUser();  //rename and change as this can also modifies the user's values
?>
	<div id='content'><!-- Start of the tutorial page content. -->
            <h2>Tutorial Page 
            <div id='content'><!-- Start of the page-specific content. -->
        <h2>Tutorial</h2>
        <p>Auto-Obsessions the game . Easy to play impossible to break the obsession. 
        <br>Win cars in an acution.
        <br>Repair and upgrade them.
        <br>Sell them. ... Yay.</p>
        <!-- End of the page-specific content. -->
    </div><?php 
    $un = isSetS() ? strval($_SESSION['uname']) : '';
    //echo $un; 
?></h2>
    
		<div id='midcol'>
<?php
	require 'phtml/legal.php';
    html::footer();
}
else if($page == 'credits'){
    require 'Users/includes/info-col.php';
    ?>
	    <div id='content'><!-- Start of the page-specific content. -->
            <h2>Credits</h2>
            <p>Development Team : Alexander Sanchez, Tyler Drury<br>
            </p>
	    <!-- End of the Credits content. -->
        </div>
    </div>	
    <?php
    require 'phtml/legal.php';
    html::footer();
}

else{ //if page name does not match
	$AO_DB->eErr();
    echo $page;
	//If there was a problem.
    ?>
        <p class='error'>Please try again.</p><?php
}
?>     
            <div id='mid-left-col'>
                <h3></h3>
                
            </div><!--end mid-left-col-->         
        </div><!--end mid-col-->
    </div><!-- End Div Content -->
</div><!--end container-->


<!-- Nav div-->
<div id='nav'><!--The side menu column contains the vertical menu-->
    <a href='members-page.php?page=members' title='Members'>Members</a><br/>
    <a href='members-page.php?page=tutorial' title='Tutorial'>Tutorial</a><br>
    <a href='members-page.php?page=credits' title='Credits'>Credits</a><br>
    <a href='index.php' title='Home Page'>Home</a><br>	
</div><!--end of side column and menu -->
    
<div id='reg-navigation'>
    <ul>
        <li><a href='index.php' title='Play Game'>Play Game</a></li>
        <li><a href='logout.php'>Logout</a></li>
    </ul>
</div>