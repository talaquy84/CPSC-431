<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <meta charset="utf-8">
      <title>CPSC 431 Exam</title>
      <link href="style.css" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
      <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Admin | Portal </title>

      <link href="../style.css" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
      <link  rel="stylesheet" href="../css/bootstrap.min.css"/>
      <link  rel="stylesheet" href="../css/bootstrap-theme.min.css"/>    
      <link rel="stylesheet" href="../css/main.css">
      <link  rel="stylesheet" href="../css/font.css">
      <script src="js/jquery.js" type="text/javascript"></script>
      <script src="js/bootstrap.min.js"  type="text/javascript"></script>
      <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>


      <nav class="navtop">
        <div>
            <h1>Admin Portal</h1>

            <a href="../index.html"><i class="fas fa-sign-out-alt"></i></i></i>Log Out</a>

        </div>
        
      </nav>


    <body>
<?php
session_start();
require("../database.php");
// include("header.php");
error_reporting(1);
?>
<link href="../quiz.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../css/bootstrap.min.css"/>




<?php
extract($_POST);

// echo "<BR>";

echo "<h2 class='text-center bg-primary'>Add Question:</h2>";

extract($_POST);
if (isset($_POST['submit'])){
	mysqli_query($link,"insert into mst_question(que_desc,ans1,ans2,ans3,ans4,true_ans) values ('$addque','$ans1','$ans2','$ans3','$ans4','$anstrue')",$cn) or die(mysqli_error('Cannot add question'));
	echo "<p align=center>Question Added Successfully.</p>";
	unset($_POST);
}
// }
?>



<SCRIPT LANGUAGE="JavaScript">
function check() {
mt=document.form1.addque.value;
if (mt.length<1) {
alert("Please Enter Question");
document.form1.addque.focus();
return false;
}
a1=document.form1.ans1.value;
if(a1.length<1) {
alert("Please Enter Answer1");
document.form1.ans1.focus();
return false;
}
a2=document.form1.ans2.value;
if(a1.length<1) {
alert("Please Enter Answer2");
document.form1.ans2.focus();
return false;
}
a3=document.form1.ans3.value;
if(a3.length<1) {
alert("Please Enter Answer3");
document.form1.ans3.focus();
return false;
}
a4=document.form1.ans4.value;
if(a4.length<1) {
alert("Please Enter Answer4");
document.form1.ans4.focus();
return false;
}
at=document.form1.anstrue.value;
if(at.length<1) {
alert("Please Enter True Answer");
document.form1.anstrue.focus();
return false;
}
if ( at < 1 || at > 4){
	alert("Please enter true answer in range 1-4");
	document.form1.anstrue.focus();
return false;
}
if(!/^[0-9]+$/.test(at)){
	alert("Please enter true answer in range 1-4");
	document.form1.anstrue.focus();
	return false;
}
return true;
}
</script>

<div style="margin:auto;width:90%;height:500px;box-shadow:2px 1px 2px 2px #CCCCCC;text-align:left">
<form name="form1" method="post" onSubmit="return check();">
  <table class="table table-striped">
    
<!--  <tr>
      <td width="24%" height="32"><div align="left"><strong>Select Test Name </strong></div></td>
      <td width="1%" height="5">  
      <td width="75%" height="32"><select class="form-control" name="testid" id="testid">
// <?php
// $rs=mysqli_query($link,"Select * from mst_test order by test_name",$cn);
	  // while($row=mysqli_fetch_array($rs))
// {
// if($row[0]==$testid)
// {
// echo "<option value='$row[0]' selected>$row[2]</option>";
// }
// else
// {
// echo "<option value='$row[0]'>$row[2]</option>";
// }
// }
// ?>
      </select>
        
    <tr> -->



        <td height="26"><div align="left"><strong> Enter Question: </strong></div></td>
        <td>&nbsp;</td>
	    <td><textarea class="form-control" name="addque" cols="60" rows="2" id="addque"></textarea></td>
    </tr>
    <tr>
      <td height="26"><div align="left"><strong>Enter Answer 1: </strong></div></td>
      <td>&nbsp;</td>
      <td><input class="form-control" name="ans1" type="text" id="ans1" size="85" maxlength="85"></td>
    </tr>
    <tr>
      <td height="26"><strong>Enter Answer 2: </strong></td>
      <td>&nbsp;</td>
      <td><input class="form-control" name="ans2" type="text" id="ans2" size="85" maxlength="85"></td>
    </tr>
    <tr>
      <td height="26"><strong>Enter Answer 3: </strong></td>
      <td>&nbsp;</td>
      <td><input class="form-control" name="ans3" type="text" id="ans3" size="85" maxlength="85"></td>
    </tr>
    <tr>
      <td height="26"><strong>Enter Answer 4:</strong></td>
      <td>&nbsp;</td>
      <td><input class="form-control" name="ans4" type="text" id="ans4" size="85" maxlength="85"></td>
    </tr>
    <tr>
      <td height="26"><strong>Enter Correct Answer (1-4): </strong></td>
      <td>&nbsp;</td>
      <td><input class="form-control" name="anstrue" type="text" id="anstrue" size="50" maxlength="50"></td>
    </tr>
    <tr>
      <td height="26"></td>
      <td>&nbsp;</td>
      <td><input class="btn btn-primary" type="submit" name="submit" value="Add" ></td>
    </tr>
  </table>
</form>
<p>&nbsp; </p>
</div>





  
</body>


</html>