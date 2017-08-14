<html>

<head>
  <title>Test functions</title>
</head>

<body>
<h3>Page to test sum1 and sum2 functions:</h3>
<?php
  function sum1($a, $b)
  { $sum = $a + $b;
    echo $sum;
  }
  sum1(5, 4);

  function sum2($a, $b)
  { global $sum;
    $sum = $a + $b;
    return $sum;
  }
?>
<?php
  $sumx = sum2(3, 4); // Assigns sum to new global variable $sumx
?>
<p><b>Ouput:</b></p>
<?php
  echo "Sum: $sum<br>";    // Would print " Sum: 7".
  echo "Sumx: $sumx<br>";  // Would print " Sumx: 7".
?>

</body>
</html>