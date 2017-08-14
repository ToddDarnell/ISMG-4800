    //***********************************************************
    var NS4DOM = document.layers ?true : false;
    var IEDOM  = document.all    ?true : false;
    var W3CDOM = ((document.getElementById)&&(!IEDOM))?true:false;
       
   function getObject(id)
   {  var obj;
      if(NS4DOM)      obj = eval("document." + id);
      else if(IEDOM)  obj = eval(id);
      else if(W3CDOM) obj = document.getElementById(id);
      return obj;
   }
       
   function placeIt(id, x, y)
   {
      var object=getObject(id);
      if(NS4DOM) object.moveTo(x,y);
      else if(IEDOM || W3CDOM)
      {  object.style.left=x;
         object.style.top=y;
      }
   }
    
   function shiftIt(id, dx, dy)
   {
      var object=getObject(id);
      if(NS4DOM)   object.moveBy(dx,dy);
      else if(IEDOM)
      {  
         object.style.left =object.style.pixelLeft+dx;
         object.style.top  =object.style.pixelTop+dy;
      }
      else if(W3CDOM)
      {  object.style.left=parseInt(object.style.left)+dx;
         object.style.top=parseInt(object.style.top)+dy;
      }
   }
    
   function xCoord(id)
   {
      var object=getObject(id);
      if(NS4DOM)     xc=object.left;
      else if(IEDOM) xc=object.style.pixelLeft;
      else if(W3CDOM)xc= parseInt(object.style.left);
      return xc;
   }
   
   function yCoord(id)
   {
      var object=getObject(id);
      if(NS4DOM)     yc=object.top;
      else if(IEDOM) yc=object.style.pixelTop;
      else if(W3CDOM)yc= parseInt(object.style.top);
      return yc;
   }
   
   function hideIt(id)
   {
      var object=getObject(id);
      if(NS4DOM) object.visibility="hide";
      else if(IEDOM || W3CDOM) object.style.visibility = "hidden";
   }
   
   function showIt(id)
   {
      var object=getObject(id);
      if(NS4DOM) object.visibility="show";
      else if(IEDOM || W3CDOM) object.style.visibility = "visible";
   }