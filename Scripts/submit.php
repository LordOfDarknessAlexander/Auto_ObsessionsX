 <?php
 
    $link = mysqli_connect("localhost","d60274290","d60274290","d60274290"); 
    if (mysqli_connect_errno()) 
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    //echo 'Connected successfully'; 

    $sql="INSERT INTO  registrations  (firstname, lastname, email, userName, passWord, hometown)
          VALUES
          ('$_POST[firstname]','$_POST[lastname]','$_POST[email]', '$_POST[username]', '$_POST[password]','$_POST[hometown]')";

    $result = mysqli_query($link,$sql);
    if($result)
    {
    	//registration success 
       header('Location: results.html');     
    }
    else
    {
    	//registration fail 
       header('Location: results1.html');
    }
    mysqli_close($link);
    exit;
?> 
