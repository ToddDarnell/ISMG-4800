loaded = true;

function GetCookie (name) 
{  
  var arg = name + "=";  
  var alen = arg.length;  
  var clen = document.cookie.length;  
  var i = 0;  
  while (i < clen) 
  {
     var j = i + alen;    
     if (document.cookie.substring(i, j) == arg)      
         return getCookieVal (j);    
     i = document.cookie.indexOf(" ", i) + 1;    
     if (i == 0) break;   
  }  
  return null;
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

function SetCookie (name, value) 
{  
   var argv = SetCookie.arguments;  
   var argc = SetCookie.arguments.length;  
   var expires = (argc > 2) ? argv[2] : null;  
   var path = (argc > 3) ? argv[3] : null;  
   var domain = (argc > 4) ? argv[4] : null;  
   var secure = (argc > 5) ? argv[5] : false;  

   document.cookie = name + "=" + escape (value) + 
   ((expires == null) ? "" : ("; expires=" + expires.toUTCString())) + 
   ((path == null) ? "" : ("; path=" + path)) +  
   ((domain == null) ? "" : ("; domain=" + domain)) +    
   ((secure == true) ? "; secure" : "");
}

function DeleteCookie (name) 
{  
   var exp = new Date();  
   exp.setTime (exp.getTime() - 1);   
   var cval = GetCookie (name);  
   document.cookie = name + "=" + cval + "; expires=" + exp.toUTCString();
}

function getUTC(xDays)
{
   var exp = new Date();
   exp.setTime(exp.getTime() + (xDays*24*60*60*1000));
   return exp.toUTCString();
}

function SetExpiration(expDays)
{
   var exp = new Date(); 
   exp.setTime(exp.getTime() + (expDays*24*60*60*1000));
   return exp;
}

function appendCookie(name, value, exp, delim)
{
  var c = GetCookie(name)
  //alert(name + ": " + c);
  if(c == null) 
  {
     setCookie(name, value, exp);
     return 1;
  }
  else 
  {
     var newvalue = c + delim + value;
     DeleteCookie(name);
     setCookie(name, newvalue, exp);
     return newvalue;
  }
}

function getCookieVal(offset) 
{
    var endstr = document.cookie.indexOf (";", offset);
    if (endstr == -1)
       endstr = document.cookie.length;

    return unescape(document.cookie.substring(offset, endstr));
}

function UpdateCookie (name, form, nprod, nitem, delim) 
{  
     
     var newvalue = "";
     alert(nprod);
     for(var i=0; i < nprod*(nitem+1); i=i+nitem+1)
     {   
     
         if(form.elements[i+nitem-1].value > 0)
         {
          for(var j=0; j < (nitem) ; j++) 
            newvalue = newvalue + form.elements[i+j].value + delim;
         }
     }
     
     newvalue = newvalue.substring(0,newvalue.length-1);
     DeleteCookie(name);
     SetCookie(name, newvalue);
     return newvalue;
}

function F2(num)
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

function writeCart(cookiename, cnum, formn, delim, nitem, head, link1, link2)
{   
 var products = GetCookie(cookiename)
 var total=0
 if ( products != null)
 {
    // Write the table headings
   document.writeln(head);
   products = products.split(delim);
   var j = 0;
   var numprod = products.length/nitem;
   // Loop to write each row in the cart
   for ( var i=0; i < (products.length); i = i + nitem)
   {  
      // Write the Product Name, Description & Price
      // to hidden elements, then show them as plain hidden
      document.writeln('<tr>');
      for( var k = 0; k < (nitem-2); k++)
      {  document.writeln('<td><input type="hidden" name="field' + k + j +
                          '" value = "' + products[i+k] +
                          '">' + products[i+k] + '</td>');
      }
      document.writeln('<td><input type="hidden" name="field' + k + j +
                          '" value = "' + products[i+k] +
                          '">$' + F2(products[i+k]) + '</td>');
      k++;
      if(cnum <= 1)
      {
        document.writeln('<td align="center"><input type="text" size=4 name="field' + k + j +
                          '" value = "' + products[i+k] + '"></td>');
      }
      else
      { 
        document.writeln('<td><input type="hidden" name="field' + k + j +
                          '" value = "' + products[i+k] +
                          '">' + products[i+k] + '</td>');
      }

      document.writeln('<td align="right"><input type="hidden" name="tot" value = "' +
         F2(products[i+k-1]*products[i+k]) + '">$' + F2(products[i+k-1]*products[i+k]) +
         '</td></tr>');
      total = total + products[i+k-1]*products[i+k];
      j++;
   }

   // Calculate the total (price*quantity) & put it in a
   // hidden element, then show it as plain hidden
   // Use the F2 function to show it with 2 decimal places
   document.writeln('<td colspan=' + nitem + ' align="right"><font color="005000"><strong>Subtotal:&nbsp;</strong></font></td><td align="right"><input type="hidden" name="stotal" value = "' + F2(total) + '">$' + F2(total) + '</td></tr>');
   if(cnum <= 1)
   {
     document.writeln('<tr><td colspan=' + (nitem + 1) + ' align="center">');
     document.writeln('<input type="button" name="update" value="Update Cart" onclick="UpdateCookie(\'' + cookiename + '\',' + formn + ',' + numprod+ ',' + nitem + ',\'' + delim + '\');window.location=document.URL">');
     document.writeln('<input type="button" name="clear" value="Clear Cart" onclick="DeleteCookie(\'' + cookiename + '\'); window.location=document.URL">');
     //document.writeln('<input type="button" name="continue" value="Continue Shopping" onclick="window.location=\'' +link1 + '\'">');
     document.writeln('<input type="button" name="checkout" value="Check Out" onclick="window.location=\'' +link2 + '\'">');
     document.writeln('</td></tr>');
   }
   else
   {
      // Display the sub total with a $ and 2 decimal places
      document.writeln('<td colspan=' + nitem + ' align="right"><font color="005000"><strong>Shipping:&nbsp;</strong></font></td><td align="right"><input type="hidden" name="ship" value = "' + F2(Math.max(Math.ceil(.08*total),5)) + '">$' + F2(Math.max(Math.ceil(.08*total),5)) + '</td></tr>');
      // Display the total with a $ and 2 decimal places
      document.writeln('<td colspan=' + nitem + ' align="right"><font color="005000"><strong>Total:&nbsp;</strong></font></td><td align="right"><input type="hidden" name="total" value = "' + F2(total + Math.max(Math.ceil(.08*total),5)) + '">$' + F2(total + Math.max(Math.ceil(.08*total),5)) + '</td></tr>');
      // Store the number of products in a hidden element
      document.writeln('<input type="hidden" name="numprod" value = "' + numprod + '">');
   }
   document.writeln('</td></tr></center></table>');
 }
 else
   document.writeln("<h2>Your cart is empty</h2>");

}
