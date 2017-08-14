
if (document.images)
{
  homeon= new Image(100,32); 
  homeon.src="images/homeR.gif";
  feedbackon= new Image(100,32);
  feedbackon.src="images/feedbackR.gif";
  carton= new Image(100,32);
  carton.src="images/cartR.gif";
  goon= new Image(12,12);
  goon.src="images/ball_green.gif";

  homeoff= new Image(100,32);
  homeoff.src="images/home.gif";
  feedbackoff= new Image(100,32);
  feedbackoff.src="images/feedback.gif";
  cartoff= new Image(100,32);
  cartoff.src="images/cart.gif";
  gooff= new Image(12,12);
  gooff.src="images/ball_red.gif";
}

function swap(imgName, onoff)
{
  if (document.images)
  { 
    imgx=eval(imgName + onoff + ".src");
    document[imgName].src= imgx;
  }
}
