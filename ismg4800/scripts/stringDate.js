   loaded = true;
   function stringDate()
   {
      var t = new Date();
      var mon, day=t.getDate(), yr=t.getFullYear();
      switch(t.getMonth())
      {
         case 0:  mon = "January";   break; 
         case 1:  mon = "February";  break; 
         case 2:  mon = "March";     break; 
         case 3:  mon = "April";     break; 
         case 4:  mon = "May";       break; 
         case 5:  mon = "June";      break; 
         case 6:  mon = "July";      break; 
         case 7:  mon = "August";    break; 
         case 8:  mon = "September"; break; 
         case 9:  mon = "October";   break; 
         case 10: mon = "November";  break; 
         case 11: mon = "December";
      }
      var textDate = mon + " " + day + ", " + yr;
      return "" + textDate + "";
   }