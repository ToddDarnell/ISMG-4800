var http_request = false;

function loadPage(url, fcn) {
        http_request = false;
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
    
function  updateLayer()
{			
    if (http_request.readyState == 4 && http_request.status == 200)
    {
		var object= document.getElementById('contentLYR');
		object.innerHTML = http_request.responseText;
	}
	else if(!http_request)
	{
  	    var object= document.getElementById('headerLYR');
		object.innerHTML = "<H2><SPAN>" + headerArray[c1] + "</SPAN></H2>";
    }
}

var c1 = 0;
var c2 = -1;

headerArray = new Array();
headerArray[0] = "";
headerArray[1] = "Step 1: Make an HTTP Request";
headerArray[2] = "Step 2: Handle the Server Response";			
headerArray[3] = "Step 3: A Simple Example";			
pageArray = new Array();
pageArray[0] = new Array();
pageArray[1] = new Array();
pageArray[2] = new Array();
pageArray[3] = new Array();
pageArray[0][0] = "content/step0_0.html";
pageArray[1][0] = "content/step1_0.html";		
pageArray[1][1] = "content/step1_1.html";		
pageArray[1][2] = "content/step1_2.html";		
pageArray[1][3] = "content/step1_3.html";		
pageArray[2][0] = "content/step2_0.html";			
pageArray[2][1] = "content/step2_1.html";		
pageArray[3][0] = "content/step3_0.html";			
pageArray[3][1] = "content/step3_1.html";			
pageArray[3][2] = "content/step3_2.html";			

function nextPage() {
   if(c2 < pageArray[c1].length-1) c2++;
   else if(c1 < headerArray.length-1) 
   { c1++; c2=0; }
   else
     return;
   incrementPage();
}

function previousPage() {
   if(c2 > 0) c2--;
   else if(c1 > 0) 
   { c1--; c2=pageArray[c1].length-1; }
   else
     return;
   incrementPage();
}

function incrementPage() {
   http_request = false;
   if(c1==0 && c2==0) hideIt("reverseLYR");
   else showIt("reverseLYR");
   
   if(c1==pageArray.length-1 && c2==pageArray[c1].length-1) hideIt("forwardLYR");
   else showIt("forwardLYR");
   
   updateLayer(headerArray[c1]);
   loadPage(pageArray[c1][c2], updateLayer);
}

function hideIt(id) {
      var object= document.getElementById(id);
      object.style.visibility = "hidden";
}
   
function showIt(id) {
      var object=document.getElementById(id);
      object.style.visibility = "visible";
}

function loadAll() {
   if(c2 < pageArray[c1].length-1) c2++;
   else if(c1 < pageArray.length-1) 
   { c1++; c2=0; }

   http_request = false;
   if(c1 > 0 && c2==0) { appendLayer(headerArray[c1]);}
   loadPage(pageArray[c1][c2], appendLayer);
   if(c2 < pageArray[c1].length-1 || c1 < pageArray.length-1)
   { Timer= setTimeout("loadAll()",1000);     }
}

function  appendLayer()
{   
    if (http_request.readyState == 4 && http_request.status == 200)
    {
		var object= document.getElementById('contentLYR2');
		object.innerHTML = object.innerHTML + http_request.responseText;
    }
    else if(!http_request)
    {
  	    var object= document.getElementById('contentLYR2');
	    object.innerHTML = object.innerHTML + "<hr><H2><SPAN>" + headerArray[c1] + "</SPAN></H2>";
    }
}