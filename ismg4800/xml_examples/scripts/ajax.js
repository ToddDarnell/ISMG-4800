var http_request = false;
var fram = "content";

function loadPage(url, fr) {
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
        
        http_request.onreadystatechange = updateLayer;
        http_request.open('GET', url, true);
        http_request.send(null);

}
    
function  updateLayer()
{			
    if (http_request.readyState == 4 && http_request.status == 200)
    {
		var object= document.getElementById(fram);
		object.innerHTML = http_request.responseText;
    }
}