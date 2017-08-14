<html>
<head>
  <title>Array 2</title>
</head>
<body>
<p>
<?php
  $names = array("a"=>"Adam", "b"=>"Vu", "c"=>"Todd", "d"=>"Inna");
  foreach($names as $key => $value) {
  echo "$key : $value<br>";  // notice variable embedded
  }                          // directly between ""
?>

</p>
</body>
</html>