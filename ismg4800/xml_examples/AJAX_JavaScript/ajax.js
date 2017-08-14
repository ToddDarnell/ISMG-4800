var http_request = false;
var fram = "content";

function loadXMLPage(url, fr, fcn) {
        http_request = false;
        func = fcn;

        if (window.XMLHttpRequest) { // Mozilla, Safari,...
            http_request = new XMLHttpRequest();
            if (http_request.overrideMimeType) {
                http_request.overrideMimeType('text/xml');
            }
        } else if (window.ActiveXObject) { // IE
            try {
                http_request = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    http_request = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {}
            }
        }
        

        if (!http_request) {
            alert('Giving up :( Cannot create an XMLHTTP instance');
            return false;
        }
        
        http_request.onreadystatechange = fcn;
        
        http_request.open('GET', url, true);
        http_request.send(null);

}
    
// short-cut function to get data from an XML element
function getNodeValue(obj,tag)
{ return obj.getElementsByTagName(tag)[0].firstChild.nodeValue; }

function setCategoryXML()
{  //Icheck to see if the AJAX page is done downloading
  if (http_request.readyState == 4 && http_request.status == 200)
  {  // Get all of the item tags from the XML response
     var items = http_request.responseXML.getElementsByTagName('item');
     // create a div box to stick everything in
     var temp = document.createElement('div');
     temp.id = 'ajax';
     // Create the text category heading for the page putting it in <H2><span> tags.
     var cathead = document.createElement('H2');
     var catspan = document.createElement('span');
     var catname = document.createTextNode("Women's Clothing");
     catspan.appendChild(catname);
     cathead.appendChild(catspan);  
     temp.appendChild(cathead);  // add the heading to the div box

    // Create the table that the thumbnails & links are in
    var table = document.createElement('table');
    // loop through the array ov items
    for (var i=0; i < items.length; i++)
    {
      var x = document.createElement('tr');
      var y = document.createElement('td');
      // create an image tag and set its src attribute to the thumbnail image
      var im = document.createElement('img');
      im.setAttribute("src", "../images/" + getNodeValue(items[i],'thumbnail'));
      y.appendChild(im); // add the image to the <td>
      x.appendChild(y);  // add the <td> to the <tr>
      var z = document.createElement('td');
      // create the hyperlink tag
      var a = document.createElement('a');
      a.setAttribute("onclick",  // use a cookie to store the item name instead of a parameter
        "loadXMLPage('../outdoor.xml', 'content', setProductXML); document.cookie='item="+ i + "';" );
      var b = document.createTextNode(getNodeValue(items[i],'name'));
      a.appendChild(b); // add the name to the link
      z.appendChild(a);  // add the link to the cell
      x.appendChild(z);  // add the cell to the row  
      table.appendChild(x);  // add the row to the table
    }
    temp.appendChild(table);  //add the table to the div
    // add the contents of the div to the AJAX div in index.html
    document.getElementById(fram).innerHTML = temp.innerHTML;
  }
}

