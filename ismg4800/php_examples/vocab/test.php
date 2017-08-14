<?php
 require ('db.inc');
 $choices = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "BB", "CC", "DD", "EE", "FF", "GG", "HH", "II", "JJ", "KK", "LL", "MM", "NN", "OO", "PP", "QQ", "RR", "SS", "TT", "UU", "VV", "WW", "XX", "YY", "ZZ");

 if(isset($_GET['list']))
 {   
   // Make database connection
   $lists  = $_GET['list'];
   $number = $_GET['number'];

   $list = explode( ",", $lists);

   $qry = "Select * from Words Where ";
   $ii = 0;
   foreach( $list as $id)
   { if ($ii > 0) $qry = $qry . " or ";
     $qry = $qry . " ListID = $id ";   
     $ii++;
   }
   $qry = $qry . " ;";

   $rs = mysql_query( $qry ) or die ('Unable to execute query.');    
   $page=0;
?>

<?php 
  $counter = 0; 
   
  while($row = mysql_fetch_array($rs)){
    $word[$counter] = $row["Word"];
    $def[$counter] =  $row["Definition"];
    $counter++;
  }
  $numbers = range(0, $counter-1);
  shuffle($numbers);
  
  $nums = array_chunk($numbers,$number,false);
  session_register("nums", "word", "def", "lists", "atatime");  
  $_SESSION["nums"] = $nums;
  $_SESSION["word"] = $word;
  $_SESSION["def"] = $def;
  $_SESSION["lists"] = $lists;
  $_SESSION["atatime"] = $number;
} // end if isset2
else
{
  $nums = $_SESSION["nums"];
  $word = $_SESSION["word"];
  $def = $_SESSION["def"];
  $page  = $_GET['page'];
  $lists = $_SESSION["lists"];

} // end else

if($page < count($nums))
{
  $number = count($nums[$page]);
  for($jj=0; $jj<$number; $jj++)
    $nnums[$jj] = $nums[$page][$jj];
  shuffle($nnums);

  $list = "";
  for($i=0; $i<$number; $i++)
    $list = $list . "<option value='" . $nnums[$i] . "'>$choices[$i]</option>\n";
?>
<HTML><HEAD>
<link rel=stylesheet href="styles/screen_check.css">
<TITLE>Lists: <?php echo $lists ?></TITLE>
</HEAD>
<BODY>
<div>
<H2 align=center><span>Studying Lists: <?php echo $lists ?></span></H2>
<FORM NAME=frmTest value="" >
<H4 ALIGN=CENTER>Quiz</H4> 
<TABLE WIDTH="80%" BORDER=0 CELLSPACING=2 CELLPADDING=2 ALIGN=CENTER>
  <TR>
    <TH>Choice</TH>
    <TH>Word</TH>
    <TH colspan=2>&nbsp;</TH>
    <TH>Definition</TH>
  </TR>
<?php
  for($i=0; $i<$number; $i++)
  {  
?>
 <TR>
   <TD><select onchange="update(this.form, this);" name='<?php echo $nums[$page][$i] ."'>\n$list" ?></select></TD>
   <TD><?php echo $word[$nums[$page][$i]]; ?></TD>
   <TD><input type=checkbox name="<?php echo $choices[$i]; ?>"></TD>
   <TD><?php echo $choices[$i]; ?></TD>
   <TD><?php echo $def[$nnums[$i]]; ?></TD></TR>
<?php   
 
  } ?>
</TABLE></P><P align=center>

<INPUT TYPE=button VALUE="Chect Test" NAME="CHK" onclick="return check(this.form);">
</P>
</FORM>
</div>
<script>
var choices = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "BB", "CC", "DD", "EE", "FF", "GG", "HH", "II", "JJ", "KK", "LL", "MM", "NN", "OO", "PP", "QQ", "RR", "SS", "TT", "UU", "VV", "WW", "XX", "YY", "ZZ"];
function update(form, sel)
{
   var index = sel.selectedIndex;
   var cbox = eval("form." + choices[index]);
   cbox.checked=true;
}

function check(form)
{
   var j   = <?php echo $page; ?>;
   var num   = <?php echo $number; ?>;
   var missed = 0;
   for (var i=0; i < form.elements.length; i++)
   {
      if(!isNaN(form.elements[i].name))
      {
        var correct = form.elements[i].name;
        var answer = form.elements[i].options[form.elements[i].selectedIndex].value;
        if (correct != answer) missed++;
      }
   }
   
   if(missed > 0) {
      for (var i=0; i < num; i++)
      {
           var cbox = eval("form." + choices[i]);
           cbox.checked=false;
      }   
      alert("You missed " + missed + "\nPlease try again");
      return false;
    }
    else
    {
      alert("Congratulations you got them all right!\nYou are ready for the next test!");
      window.location.href = 'test.php?page=' + (page+1);
      return true;
    }  
}

</script>

</script>
</BODY>
</HTML>
<?php } 
 else { 
  if(!isset($_SESSION["atatime"]))
    $_SESSION["atatime"]= 4;
?>
<HTML><HEAD>
<link rel=stylesheet href="styles/screen_check.css">
<TITLE>Lists: <?php echo $lists ?></TITLE>
</HEAD>
<BODY>
<div>
<H2 align=center><span>Studying Lists: <?php echo $lists ?></span></H2>
<H3 align=center>Congratulations you have completed studying the words <?php echo $_SESSION["atatime"]; ?> at a time</H3>
<center><table border=0 width=30%><tr><td>
<br>
<center><img src="congrats.gif"></center>
<br>
</td></tr></table></center>
<p align=center><a href=index.php>Click here to start again with more at a time</a></p>
</BODY>
</HTML>
<?php 
  // free up session resources
  session_unregister("nums");
  session_unregister("word");
  session_unregister("def");
  session_unregister("lists");
  session_unregister("atatime");
} ?>