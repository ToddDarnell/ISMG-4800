<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1252">
<TITLE>Outdoor Depot Tutoial Site</TITLE>
 
<link rel="stylesheet" type="text/css" href="od.css">
</HEAD>
<BODY>
<?php require("includes/header.inc"); ?>
<?php require("includes/lmenu.inc"); ?>
<h2><span>About Us</span></h2>
<p>Outdoor Depot is a demonstration Web site that is used to teach students how 
to develop database driven Web sites in PHP, ASP or JSP.&nbsp; The site contains 
a number of features that illustrate how database driven sites can be 
constructed.<ol>
  <li>All pages on all 3 versions of the Web site use server side includes to 
  include the header, left menu, right menu, and footer.</li>
  <li>The &quot;category&quot; page (found under Women's Clothing) is used to 
  automatically generate a list of products for a given product category.&nbsp; 
  It is generated using the following query (Women's Clothing is has a CATID of 
  5):&nbsp;&nbsp; Select * from ITEM Where CATID=5;<br>
  In a real web site there would probably be sub categories before you get to 
  the links to individual products. e.g. Under Women's Clothing it might have 
  pants, shorts, shirts, jackets, shoes and accessories. The sub category page 
  would also be dynamically generated based on queries on the database (e.g. 
  Select * from Categories where PARENTID=5;).</li>
  <li>The category page uses parameter links to pass the itemID and categoryID 
  to a product page which allows information for a specific product to be loaded 
  into a product page template.&nbsp; This page runs several queries to get the 
  Category Name, Product name, description and image as well as to find the 
  specific colors and sizes currently available in inventory.&nbsp; The 
  following queries are used:<br>
  Select * from CATEGORY Where CATID=5;<br>
  Select * from ITEM Where ITEMID=1;<br>
  Select * from INVENTORY Where ITEMID=5 AND CATID = 1;</li>
  <li>The product page allows items to be added to the shopping cart.&nbsp; 
  Currently a JavaScript shopping cart is used, although a server side cart 
  could also be used instead.</li>
  <li>The checkout page writes the order information back to a database for 
  order processing.</li>
  <li>The feedback page takes feedback from a&nbsp; user and writes it to a 
  file.</li>
  <li>The search function searches the database for products that have one of 
  the keywords either in the product name or in the product description.&nbsp; 
  It utilizes a search class that connects to the database, runs the queries and 
  returns the results a s list of search results with links to the appropriate 
  product pages.</li>
  </ol>
<p>This is the PHP version of the database driven Web site tutorial.&nbsp; Other 
versions of the Web site can be found here:<ul>
     <li>Java Server Pages (JSP):
    <a href="http://www.myjavaserver.com/~dgregg/outdoor">
    http://www.myjavaserver.com/~dgregg/outdoor</a>
    </li>
    <li>Active Server Pages VB (ASP):
    <a href="http://dgregg.somee.com/outdoor/">
    http://dgregg.somee.com/outdoor/</a>
    </li>
    </ul>
<?php require("includes/rmenu.inc"); ?>
<?php require("includes/footer.inc"); ?>
