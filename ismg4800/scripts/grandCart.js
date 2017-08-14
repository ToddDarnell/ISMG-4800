function cookieEmpty()
//boolean; returns true if the cookie is empty
{
	return (document.cookie == "");
}

function cartEmpty()
//boolean; returns true if cart cookie not present
{
	return !itemExists("cart=");
}
	
function itemExists(item)
//boolean; returns true if the string exists in the cookie
{
	var itemIndex = document.cookie.indexOf(item);
	return (itemIndex != -1);
}

function getCartValue()
//returns value of the cart cookie
{
	var start = document.cookie.indexOf("cart=") + 5;
	var end = document.cookie.indexOf(";", start);
	if (end == -1)
		end = document.cookie.length;
	return document.cookie.substr(start, end);
}

function addToCart(itemID, itemName, qty, price)
//adds the item to the cart if the item is not already in the cart
// and loads the Shooping Cart page after the item is added
{
	var item = itemID + "|" + itemName + "|" + qty + "|" + price;

	if (cookieEmpty())
		setCart(item);
	
	else if (!itemExists("cart="))
		setCart(item);
					
	else if (itemExists(itemID))
	{
		var ans = confirm('This item is already in your cart. Do you want to view the cart contents?');
		if (!ans)
			return;
	}

	else
		appendCart(item);		
	window.location="../commerce/cart.htm";
}
//40
function setCart(value, expires)
//creates a Cart cookie with the given value and expiration
//	the expiration value is optional
{
	document.cookie = "cart=" + value + "; path=/" +
		((expires) ? "; expires=" + expires : "") +
		";";
}

function appendCart(item)
//Precondition: cart is not empty
//	appends item to the cart value
{
	setCart(getCartValue() + "|" + item);
}

function getCart()
{
	var prods = getCartValue();
	var nProd = 0;	// # of products
	var nVal = 4;	// # of values per product

	// arrays to store product data	
	idA = new Array();
	descriptA = new Array();
	qtyA = new Array();
	priceA = new Array();

	// if products have been selected
	if (!cartEmpty())
	{
		prods = prods.split("|");
		nProd = prods.length/nVal;  
   
		// write data to data arrays
		for (var i=0, j=0; j < nProd; i+=nVal, j++)
		{
			idA[j] = prods[i];
			descriptA[j] = prods[i+1];
			qtyA[j] = parseInt(prods[i+2]);
			priceA[j] = parseFloat(prods[i+3]);
		}
	}

	//After arrays complete display the cart
	writeCart(nProd, idA, descriptA, qtyA, priceA);
}

function writeCart(nProd, idA, descriptA, qtyA, priceA)
{
// Check if any products selected
	if (nProd < 1 )
		document.writeln("<h3>Your Cart is Empty</h3>");

	else
	{ // if we have products create a table for them
		var subtotal = 0.0;
		document.writeln("<table border=1>");
		document.writeln("<caption>Cart Contents</caption>");
		document.writeln("<tr>");
		document.writeln("<th>Item ID</th>");
		document.writeln("<th>Name</th>");
		document.writeln("<th>Quantity</th>");
		document.writeln("<th>Price</th>");
		document.writeln("<th>Extended Price</th></tr>");
//106    
	// loop to write each product on a row
	// each data item in a separate cell
		for ( var j=0; j < nProd;  j++)
		{
			subtotal += qtyA[j] * priceA[j];
			document.writeln("<tr><td>" + idA[j] + "</td>");
			document.writeln("<td>" + descriptA[j] + "</td>");
      
		// write quantity in textbox so it can be changed
			document.writeln("<td align='center'><input size=1 name=q" + j
				 + " value=" + qtyA[j] + ">" + "</td>");

		// format price to have 2 decimal places and add a $ sign
			document.writeln("<td>$" + formatFixed(priceA[j]) + "</td>");
			document.writeln("<td align='right'>$" + formatFixed(qtyA[j] * priceA[j])
				 + "</td></tr>");
		}

		document.writeln("<tr align='right'><td colspan='4'><strong>Subtotal:</strong></td>");
		document.writeln("<td>$" + formatFixed(subtotal) + "</td></tr>");		
		document.writeln("</table>");

// Create button to call a update cookie function
	document.write("<br><br><input type='button' value='Update Cart' ");  
	document.write("onclick='updateCart(this.form); ");
	document.write("window.location=document.URL;'>");

//Create button to empty the cart
	document.write("&nbsp &nbsp<input type='button' value='Empty Cart' ");
	document.write("onclick='deleteCart(); window.location=document.URL;'>");

//Create button to purchase items in the cart
	document.write("&nbsp &nbsp<input type='button' value='Check Out' ");
	page = String("checkout.htm");
	document.write("onclick='window.location=page'>");
	}
}

function formatFixed(num)
// function to format numbers to 2 decimal places
{
	var strNum;
//149
	if (num%1 == 0)
		strNum = num + ".00";
	else if ((num*10)%1 == 0)
		strNum = num + "0";
	else
		strNum = Math.round(num*100)/100;

	return strNum;
}

