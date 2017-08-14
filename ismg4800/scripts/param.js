function getParameter(pname)
{
   var input = '', output = '';

   if (location.search.length > 0)
   {
       input = location.search.substring(1);
   }


   while (input.length > 0) 
   {
       variableName = input.substring(0,input.indexOf('='));
       if(variableName == pname)
       {
         variableValue = input.substring(input.indexOf('=')+1);
         if (variableValue.indexOf('&')>0)
            variableValue = input.substring(input.indexOf('=')+1,input.indexOf('&'));
         return variableValue;
       }

       if (input.indexOf('&')>0)
           input = input.substring(input.indexOf('&')+1);
   }
   return "false";
}

function getDelim()
{
   return "&";
}

function getStart()
{
   return "?";
}
