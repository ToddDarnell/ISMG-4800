<?php 
   session_start();
   if(!isset($_SESSION['auth']) || isset($_SESSION['auth'])==false)
   {
      header("Location: index.html"); 
      exit;
   }
   $conn = mysql_connect('localhost','username','password')
      or die( '<h2>Could not connect to mysql</h2></body></html>');

   mysql_select_db('database') or die('Could not select database<br>');
?>
  
  
