<?php 
 session_start();

 // If this page is not using https - reload the current page using https
 // Uses the $_SERVER variables to get current filename w/o http://
 if (!$HTTP_SERVER_VARS["HTTPS"]) {
  header("Location: https://$_SERVER['HTTP_HOST']$_SERVER['REQUEST_URI']" );
  exit;
 }

 // If the user is logged in redirect to the page they requested using http
 function auth($filename)
 {
   if(isset($_SESSION['auth']) && isset($_SESSION['auth'])==true) {
     header("Location: " . insecureURL($filename));
     exit;
   }
 }

 // redirect to an insecure URL from a secure page
 function insecureURL($filename)
{
  // get full URL of current page 
  $urlpath=$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI' ] ;
  //get the current filename
  $file = basename($urlpath);

  // if the url contains the old filename - strip it off and 
  // add the name of the new file to it (http://abc.com/old.php)
  // otherwise add the name of the new file to the urlpath 
  if(strpos($urlpath, $file))
    return "http://" . 
       substr ( $urlpath, 0, strlen($urlpath) - strlen($file)) . $filename ;
  else
    return "http://$urlpath$filename"; 
 }
?>