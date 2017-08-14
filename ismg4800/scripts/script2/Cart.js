/*
 * Shopping Cart Library
 * This script uses the CookieUtility script for some advanced
 * cookie setting abilities
 *
 */
 
loaded=true;

 var SHIPPING = "10.00"; // shipping charge constant
 
 var cart = new Cookie("shoppingcart", 30, "/");
 
 function getIndex() {
 
 if (cart.getSubValue("index") == null)  // checks if no index has been created previously.
   cart.setSubValue("index", "0"); // and sets initial index value to this virgin cookie
  
   return parseInt( cart.getSubValue("index") ); 
   
}

 function setCart(id, desc, price, quantity) {

 var index = getIndex();
 
 if (index > 0) { //increment quantity instead of creating new value
  for (var i = 0; i < index; i++) {
    if ( cart.getSubValue("ID" + i) == id) {
        cart.setSubValue("Quantity" + i, (parseFloat(cart.getSubValue("Quantity" + i) ) +1) ); 
        return;
        }
      }
    }
 
 cart.setSubValue("ID" + index, id);
 cart.setSubValue("Desc" + index, desc);
 cart.setSubValue("Price" + index, price);
 cart.setSubValue("Quantity" + index, quantity);
 cart.setSubValue("index", ++index);
 }
 
 function testCart() {
 
 var index = cart.getSubValue("index");
 
 alert(
	   "index =" + cart.getSubValue("index") + 
       "last added ID=" + cart.getSubValue("ID" + index)
       + 
       "last added Desc=" + cart.getSubValue("Desc" + index) 
       + 
       "last added Price=" + cart.getSubValue("Price" + index) 
       + 
       "last added Quantity=" + cart.getSubValue("Quantity" + index)
       );
 }


/* Not really using this anymore */
function splitCookie() {

var array = new Array();
var end = getIndex();
var start = end - getIndex();


for ( var i = 0; i < end*5; i += 5, start++ ) {
 array[i] = cart.getSubValue( "ID" + start );
 array[i+1] = cart.getSubValue( "Desc" + start );
 array[i+2] = cart.getSubValue( "Price" + start  );
 array[i+3] = cart.getSubValue( "Quantity" + start );
 array[i+4] = parseFloat(cart.getSubValue("Quantity" + start)) * parseFloat(cart.getSubValue("Price" + start));
 }
 
 return array;
 
 }
 
 function displayCart() {
 
 var td2 = '<td class="CartBody2">';
 var td1 = '<td class="CartBody">';
 var total = 0, grandtotal = 0;
 var subValueNames = new Array("ID", "Desc", "Price", "Quantity");
 var subValues = new Array();
  
  
  if (getIndex() == 0 ) {
   document.writeln('<h1>Your cart is empty.</h1>');
   return; }
 
 document.writeln('<form>');
 document.writeln('<center><table summary="Shopping Cart Data" class="Cart" cellspacing="0"');
 document.writeln('<tr>');
 
 document.writeln('<td class="CartHeading">Product Number</td>');
 document.writeln('<td class="CartHeading">Description</td>');
 document.writeln('<td class="CartHeading">Price</td>');
 document.writeln('<td class="CartHeading">Quantity</td>');
 document.writeln('<td class="CartHeading">Total</td>');
 document.writeln('</tr>');

 document.writeln('<tbody>');
 
 for (var i = 0; i < getIndex(); i++ ) {
   if (i%2 != 0)
     tddef = td1;
   else tddef = td2;
   
   subValues[0] = cart.getSubValue(subValueNames[0] + i);  
   subValues[1] = cart.getSubValue(subValueNames[1] + i);
   subValues[2] = cart.getSubValue(subValueNames[2] + i);
   subValues[3] = cart.getSubValue(subValueNames[3] + i);
   
   if (subValues[0] !=null) { //only printing subvalues with data  -- kinda hackish
 
   document.writeln('<tr>');
   document.writeln(tddef + subValues[0] + '</td>');
   document.writeln(tddef + subValues[1] + '</td>');
   document.writeln(tddef + '$' + subValues[2] + '</td>');
   document.writeln(tddef + '<input size =6 name="quantity' + i + '"' + 'id="quantity=' + i + '"' + 'value="' + subValues[3] + '"></td>');
   total = parseFloat(cart.getSubValue("Quantity" + i)) * parseFloat(cart.getSubValue("Price" + i));  //reverting back to old syntax 
   document.writeln(tddef + '$' + formatFixed(total) + '</td>');
   document.writeln('<tr>');
   grandtotal += total;
   }
 
 }
 
 if (grandtotal == 0) //fix to show empty cart after update
  document.writeln('<tr><td colspan="5">Your Shopping Cart is now empty</td></tr>');
 
 
 else { 
 var tdcs1 = '<td class="CartBody" style="text-align: ';
 var tdcs2 ='<td class="CartBody2" style="text-align: ';
 var i = getIndex() + 2;
 
 if ( i%2 !=0 )
   var tddefcs = tdcs1;
  
 else 
    var tddefcs = tdcs2;
    
    
   document.writeln('<tr>' + tddefcs + 'right;" colspan="4">' + 'Total</td>' + tddefcs + 'center; color: red;">' + '$' + formatFixed(grandtotal) + '</td></tr>');
   }	
 

  
 document.writeln('</tbody></table>');
 
 
 document.writeln('<input type="button" value="Clear Cart" onclick="deleteCart();" />');
 document.writeln('<input type="button" value="Update Cart" onclick="updateCart(this.form)" />');
 document.writeln('<br /><br />');
 
 if (grandtotal == 0)
   document.writeln('<input type="button" disabled="false" value="Proceed to Checkout" onclick="window.location.href=\'checkout.html\';" />');
 else
   document.writeln('<input type="button" value="Proceed to Checkout" onclick="window.location.href=\'checkout.html\';" />');  
 document.writeln('</form></center>'); //end form
 }
 

 
 function updateCart(form) {

 for (var i =0; i < getIndex(); i++) {
   var quant = parseInt(form.elements[i].value);
     if (quant !=0 && quant != Number.NaN)
       cart.setSubValue("Quantity" + i, quant); 
       
     else {  //delete subvalue
       cart.setSubValue("ID" + i);
       cart.setSubValue("Desc" +i);
       cart.setSubValue("Price" +i);
       cart.setSubValue("Quantity" + i);       
       }
       
    }
      location.reload();
 }   
       
 function deleteCart() {
 
  cart.expire();
  
  location.reload();
      
  }
  
