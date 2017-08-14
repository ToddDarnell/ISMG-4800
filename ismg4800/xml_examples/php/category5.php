<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1252">
<TITLE>Women's Clothing</TITLE>
  <link rel="stylesheet" type="text/css" href="../od.css">
</HEAD>
<BODY>
<?php require("../includes/header.inc"); ?>
<?php require("../includes/lmenu.inc"); ?>
<?php
$cname = "Women's Clothing";

echo "<H2 align=left><span>$cname</span></H2>";
echo "<table border=0>";
   
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
    echo "<tr><td><img src='../images/$image'>" .
         "<td><a href=\"product.php?item=$iid&cat=$cname\">$name</a>\n"; 
  }
} 
?>
</table>
<?php require("../includes/rmenu.inc"); ?>
<?php require("../includes/footer.inc"); ?>

</BODY>
</HTML>
