<?php 
  if (strncmp("132.194", $REMOTE_ADDR, 7) != 0) {
    header( 'HTTP/1.0 403 Forbidden' ); 
?> 
    <html><head><title>Information Systems Department</title></head>
    <body><h2>403 Forbidden</h2>
       <p>You cannot access this page from outside CU Denver. 
    </body></html> 
<?php 
    exit; 
}  ?>  
<!-- HTML tags for the forbidden page -->
<html>
<head>
<title>CU Denver Secret Stuff</title>
</head>
<body>
<p>You are on campus!</p>
</body>
</head>