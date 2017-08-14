//check address data here
function checkform(form)
{
var message = "";

if (form.CName.value.length == 0){
	message = message + "Please Enter Your Name!\n";
}

if (form.Address.value.length == 0){
	message = message + "Please Enter Your Address!\n";
}

if (form.Address2.value.length == 0){
	form.Address2.value = " ";
}

if (form.City.value.length == 0){
	message = message + "Please Enter Your City!\n";
}

if (form.State.value.length == 0){
  if (form.Country.value=="US" || form.Country.value=="CA" )
	message = message + "Please Enter Your Region!\n";
  else
        form.State.value = " ";  
}

if (form.Postcode.value.length == 0){
	message = message + "Please Enter Your Postal Code!\n";
}

if (form.Country.value.length == 0){
	message = message + "Please Enter Your Country!\n";
}

if (form.Phone.value.length == 0){
        form.Phone.value = " ";  
}

if (form.Email.value.length == 0){
        form.Email.value = " ";  
}
else if (isEmail(form.Email.value)==false) {
       message = message + "Invalid email address.\n";
}

if (form.CreditCard.value.length == 0){
   form.CreditCard.value = " ";
}

if (form.CCN.value.length == 0){
   form.CCN.value = " ";
}

if (isValidCard(form.CreditCard.value, form.CCN.value)==false)
{
       message = message+ "Invalid Credit Card Information.\n";
}


if (message.length > 0){
  alert(message);
  return false;
}

return true;
}

// Check whether string s is empty.
function isEmpty(s)
{   return ((s == null) || (s.length == 0))
}

// Returns true if string s is empty or 
// whitespace characters only.
function isWhitespace (s)
{
    var whitespace = " \t\n\r";
    var i;

    // Is s empty?
    if (isEmpty(s)){return true;}

    // Search through characters one by one
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character isn't whitespace.
        var c = s.charAt(i);

        if (whitespace.indexOf(c) == -1) return false;
    }

    // All characters are whitespace.
    return true;
}


// Email address must be of form a@b.c
function isEmail (s)
{   if (isEmpty(s)){return false;}
   
    // is s whitespace?
    if (isWhitespace(s)){return false;}
    
    // there must be >= 1 character before @, so we
    // start looking at character position 1 
    // (i.e. second character)
    var i = 1;
    var sLength = s.length;

    // look for @
    while ((i < sLength) && (s.charAt(i) != "@"))
    { i++
    }

    if ((i >= sLength) || (s.charAt(i) != "@")) return false;
    else i += 2;

    // look for .
    while ((i < sLength) && (s.charAt(i) != "."))
    { i++
    }

    // there must be at least one character after the .
    if ((i >= sLength - 1) || (s.charAt(i) != ".")) return false;
    else return true;
}


function isVisa(cc)
{
  if (((cc.length == 16) || (cc.length == 13)) &&
      (cc.substring(0,1) == 4))
    return true;
  return false;
}  // END FUNCTION isVisa()

function isMasterCard(cc)
{
  firstdig = cc.substring(0,1);
  seconddig = cc.substring(1,2);
  if ((cc.length == 16) && (firstdig == 5) &&
      ((seconddig >= 1) && (seconddig <= 5)))
    return true;
  return false;

} // END FUNCTION isMasterCard()

function isAmericanExpress(cc)
{
  firstdig = cc.substring(0,1);
  seconddig = cc.substring(1,2);
  if ((cc.length == 15) && (firstdig == 3) &&
      ((seconddig == 4) || (seconddig == 7)))
    return true;
  return false;

} // END FUNCTION isAmericanExpress()

function isDiscover(cc)
{
  first4digs = cc.substring(0,4);
  if ((cc.length == 16) && (first4digs == "6011"))
    return true;
  return false;

} // END FUNCTION isDiscover()

function isPO(cc)
{
  if ((cc.length >0))
    return true;
  return false;

} // END FUNCTION isPO()

function isValidCard (cardType, cardNumber)
{

	cardType = cardType.toUpperCase();
	var doesMatch = true;

	if ((cardType == "VISA") && (!isVisa(cardNumber)))
		doesMatch = false;
	if ((cardType == "MASTERCARD") && (!isMasterCard(cardNumber)))
		doesMatch = false;
	if (( (cardType == "AMERICANEXPRESS") || (cardType == "AMEX") )
                && (!isAmericanExpress(cardNumber))) doesMatch = false;
	if ((cardType == "DISCOVER") && (!isDiscover(cardNumber)))
		doesMatch = false;
	if ((cardType == "PURCHASEORDER") && (!isPO(cardNumber)))
		doesMatch = false;
	if (cardType == "INVOICE")
		doesMatch = true;
	return doesMatch;

}  




