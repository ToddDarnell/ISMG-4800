<html>
<head><title>XML Parser</title></head>
<body><table border=0>
<?php 
// open the XML document
$doc = domxml_open_file("outdoor.xml");

//get the root element for the document
$root = $doc->document_element();

//get all item elements found in the document
$items = $root->get_elements_by_tagname('item');

// loop through the item elements
foreach($items as $oneitem) 
{
  // get the catID element array for this item, then
  // get the contents of the 1st (and only) catID in the array
  $catidE        = $oneitem->get_elements_by_tagname("catID");
  $catid         = (int)$catidE[0]->get_content();

  // Display only Women's Clothing
  if($catid == 5) {
    // get an element array for each tag_name in an item, then
    // get the contents of the 1st (and only) element in the array
    $nameE        = $oneitem->get_elements_by_tagname("name");
    $name         = $nameE[0]->get_content();
    $imageE       = $oneitem->get_elements_by_tagname("thumbnail");
    $image        = $imageE[0]->get_content();

    $iid          = $oneitem->get_attribute("id");
    echo "<tr><td><img src='images/$image'>" .
         "<td><a href='product.php?cat=5&item=$iid'>$name</a>\n"; 
  }
} 
?>
</table>
</body>
</html>