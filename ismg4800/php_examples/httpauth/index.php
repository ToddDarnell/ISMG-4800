<?php
  //$auth = false; // Assume user is not authenticated 
  if(isset( $PHP_AUTH_USER ) && isset($PHP_AUTH_PW)) 
  { 
    // Read the entire file into the variable $file_contents 
    $filename = '/faculty/dgregg/public_html/.htpasswd'; 
    $fp = fopen( $filename, 'r' ); 
    $file_contents = fread( $fp, filesize( $filename ) ); 
    fclose( $fp ); 

    // Place the individual lines from the file contents into an array. 
    $lines = explode ( "\n", $file_contents ); 

    // Split each of the lines into a username and a password pair 
    // and attempt to match them to $PHP_AUTH_USER and $PHP_AUTH_PW. 
    foreach ( $lines as $line ) { 
        list( $username, $password ) = explode( ':', $line ); 

        if ( $username == "$PHP_AUTH_USER" ) { 
            // Get the salt from $password. It is always the first 
            // two characters of a DES-encrypted string. 
            $salt = substr( $password , 0 , 2 ); 

            // Encrypt $PHP_AUTH_PW based on $salt 
            $enc_pw = crypt( $PHP_AUTH_PW, $salt ); 

            if ( $password == "$enc_pw" ) { 
                // A match is found, meaning the user is authenticated. 
                // Stop the search. 
                $auth = true; 
                break; 
            } 
        } 
    } 
}
if(!$auth)
{
  header('WWW-Authenticate: Basic realm="Private"'); 
  header('HTTP/1.0 401 Unauthorized'); 
  echo "Authorization Required."; 
  exit; 
}
else
{ 
echo'<P>You are authorized!</P>';
}
?>