function displayCheckout() {

 var ship = 6.99;
 
 var td2 = '<td class="CartBody2">';
 var td1 = '<td class="CartBody">';
 var total = 0, grandtotal = 0;
 var subValueNames = new Array("ID", "Desc", "Price", "Quantity");
 var subValues = new Array();
 
 document.writeln('<center><table summary="Shopping Cart Data" class="Cart" cellspacing="0"');
 document.writeln('<tr>');
 
 document.writeln('<td class="CartHeading">Product Number</td>');
 document.writeln('<td class="CartHeading">Description</td>');
 document.writeln('<td class="CartHeading">Price</td>');
 document.writeln('<td class="CartHeading">Quantity</td>');
 document.writeln('<td class="CartHeading">Total</td>');
 document.writeln('</tr>');

  


 document.writeln('<tbody>');
 
 for (var i = 0; i < getIndex(); i++ ) {
   if (i%2 != 0)
     tddef = td1;
   else tddef = td2;
   
   subValues[0] = cart.getSubValue(subValueNames[0] + i);  
   subValues[1] = cart.getSubValue(subValueNames[1] + i);
   subValues[2] = cart.getSubValue(subValueNames[2] + i);
   subValues[3] = cart.getSubValue(subValueNames[3] + i);
   
   if (subValues[0] !=null) { //only printing subvalues with data  -- kinda hackish
 
   document.writeln('<tr>');
   document.writeln(tddef + subValues[0] + '</td>');
   document.writeln(tddef + subValues[1] + '</td>');
   document.writeln(tddef + '$' + subValues[2] + '</td>');
   document.writeln(tddef + subValues[3] +'</td>');
   total = parseFloat(cart.getSubValue("Quantity" + i)) * parseFloat(cart.getSubValue("Price" + i));  //reverting back to old syntax 
   document.writeln(tddef + '$' + formatFixed(total) + '</td>');
   document.writeln('<tr>');
   grandtotal += total;
   }
 
 }
 
 
 var tdcs1 = '<td class="CartBody" style="text-align: ';
 var tdcs2 ='<td class="CartBody2" style="text-align: ';
 

var i = getIndex() + 2;


  if ( i%2 !=0 ) {
   var tddefcs1 = tdcs1;
   var tddefcs2 = tdcs2;
   var tddefcs3 = tdcs1;
   }
 else {
    var tddefcs1 = tdcs2;
    var tddefcs2 = tdcs1;
    var tddefcs3 = tdcs2;
    }
 
   document.writeln('<tr>' + tddefcs1 + 'right;" colspan="4">' + 'Total</td>' + tddefcs1 + 'center;">'  + '$' + formatFixed(grandtotal) + '</td></tr>');
   document.writeln('<tr>' + tddefcs2 + 'right;" colspan="4">' + 'Shipping</td>' + tddefcs2 +'center;">' + '$' + formatFixed(ship) + '</td></tr>');
   document.writeln('<tr>' + tddefcs3 + 'right;" colspan="4">' + 'Grand Total</td>' + tddefcs3 + 'center; color: red;">' + '$' + formatFixed((grandtotal + ship)) + '</td></tr>');
	
	
  document.writeln('</tbody></table></center>');


 }

 // function to format numbers to 2 decimal places
function formatFixed(num)
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

function puthidden(form) {

form.cartcookie.value = cart.getCookieValue();

}
 
 
 
 