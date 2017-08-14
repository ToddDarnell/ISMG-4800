loaded=true;
var linkarray = [[""],
["HTML Introduction", "HTML Tags", "HTML Lists", "Linking", "Web Site Design", "Design for Medium"],
["Color", "Formatting Text", "Images", "Tables", "Table Templates", "Frames", "Design Document"],
["Cascading Style Sheets", "External Styles", "CSS Properties", "CSS Classes", "HTML Forms", "More Forms"],
["JavaScript", "Variables &amp; Operators", "JavaScript Examples", "Control Structures", "Comments &amp; Arrays", "Debuging"],
["Browser Objects", "Functions", "Functions &amp; Forms", "JavaScript Events", "Form Validation", "More Functions", "Arrays &amp; Functions"],
["JavaScript Dates", "Math &amp; String", "Cookies", "Persistent Cookies", "Cookie Paramaters", "Shopping Carts"],
["Document Object Model", "Referncing Elements", "DHTML &amp; CSS", "Dynamic Positioning", "Image Effects", "AJAX"],
["Filters &amp; Transitions", "Graphics", "Flash", "Flash Basics"],
["Server-side Code", "PHP Pages", "Built-in Variables", "PHP Functions", "PHP & Forms", "Writing to a File"],
["Strings &amp; Dates", "Autoglobals", "Cookies &amp; Sessions", "Built-in Functions", "Inclue Files", "File Processing"],
["MySQL", "Database Connections", "Database Example", "Database &amp; PHP", "Passing Parameters", "Retrieving Parameters"],
["Objects &amp; Classes", "User Authentication", "PHP Authentication", "Database Authentication", "Session Management (again)", "Session Management w/o cookies"],
["Security", "Security Technologies", "Network &amp; Resource Security", "Online Payments", "PHP &amp; Email", "Sending HTML Email"],
["Understand XML", "XML Example", "DTDs & Schemas", "XSL", "Parsing XML with PHP","XML &amp; AJAX"],
["Internet Service Providers", "Web Site Testing", "Testing Tools", "Search Engine Optimization"],
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

var v="green";
function writeHeader()
{
   var url = window.location.toString();
   var start = url.lastIndexOf("ss=");
   if(start>0)
   {
      var num = url.lastIndexOf("#");
      if(num > 0)
         v = url.substring(start+3, num);
      else 
         v = url.substring(start+3);
      document.writeln("<LINK rel='stylesheet' type='text/css' href='../styles/screen_" + v + ".css' media='screen'>"); 
   }
    else  
      document.writeln("<LINK rel='stylesheet' type='text/css' href='../styles/screen_" + v + ".css' media='screen'>"); 

    var hd = "";
        hd = '<div id=header><h5 align=right>'+course+ ' Lecture '+unit+'</h5>';
        hd += '<hr>';
        if(linktxt.length>1)
        {
          hd += "<h1>This Week's Agenda</h1><ul>";
          for(var i = 0; i < linktxt.length; i++)
             hd += "<li>" + linktxt[i] + "</li>";
          hd += "</ul></div><div id=sec1>";
        }
    document.writeln(hd);
}

//***********************************************************
function writeFooter(x)
{
       if(x == linktxt.length-1) document.writeln("</div><div id='footer'" + ftext + "</div>");
       else document.writeln("</div><div id='sec"+(x+2)+"'>")
}