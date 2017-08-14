<?php 
$auth = false; // Assume user is not authenticated 
if (isset($_POST['username']) && isset($_POST['passwd'])) 
{   // Contains mysql_connect & mysql_select_db
    require ('db.inc'); 

    // Formulate the query 
    $sql = "SELECT * FROM Users WHERE username = '" . $_POST['username'] . "'"; 

    // Execute the query and put results in $result 
    $rs = mysql_query( $sql ) or die ('Unable to execute query.'); 

    // see if any rows in $result. 
    while ( $row = mysql_fetch_array($rs) ) 
    { 
       // A matching row was found - the user exists
       // Encrypt password using the first two char of username as a salt
       $salt = substr($_POST['username'], 0, 2);
       $cryptpw = crypt($_POST['passwd'], $salt);

        // Check encrypted password matches database (or no password set yet)
        if(strlen($row['password']) == 0) $auth=true;
        if( $cryptpw == $row['password']) $auth = true;
   }  

   if (!$auth) { 
      header( 'WWW-Authenticate: Basic realm="Private"' ); 
      header( 'HTTP/1.0 403 Forbidden' ); 
      exit;
   } else { 
      // Create the encrypted password
      $cryptpw = crypt($_POST['newpasswd'], $salt);

      // Update the user row
      $sql =  "UPDATE Users SET password='$cryptpw' WHERE " .
            "username='" . $_POST['username'] . "'";
      // Execute the UPDATE
      $result = mysql_query( $sql )  or showerror(  );
      echo "Your password has been updated";
  } // end else
} // end if
else // Redirect to the password UPDATE form
  header("Location: password.html");  
?>