<?php 
require_once 'include/dbConnect.php';
//$uname = $_SESSION[uname];

session_start();

//since no vars need to be passed to this script for it to work,
//post doesn't matter
//if(isset($_POST) )
//{
//if(isset($_SESSION['user_id']))
//{
    $uid = $_SESSION['user_id']; 
    //Quick edit to squish some bugs, Cheers and good luck with the rest!
    //user ID's are unique, making a select query will only returns
    //the fields for a single match, where as user names are not unique and my return multiple sets of fields
    //TODO: make user names unique(only 1 user should match a signle user name in the sql)
    //$q = "SELECT * FROM users WHERE user_id = $uid";	
    $q = "SELECT * FROM users WHERE uname = 'Dante'";	
    $result = $AO_DB->query($q);
    //Count the returned rows
    if($result) //mysqli_num_rows($result) != 0)
    {
        $rows = $result->fetch_assoc();
        //json_encode will implicitly convert the array to an object
        //NOTE:sql retrives data as strings, so must conver to numeric type before sending(strings are bulky)
        echo json_encode(array(
            'money' => floatval($rows['money']),
            'tokens' => intval($rows['tokens']),
            'prestige' => intval($rows['prestige']),
            'm_marker' => intval($rows['m_marker'])
        ));
        //Turn the results in to an array
        /*while($rows = $result->fetch_assoc())
        {
            $money = $rows['money'];
            $m_marker = $rows['m_marker'];
            $tokens = $rows['tokens'];
            $prestige = $rows['prestige'];
            $varma = array("$money","$tokens","$prestige","$m_marker"); 
            //header( 'Content-Type: application/json' );
            //echo '{"money":"' . $money . '", "tokens":"' . $tokens . '","prestige":"' . $prestige . ',"m_marker":"' . $m_marker . '"}';
            //echo '{"money": . $money ", "tokens":"' . $tokens . '","prestige":"' . $prestige . ',"m_marker":"' . $m_marker . '"}';
            //print json_encode( $varma );
            echo json_encode($varma,JSON_FORCE_OBJECT); //this makes multiple echo's
            //$varma2 = $_GET['$varma'];
            //print json_encode( $varma2 );
        }*/
    }
    else{
        //echo "No Results";
        // If there was a problem.
            echo '<p class="error">Please try again.</p>';
        //exit();
    }
    //mysqli_close($dbcon);
//}
//else{
    //echo 'user name not set';
//}
//}
//else{
    //echo 'post not set';
//}
?>