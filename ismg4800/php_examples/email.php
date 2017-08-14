<?php
  // Get email parameters from form passed to page
  $to = $_REQUEST["to"];
  $from = "devteam@ouray.cudenver.edu";
  $subject = $_REQUEST["subject"];
  
 // From is not a "required" value so need to add it to an
 // "additional" PHP header. Also can BCC yourself on the email 
 // The \r\n are required at the end of header lines
 $headers = 'From: Ouray <' . $from . '>' . "\r\n";
 $headers .= 'Bcc: dgregg@ouray.cudenver.edu' . "\r\n";  

 $body=  // Begin text-only response to request
"AUTOMATED RESPONSE:\n\nThank you for requesting additional information on: $subject.  We will review your request an respond as soon as possible.\n\nThank you,\nThe Development Team";

 // Send the mail using the mail function
  if (mail($to, $subject, $body, $headers)) 
  {
     echo "<p>Message successfully sent!</p>" ;
     echo "<p>To: $to<br>From: $from<br>Subject: $subject<br>Body: $body";
  } else {
     echo "<p>Message delivery failed...</p>" ;
  }
?>  