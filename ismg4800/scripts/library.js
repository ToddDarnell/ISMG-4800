loaded = true;
var sm = 1, sd = 23, sy = 2002;
var numday = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31,
              31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
if (sy%4 && !sy%100)
     numday[1] = 29;   

if ((sy+1)%4 && !sy%100)
     numday[13] = 29;   

var skip = [8, 9, 0];

function hello() 
{
   alert('Hello World');
}


function setOutline(week)
{
   var cm = sm, cd = sd, cy = sy;
   for(var i=1; i < week; i++) 
   {
       cd += 7;
       if(cd > numday[cm-1])
       {
          cd = cd - numday[cm-1];
          cm++;
       } 
   }
    
   var newdate = cm + "/" + cd;
   return (newdate);
}

function term()
{
   var ct;
   if(sm <= 3) 
      ct = "Spring";
   else if(sm <= 7) 
      ct = "Summer";
   else if(sm <= 9)
      ct = "Fall"; 
   else
      ct = "Winter";
   return ct;
}  

function year()
{ 
  return sy;
}   

function course()
{ 
  return "ISMG 6240 - Interactive Multimedia Development";
}
 
var MIN=1;
var nextNum=MIN+1, prevNum=MIN;

function initMenu(newMin)
{   nextNum = newMin+1;
    prevNum= nweMin;
}


function next(file, MAX)
{
   if(nextNum <= MAX)
   {
       prevNum++;
       var nextText;
       nextText = file + "#" + nextNum++ ;
       //parent.main.location = nextText;
   }
   return nextText;
}   

function prev(file)
{
   if(prevNum > MIN)
   {
      nextNum--;
      var prevtText;
      prevText = file + "#" + --prevNum ;
      //parent.main.location = prevText;
   }
   return prevText;
}  

function week(numclass)
{ 
   var today = new Date();
   var totalDays = 0;
                    
   totalDays = today.getDate() - sd + 3;

   if(today.getYear() > sy)
        sm1 = sm+12;
   else
        sm1 = sm;

   for(var i=sm1-1; i < today.getMonth(); i++)
      totalDays += numday[i];                  
               
   var wk = 1 ;
   var wkx = 1;
   while (totalDays > wk*7 && wk <= numclass)
   {   wk++;
       if(wk != skip[0] && wk != skip[1] && wk != skip[2])
         wkx++;
   }
          
   return wkx;        
}

function current(lecture, numclass)
{ 
       
   var nfile = "notes/notes" + week(numclass) + lecture +".html";
   
   return nfile;        
}
