// loaded = true;

function getUTC(xDays)
{
   var exp = new Date();
   exp.setTime(exp.getTime() + (xDays*24*60*60*1000));
   return exp.toUTCString();
}

function getCookieValue (name) 
{  
  var arg = name + "=";
  var start =  document.cookie.indexOf(arg);
  var offset = start + arg.length;
  
  if (start != -1)      
  {
    var endstr = document.cookie.indexOf (";", offset);
    if (endstr == -1)
       endstr = document.cookie.length;

    return document.cookie.substring(offset, endstr);
  }    
  else
    return null;
}


function appendCookie (name, value, days, delim)
{
   // get contents already in cookie
   var current = getCookieValue(name);
   
   // if something already in cookie add new purchases to the end it
   if(current != null)
     value = current + delim + value;
     
   // Set or Reset the cookie
   setCookie(name, value, days);
}

function setCookie (name, value, days)
{
  // Create a persistent cookie
  if (days > 0)
  {  document.cookie = name + "=" + value +
            "; expires=" + getUTC(days) + ";" ;
  }
  else
    document.cookie = name +"="+ value + ";";
}

function deleteCookie (name) 
{  
   var exp = getUTC(-1);     
   var cval = getCookieValue (name);
   document.cookie = name + "=" + cval + "; expires=" + exp + ";";
}

function getCartData(name, delim)
{
  var prods = getCookieValue(name); // product data from cookie
  var nProd = 0;                    // # of products
  var nVal = 5;                     // # of values per product

  pnumA =        new Array();       // arrays to store products
  pnameA =       new Array();       // arrays to store products
  descriptA =    new Array();
  quantityA =    new Array();
  priceA =       new Array();

  // if products have been selected
  if (prods != null)
  {
    prods = prods.split(delim);
    nProd = prods.length/nVal;  
    
  
    // write data to data arrays
    for (var i=0, j=0; j < nProd; i+=nVal, j++)
    {
       pnumA[j] = prods[i];
       pnameA[j] = prods[i+1];
       descriptA[j] = prods[i+2];
       quantityA[j] = parseInt(prods[i+3]) ;
       priceA[j] = parseFloat(prods[i+4]);
    }
  }

  // After arrays complete display the cart
  writeCart(nProd, pnumA, pnameA, descriptA, quantityA, priceA, name, delim);
}

function writeCart(nProd, pnumA, pnameA, descriptA, 
                   quantityA, priceA, name, delim)
{
  // Check if any products selected
  if (nProd < 1 )
    document.writeln("<h2>Your Cart is Empty</h2>");

  else
  { // if we have products create a table for them
    document.writeln('<center><table border=0 bgcolor="ccffcc">');
    
    // loop to write each product on a row
    // each data item in a separate cell
    for ( var j=0; j < nProd;  j++)
    {
      document.writeln("<tr><td>" + pnumA[j]) ;
      document.writeln("<td>" + pnameA[j]) ;
      document.writeln("<td>" + descriptA[j]) ;
      
      // write quantity in textbox so it can be changed
      document.writeln("<td><input size=6 name=q" + j + " value=" + quantityA[j] + ">") ;

      // format price to have 2 decimal places 
      // and add a $ sign
      document.writeln("<td>$" + formatFixed(priceA[j]) + "</tr>") ;
    }
    document.writeln("</table>");

    // Create button to call a update cookie function
    document.write('<input type="button" value="Update Cart"');  
    document.write('onclick="updateCartCookie(this.form,');
    document.write("'" + name + "','" + delim + "',1);");
    document.writeln('location.reload(true);">');
    document.writeln("</center>");
  }
}

function updateCartCookie(form, name, del, exp)
{
          // product data from old cookie
  var prods = getCookieValue(name);
  var nVal = 5;          // # values/product
  var cookieString= "";  // Holds cookie value
  var nProd = 0;         // # products in cart

  // if products have been selected
  if ( prods != null)
  {
  prods = prods.split(del);
  nProd = prods.length/nVal;

  // Create cookie string
  for (var i=0, j=0; j < nProd; i+=nVal, j++)
  {
    // Get quantity from textbox
    var quant = form.elements[j].value;

    // if quantity is a number > 0
    if (quant != 0 &&
        parseInt(quant) != Number.NaN)
    {
      if (cookieString != "")
        cookieString = cookieString + del;

      cookieString = cookieString + prods[i]
           + del + prods[i+1] + del + prods[i+2] + del
           + quant + del + prods[i+4];
     }
  }
  if(cookieString != "")
  { // Overwrite old cookie w/ new values
    setCookie(name,cookieString,exp);
  }
  else
    deleteCookie(name); 
  }
}

// function to format numbers to 2 decimal places
function formatFixed( num)
{
    var strNum;

    if (num%1 == 0)
       strNum = num + ".00";
    else if ((num*10)%1 == 0)
       strNum = num + "0";
    else
       strNum = Math.round(num*100)/100;

    return strNum;
}