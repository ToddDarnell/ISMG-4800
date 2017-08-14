<?php 
// Assume user is not authenticated
$auth = false;
if (isset($_POST['username']) && isset($_POST['passwd'])) {
   $username= $_POST['username'];
   $passwd  = $_POST['passwd'];
   session_register('auth');
   $_SESSION['auth'] = true; 
   require ('db.inc'); // Contains mysql_connect & mysql_select_db

   // Formulate the query 
   $sql = "SELECT * FROM Users WHERE username = '$username'"; 
   echo $sql;

   // Execute the query and put results in $result 
   $rs = mysql_query( $sql ) or die ('Unable to execute query.'); 

   // see if any rows in $result. 
   while ( $row = mysql_fetch_array($rs) ) { 
     // Check to see if encrypted password matches. 
     // Use the first two characters of the username as a salt
     $salt = substr($username, 0, 2);
     $cryptpw = crypt($passwd, $salt);
     echo $cryptpw . "  " . $row['password'];
     if( $cryptpw == $row['password']) $auth = true;
    }  
    $_SESSION['auth'] = $auth; 

    if (!$auth) { 
        header( 'WWW-Authenticate: Basic realm="Private"' ); 
        header( 'HTTP/1.0 403 Forbidden' ); 
        exit;
    } else { 
       header("Location: index.php"); 
  } // end else
//} // end if
//else 
  // Redirect to the password UPDATE form
  //header("Location: index.html");  
?>