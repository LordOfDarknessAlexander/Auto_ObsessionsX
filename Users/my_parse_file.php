<?php if (isset($_POST['fname']) AND ($_POST['lname'])) echo ' selected="selected"'; ?>
<?php 

echo 'Thank you '. $_POST['fname'] . ' ' . $_POST['lname'] . ', says the PHP file';
//$q = "SELECT user_id FROM users WHERE fname = '1' ";
$q = "INSERT INTO users ( fname, lname, ) VALUES (' ',  'fname', 'lname' )";	

?>