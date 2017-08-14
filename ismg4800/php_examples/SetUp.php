<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1252">
<TITLE>SetUP MySQL</TITLE>
</HEAD>
<BODY>
<?php 
      $username = 'dgregg';
      $password = '123Chgpwd';
      echo "<H1>Begin Database Set-up</H1>";
      $conn = mysql_connect('localhost',$username, $password)
            or die( '<h2>Could not connect to mysql</h2></body></html>');
      echo 'Connected successfully<br>';


      if(!mysql_select_db($username))
      { echo ("Could not select database $username first time<br>");
        $query  = "CREATE DATABASE $username";
        $result = mysql_query($query);
        mysql_select_db($username) or die("Could not select database $username final try<br>"); 
      }
      echo "Selected $username successfully<br>";
    
      $query = 'Drop Table Users';
      $rs = mysql_query($query);
      echo startup();
      $query = "Select * from Users";
      if(!$rs = mysql_query($query)) echo startup();

      if($rs = mysql_query($query)) {
      // Printing results in HTML
      echo "<table>\n";
      while ($line = mysql_fetch_array($rs)) {
           echo "\t<tr>\n";
           $i = 0;
           foreach ($line as $col_value) {
              if($i%2==0) echo "\t\t<td>$col_value</td>\n";
              $i++;
           }
		   echo "\t</tr>\n";
     }
     echo "</table>\n";
     }
     // Free resultset
     mysql_free_result($rs);

     // Closing connection
    mysql_close($conn);      
      

?>
      
<?php
  function startup()
  {
    $message = "<p>Begin table creation</p>\n";  

    $cqry = array("CREATE TABLE Users(username varchar(15) not null, password varchar(50) not null, PRIMARY KEY (username), KEY password (password));");
    
    $message = $message . executeUpdatePHP($cqry);
  
    $iqryA = array(
     "Insert into Users(username) values('dgregg');",
     "Insert into Users(username) values('crbeeler');",
     "Insert into Users(username) values('nchalagu');",
     "Insert into Users(username) values('pchavez-');",
     "Insert into Users(username) values('mhconnol');",
     "Insert into Users(username) values('tmdarnel');",
     "Insert into Users(username) values('wegerner');",
     "Insert into Users(username) values('ckhau');",
     "Insert into Users(username) values('kpkovach');",
     "Insert into Users(username) values('etmedina');",
     "Insert into Users(username) values('mmendoza');",
     "Insert into Users(username) values('cpprathe');",
     "Insert into Users(username) values('amsalaym');",
     "Insert into Users(username) values('ilselets');",
     "Insert into Users(username) values('m0soroka');",
     "Insert into Users(username) values('cs0thoma');",
     "Insert into Users(username) values('avtruong');",
     "Insert into Users(username) values('vutran');",
     "Insert into Users(username) values('tsitsishvili');",
     "Insert into Users(username) values('jvan');",
     "Insert into Users(username) values('brwood');",
     "Insert into Users(username) values('guest');");

     $message = $message . executeUpdatePHP($iqryA);
 

     return $message;

  } 
  
    function executeUpdatePHP($as)
    {   
        $m = "";
        foreach($as as $value) {
           mysql_query($value) or die('Query failed: ' . mysql_error() . '<br>' . $m);
           $m = $m . $value . "<br>";
        }
        return $m;
    }
  
        
?>
</BODY>
</HTML>


