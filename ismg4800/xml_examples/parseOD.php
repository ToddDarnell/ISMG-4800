<html>
<head><title>XML Parser</title></head>
<body><table border=0>
<?php 
// open the XML document
$doc = new DOMDocument(); 
$doc->load('od.xml'); 

//get all item elements found in the document
$items = $doc->getElementsByTagName("item");

// loop through the item elements
foreach($items as $oneitem) 
{
  // get the catID element array for this item, then
  // get the contents of the 1st (and only) catID in the array
  $catidE        = $oneitem->getElementsByTagName("catID");
  $catid         = (int)$catidE->item(0)->nodeValue;

  // Display only Women's Clothing
  if($catid == 5) {

   $nameE        = $oneitem->getElementsByTagName("name");
   $name         = $nameE->item(0)->nodeValue;
   $imageE       = $oneitem->getElementsByTagName("thumbnail");
   $image        = $imageE->item(0)->nodeValue;

   $iid          = $oneitem->getAttribute("id");
    echo "<tr><td><img src='images/$image'>" .
         "<td><a href='product.php?cat=5&item=$iid'>$name</a>\n"; 
  }
} 
?>
</table>
</body>
</html>