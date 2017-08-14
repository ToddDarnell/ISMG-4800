<?php
$cname = "Women\'s Clothing";

echo "<H2 align='left'><span>$cname</span></H2>\n";
echo "<table border='0'>\n";
   
// open the XML document
$doc = domxml_open_file("../outdoor.xml");

//get the root element for the document
$root = $doc->document_element();

//get all item elements found in the document
$items = $root->get_elements_by_tagname('item');

// loop through the item elements
foreach($items as $oneitem) 
{
  $found = true;
  // get the catID element array for this item, then
  // get the contents of the 1st (and only) catID in the array
  $catidE        = $oneitem->get_elements_by_tagname("category");
  foreach($catidE as $cat) {
    $catname = $cat->get_content();
    if($catname == $cname) $found=true;
  }

  // Display only Women's Clothing
  if($found == true) {
    // get an element array for each tag_name in an item, then
    // get the contents of the 1st (and only) element in the array
    $nameE        = $oneitem->get_elements_by_tagname("name");
    $name         = $nameE[0]->get_content();
    $imageE       = $oneitem->get_elements_by_tagname("thumbnail");
    $image        = $imageE[0]->get_content();

    $iid          = $oneitem->get_attribute("id");
    echo "<tr><td><img src='../images/$image'>\n" . '<td><a onclick="' .
      //"loadPage('product.php?item=$iid&cat=$cname', 'content');" . '"' .
      "loadPage('product.php?item=$iid&cat=$cname', 'content');\">$name</a>\n"; 
  }
} 
?>
</table>