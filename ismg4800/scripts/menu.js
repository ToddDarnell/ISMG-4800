var menuwidth=150;
var rightboundary=menuwidth*.9;
var leftboundary=-1.1*menuwidth
var themenu;
var menuname;
var pullit, drawit;

// set the menu allows you to work with multiple menu names
function setthemenu(id) 
{ menuname=id;
  return getObject(id);
}

// begin to pull menu out by calling drawengine every 10ms
function pull(id){
  // if "pulling out" a new menu immediately hide old one
  //if(menuname != id) placeIt(leftboundary, yCoord(id)) ;
  
  if(id != null) setthemenu(id);
  
  if (window.drawit)
    clearInterval(drawit)
  
  pullit=setInterval("pullengine('" + id + "')",10)
}

// begin to draw menu back by calling drawengine every 1ms
function draw(id){
  if(id != null) setthemenu(id);
  
  clearInterval(pullit)
  
  drawit=setInterval("drawengine('" + id + "')",1)
}

// pull menu out 5 pixels at a time
function pullengine(id){
  if (xCoord(id)<rightboundary)
    shiftIt(menuname,5,0);
}

// draw menu back 5 pixels at a time
function drawengine(id){
  if (xCoord(id)>leftboundary)
    shiftIt(menuname,-5,0);
}