function updateCart(form)
{
// product data from old cookie
	var prods = getCartValue();
	var nVal = 4;          // # values/product
	var cookieString= "";  // Holds cookie value
	var nProd = 0;         // # products in cart

// if products have been selected
	if (!cartEmpty())
	{
		prods = prods.split("|");
		nProd = prods.length/nVal;

	// Create cookie string
		for (var i=0, j=0; j < nProd; i+=nVal, j++)
		{
		// Get quantity from textbox
			var quant = form.elements[j].value;

		// if quantity is a number > 0
			if (quant != 0 && parseInt(quant) != Number.NaN)
			{
				if (cookieString != "")
					cookieString = cookieString + "|";

				cookieString = cookieString + prods[i] +
					"|" + prods[i+1] + "|" + quant +
					"|" + prods[i+3];
			}
		}
	
		if(cookieString != "")
		// Overwrite old cookie w/ new values
		{
			setCart(cookieString);
		}
	
		else
			deleteCart(); 
	}
}
//201
function deleteCart() 
{  
   var exp = getGMT(-1);     
   setCart("", exp);
}

function getGMT(xDays)
{
   var exp = new Date();
   exp.setTime(exp.getTime() + (xDays*24*60*60*1000));
   return exp.toGMTString();
}

function checkout()

{
	var prods = getCartValue();
	var nProd = 0;	// # of products
	var nVal = 4;	// # of values per product

	// arrays to store product data	
	idA = new Array();
	descriptA = new Array();
	qtyA = new Array();
	priceA = new Array();

	// if products have been selected
	if (!cartEmpty())
	{
		prods = prods.split("|");
		nProd = prods.length/nVal;  
   
		// write data to data arrays
		for (var i=0, j=0; j < nProd; i+=nVal, j++)
		{
			idA[j] = prods[i];
			descriptA[j] = prods[i+1];
			qtyA[j] = parseInt(prods[i+2]);
			priceA[j] = parseFloat(prods[i+3]);
		}
	}
//242
	//After arrays complete display the cart
	writeInvoice(nProd, idA, descriptA, qtyA, priceA);
}

function writeInvoice(nProd, idA, descriptA, qtyA, priceA)
{
//create invoice table
	var subtotal = 0.0;
	document.writeln("<table border=1>");
	document.writeln("<caption>Invoice</caption>");
	document.writeln("<tr>");
	document.writeln("<th>Item ID</th>");
	document.writeln("<th>Name</th>");
	document.writeln("<th>Quantity</th>");
	document.writeln("<th>Price</th>");
	document.writeln("<th>Extended Price</th></tr>");
   
// loop to write each product on a row
// each data item in a separate cell
	for ( var j=0; j < nProd;  j++)
	{
		subtotal += qtyA[j] * priceA[j];
		document.writeln("<tr><td>" + idA[j] + "</td>");
		document.writeln("<td>" + descriptA[j] + "</td>");
		document.writeln("<td align='right'>" + qtyA[j] + "</td>");

	// format price to have 2 decimal places and add a $ sign
		document.writeln("<td>$" + formatFixed(priceA[j]) + "</td>");
		document.writeln("<td align='right'>$" + formatFixed(qtyA[j] * priceA[j])
			 + "</td></tr>");
	}

	document.writeln("<tr align='right'><td colspan='4'><strong>Subtotal:</strong></td>");
	document.writeln("<td>$" + formatFixed(subtotal) + "</td></tr>");
	document.writeln("<tr align='right'><td colspan='4'><strong>Shipping & Handling:</strong></td>");
	document.writeln("<td>$" + formatFixed(10) + "</td></tr>");
	document.writeln("<tr align='right'><td colspan='4'><strong>Invoice Total:</strong></td>");
	document.writeln("<td>$" + formatFixed(subtotal + 10) + "</td></tr>");
		
	document.writeln("</table>");

}

function validOrder(form)
{
//name check
	if(form.custname.value=="")
	{
		alert("Please enter your name");
		return false;
	}

//address check	
	else if(form.address1.value=="")
	{
		alert("Please enter your address");
		return false;
	}

//state check
	else if(form.state.value=="" || form.state.value.length != 2)
	{
		alert("Please enter your state abbreviation");
		return false;
	}

//zip code check
	else if(form.zip.value=="" || form.zip.value.length < 5 || form.zip.value.length > 10)
	{
		alert("Please enter a valid zip code");
		return false;
	}

//credit card number check
	else if(form.cardNum.value=="" || isNaN(parseInt(form.cardNum.value)) || 
		form.cardNum.value.length < 10)
	{
		alert("Please enter a valid credit card number");
		return false;
	}

//expiration date check
	else if(form.expires.value=="" || form.expires.value.charAt(2) != "/"
		|| form.expires.value.length != 7)
	{
		alert("Please enter a valid expiration date");
		return false;
	}

//e-mail address check
	else if(form.email.value=="" || form.email.value.indexOf("@") == -1)
	{
		alert("Please enter a valid e-mail address");
		return false;
	}

	else
	{
		window.location="thanks.htm";
		return true;
	}
}

