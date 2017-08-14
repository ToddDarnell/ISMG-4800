<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1252">
<TITLE>Feedback</TITLE>
<SCRIPT> LANGUAGE="JavaScript">   
<!--   
function valid(form)  
{
    if (form.name.value == "" || form.email.value == "" || 
        form.comments.value == "" || form.email.value.indexOf("@")<1)
    {  
       alert("You must complete the form!"); 
       return false;
    }
    return true;     
} // -->   
</SCRIPT>  
<link rel="stylesheet" type="text/css" href="od.css">
</HEAD>
<BODY>
<?php require("includes/header.inc"); ?>
<?php require("includes/lmenu.inc"); ?>
Please send us your comments</span>
</H2>
<form method="GET" action="feedback2.php " onsubmit="return valid(this);">
<table border=0>
 <tr><td>Name <td><input type="text" size="35" name="name"></tr>
 <tr><td>Email <td><input type="text" size="35" name="email"></tr>
</table>
<p>Comments:<br>
<textarea name=comments rows=4 cols=40></textarea>
</p>
<input type=submit>
</form>
<?php require("includes/rmenu.inc"); ?>
<?php require("includes/footer.inc"); ?>