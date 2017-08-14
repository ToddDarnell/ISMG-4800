loaded=true;
var linkarray = [[""],
["HTML Introduction", "HTML Tags", "HTML Lists", "Linking", "Web Site Design", "Design for Medium"],
["Color", "Formatting Text", "Images", "Tables", "Table Templates", "Frames", "Design Document"],
["Cascading Style Sheets", "External Styles", "CSS Properties", "CSS Classes", "HTML Forms", "More Forms"],
["JavaScript", "Variables &amp; Operators", "JavaScript Examples", "Control Structures", "Comments &amp; Arrays", "Debuging"],
["Browser Objects", "Functions", "Functions &amp; Forms", "JavaScript Events", "Form Validation", "More Functions", "Arrays &amp; Functions"],
["JavaScript Dates", "Math &amp; String", "Cookies", "Persistent Cookies", "Cookie Paramaters", "Shopping Carts"],
["Document Object Model", "Referncing Elements", "DHTML &amp; CSS", "Dynamic Positioning", "Image Effects", "Filters &amp; Transitions"],
["Graphics", "Flash", "Flash Basics"],
["Server-side Code", "Java Server Pages", "JSP &amp; JDeveloper", "JSP &amp; Forms", "Other Files", "Writing to File"],
["Page Directives", "Scripting Elements", "JSP Objects", "Include files", "Web Applications", "Cookies", "Sessions"],
["JDBC", "JDBC Connections", "JDBC Example", "JDBC &amp; JSP", "Passing Parameters", "Retrieving Parameters"],
["JSP &amp; JBoss", "JBoss Database", "JavaBeans", "JSP &amp; JavaBeans", "Servlets", "Servlets vs. JSP"],
["Publishing &amp Marketing", "ISP", "Search Engines","Testing", "Usability Testing", "Testing Tools"],
["XML", "Example", "DTD", "XSL", "XSL Example", "NameSpaces],
["Web Services", "Soap, WSDL and UDDI", "Web Services in Java", "Web Services Example", "Web Services Demo"],
["Review"],
["Review"]
];

var unit=5;
unit = getUnit();
if (unit < linkarray.length && unit > 0)
    linktxt = linkarray[unit];

if(ftext==null)   var ftext   = "<i class=footer>Updated March 2004<br>by Dawn Gregg</i>";
if(linktxt==null) var linktxt = [""];
if(course==null)  var course  = "ISMG 4800";

 
//***********************************************************
function getUnit()
{
  var url = window.location.toString();
  var u = 0;
  if(url.indexOf("notes")>0)
  {
    var start = url.lastIndexOf("notes")+ 5;
    var end  = url.indexOf(".html", start);
    if(start>0)
    {
      if(end > 0)
        u = url.substring(start, end) // Get rid of 'param='
      else
        u = url.substring(start);
    }
    if(u.length > 2) u = 1;
  }
  return u;
}

function writeHeader()
{
    var hd = "";
        hd = '<h5 align=right>'+course+ ' Lecture '+unit+'</h5>';
        hd += '<hr>';
        if(linktxt.length>1)
        {
          hd += "<h1>This Week's Agenda</h1><ul>";
          for(var i = 0; i < linktxt.length; i++)
             hd += "<li>" + linktxt[i] + "</li>";
          hd += "</ul><hr>";
        }
    document.writeln(hd);
}

//***********************************************************
function writeFooter(x)
{
       if(x == linktxt.length-1) document.writeln(ftext);
}