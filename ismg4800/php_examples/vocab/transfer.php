<?php 
   // Make database connection
   $conn = odbc_connect('Vocab','','') or die('<h2>Could not connect to Access</h2></body></html>');

   $qry = "Select * from Words ";
   $rs = odbc_exec($conn, $qry);  

   $message = "<p>Begin table creation</p>\n";  

   $cqry = array(
    "CREATE TABLE Words (ListID int , " . "
      Word char(20) primary key, Definition char(255));",
   );
    
   $counter = 1;  
   while(odbc_fetch_row($rs)){
    $list = odbc_result($rs, "ListID");
    $word = odbc_result($rs, "Word");
    $def = odbc_result($rs, "Definition");
    //$qry = str_replace("'", "\'", "Insert into Words(ListID, Word, Definition) values($list, \"$word\", \"$def\");");

    $cqry[$counter] = "Insert into Words(ListID, Word, Definition) values($list, \"$word\", \"$def\");" ;

    $counter++;
  }
  require('db.inc');
  echo executeUpdatePHP($cqry);

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
