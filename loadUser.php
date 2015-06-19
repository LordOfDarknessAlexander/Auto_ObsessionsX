<?php 
require_once 'dbConnect.php';
require_once 'pasMeta.php';
//
//session_start();
//
    $uid = getUID();
    //Quick edit to squish some bugs, Cheers and good luck with the rest!
    //user ID's are unique, making a select query will only returns
    //the fields for a single match, where as user names are not unique and my return multiple sets of fields
    //TODO: make user names unique(only 1 user should match a signle user name in the sql)
    $q = "SELECT * FROM users WHERE user_id = $uid";	
   // $q = "SELECT * FROM users WHERE uname = 'Dante'";	
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
            'm_marker' => intval($rows['m_marker']),
            'cid' =>intval($rows['car_id'])
        ));
    }
    else{
        //echo "No Results";
        // If there was a problem.
            echo "<p class='error'>Query failed, Please try again.</p>";
        //exit();
    }

?>