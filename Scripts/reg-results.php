 <?php

    $link = mysqli_connect("earz.netfirmsmysql.com","d60274290","d60274290","d60274290"); 
    if (mysqli_connect_errno()) 
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    $result = mysqli_query($link,"SELECT * FROM registrations");

    echo "<!DOCTYPE html> <html lang=\"en\"> <head> <title>Registration Results</title>" .
         " <meta charset=\"utf-8\" /> <script>" .
            "table,th,td { border:1px solid black; } </script>" .
         "</head> <body style=\"height: 1034px\">  <div class=\"header\"> </div>" .
         "<div> <section id=\"content\" style=\"height : 650px\">" .
         "<h2 style=\"text-align:center;padding-top:25px\">Tournament Registrations</h2>" .
         " <div style=\"text-align:center\"> "; 
    
    echo "<table  border=\"1\" style=\"width:300px\">" . "<tr><td>" . "First Name:" . "</td><td>" .
         "Last Name:" . "</td><td>" . "EMail:" . "</td><td>" . 
         "ACBL Number:" . "</td><td>" . "Hometown:" . "</td><td>" . 
         "Staying:" . "</td></tr>" ;
    
    while($row = mysqli_fetch_array($result)) 
    {
        echo "<tr><td>";
        echo $row['firstname'];
        echo "</td><td>";
        
        echo $row['lastname'];
        echo "</td><td>";
                
        echo $row['email'];
        echo "</td><td>";
        
        echo $row['ACBLnum'];
        echo "</td><td>";
        
        echo $row['hometown'];
        echo "</td><td>";
        
        echo $row['staying'];
        echo "</td></tr>";
        
    }

    echo("</table>");
    echo "</div> </section> </div><div><footer style=\"left: 0px; top: 81px; height: 115px\">" .
    	 "<span style=\"height: 30px\"><strong>Copyright&copy; 2014LRBT</strong><br/>" .
    	 "</span></footer></div></body></html>";    
    mysqli_close($link);

?> 
