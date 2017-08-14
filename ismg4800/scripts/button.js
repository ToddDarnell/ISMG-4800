  image1 = new Image();                 // Creating the image
  image1.src = "../images/home.gif";    // & loading the files
  image1on = new Image();               // preloads the images
  image1on.src = "../images/homeR.gif"; // reducing delays

  image2 = new Image();     
  image2.src = "../images/products.gif"; 
  image2on = new Image();   
  image2on.src = "../images/productsR.gif"; 

  image3 = new Image();     
  image3.src = "../images/cart.gif"; 
  image3on = new Image();   
  image3on.src = "../images/cartR.gif"; 

  image4 = new Image();   
  image4.src = "../images/feedback.gif";
  image4on = new Image();
  image4on.src = "../images/feedbackR.gif";

  function on(name) {    //replace original image
     document[name].src = eval(name + "on.src");
  }
  function off(name) {   //restore original image
     document[name].src = eval(name + ".src");
  }