function setProductXML()
{

 if (http_request.readyState == 4 && http_request.status == 200)
 {  
  var i = GetCookie('item');
  //alert(i);
  var items = http_request.responseXML.getElementsByTagName('item');
  var temp = document.createElement('div');
  temp.id = 'ajax';

   var cathead = document.createElement('H2');
   var catspan = document.createElement('span');
   var catname = document.createTextNode("Women's Clothing");
   catspan.appendChild(catname);
   cathead.appendChild(catspan);
   temp.appendChild(cathead);
   var table1 = document.createElement('table');
     table1.setAttribute("width", "80%");
     table1.setAttribute("align", "center");
     var x = document.createElement('tr');
     var y = document.createElement('td');
     var im = document.createElement('img');
     im.setAttribute("src", "../images/" + getNodeValue(items[i],'image'));
     y.appendChild(im);
     x.appendChild(y);
     var z = document.createElement('td');
     var a = document.createElement('H2');
     var iname = getNodeValue(items[i],'name');
     var b = document.createTextNode(iname);
     //alert(getNodeValue(items[i],'name'));
     a.appendChild(b);
     z.appendChild(a);
     var c = document.createTextNode(getNodeValue(items[i],'description'));
     z.appendChild(c);
     x.appendChild(z);
     table1.appendChild(x);
   temp.appendChild(table1);
   
    var frm = document.createElement('form');
    frm.setAttribute("name", "frmOrderItems");
    var frmhead = document.createElement('H4');
    frmhead.setAttribute("align", "center");
    var frmtext = document.createTextNode("Order Items");
    frmhead.appendChild(frmtext);
    frm.appendChild(frmhead);
    
    var table2 = document.createElement('table');
    table2.setAttribute("width", "80%");
    table2.setAttribute("align", "center");
    table2.setAttribute("border", "5");
    table2.setAttribute("cellspacing", "2");
    table2.setAttribute("cellpadding", "2");
    var d = document.createElement('tr');
    var e1 = document.createElement('th');
    var f1 = document.createTextNode("Selection");
    e1.appendChild(f1);
    d.appendChild(e1);
    var e2 = document.createElement('th');
    var f2 = document.createTextNode("Size");
    e2.appendChild(f2);
    d.appendChild(e2);
    var e3 = document.createElement('th');
    var f3 = document.createTextNode("Color");
    e3.appendChild(f3);
    d.appendChild(e3);
    var e4 = document.createElement('th');
    var f4 = document.createTextNode("Price");
    e4.appendChild(f4);
    d.appendChild(e4);
    var e5 = document.createElement('th');
    var f5 = document.createTextNode("In Stock?");
    e5.appendChild(f5);
    

   var invs = items[i].getElementsByTagName('inventory');
   var g1 = document.createElement('input');
   g1.setAttribute("type","hidden");
   g1.setAttribute("id","data");
   g1.setAttribute("NAME","data");
   g1.setAttribute("value","Temp|L|Red|1.00");
   e5.appendChild(g1);
   d.appendChild(e5);
   table2.appendChild(d);
   
   for (var j=0;j<invs.length;j++)
   {
     var sz  = getNodeValue(invs[j],'size');
     var col = getNodeValue(invs[j],'color');
     var pr  = getNodeValue(invs[j],'price');
     var qty = parseInt(getNodeValue(invs[j],'qoh'));
     var k = document.createElement('tr');
     var l1 = document.createElement('td');
     l1.setAttribute("align", "center");
     var m1 = document.createElement('input');
     m1.setAttribute("type","radio");
     m1.setAttribute("NAME","item");
     m1.setAttribute("value",iname + "|" + sz + "|" + col + "|" + pr);
     m1.setAttribute("onclick","this.form.data.value=this.value;this.checked=true");
     l1.appendChild(m1);
     k.appendChild(l1);
     var l2 = document.createElement('td');
     l2.setAttribute("align", "center");
     var m2 = document.createTextNode(sz);
     l2.appendChild(m2);
     k.appendChild(l2);
     var l3 = document.createElement('td');
     l3.setAttribute("align", "center");
     var m3 = document.createTextNode(col);
     l3.appendChild(m3);
     k.appendChild(l3);
     var l4 = document.createElement('td');
     l4.setAttribute("align", "center");
     var m4 = document.createTextNode("$" + pr);
     l4.appendChild(m4);
     k.appendChild(l4);
     var l5 = document.createElement('td');
     l5.setAttribute("align", "center");
     var m5 = document.createTextNode((qty>0));
     l5.appendChild(m5);
     k.appendChild(l5);
     table2.appendChild(k);
   }
   frm.appendChild(table2);
      
   var table3 = document.createElement('table');
   table3.setAttribute("width", "80%");
   table3.setAttribute("align", "center");
   table3.setAttribute("border", "0");
   table3.setAttribute("cellspacing", "3");
   table3.setAttribute("cellpadding", "5");
   var r = document.createElement('tr');
   var s = document.createElement('td');
   s.setAttribute("width", "70%");
   var t1 = document.createElement("big");
   var u = document.createTextNode("Desired Quantity");
   t1.appendChild(u);
   s.appendChild(t1);
   var t2 = document.createElement('input');
   t2.setAttribute("type","text");
   t2.setAttribute("id","quantity");
   t2.setAttribute("NAME","quantity");
   t2.setAttribute("size","10");
   s.appendChild(t2);
   r.appendChild(s);
   var v = document.createElement('td');
   v.setAttribute("align", "right");
   var w = document.createElement('input');
   w.setAttribute("type","button");
   w.setAttribute("value","Order Now");
   w.setAttribute("onclick","appendCookie('odCart', this.form.data.value + '|' + this.form.quantity.value, .125,'|');");
   v.appendChild(w);
   r.appendChild(v);
   table3.appendChild(r);
   frm.appendChild(table3);  
   temp.appendChild(frm);
   //var ta = document.createElement('TextArea');
   //ta.setAttribute("value", temp.innerHTML);
   //temp.appendChild(ta);
   
   document.getElementById(fram).innerHTML = temp.innerHTML;
 }
}