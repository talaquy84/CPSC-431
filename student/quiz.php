<?php
session_start();
error_reporting(1);
include("../database.php");
extract($_POST);
extract($_GET);
extract($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>CPSC 431 Exam</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="../style.css" rel="stylesheet" type="text/css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
   <style type="text/css">
      body{ font: 14px sans-serif; }
      .wrapper{ width: 350px; padding: 20px; }
   </style>
</head>

<body>
	<nav class="navtop">
			<div>
				<h1>CPSC 431 Exam</h1>
				<a href="../index.html"><i class="fas fa-sign-out-alt"></i></i></i>Log Out</a>
			</div>
	</nav>

	<div class="images">
		<div class="content home">
			<?php
			$query="select * from mst_question";

			$rs=mysqli_query($link,"select * from mst_question",$cn) or die(mysqli_error("Something wrong!!!!"));
			if(!isset($_SESSION[qn]))
			{
				$_SESSION[qn]=0;
				mysqli_query("delete from mst_useranswer where sess_id='" . session_id() ."'") or die(mysqli_error());
				$_SESSION[trueans]=0;
			}
			else
			{	
					if($submit=='Next Question' && isset($ans))
					{
							mysqli_data_seek($rs,$_SESSION[qn]);
							$row= mysqli_fetch_row($rs);	
							mysqli_query($link,"insert into mst_useranswer(sess_id, que_des, ans1,ans2,ans3,ans4,true_ans,your_ans) values ('".session_id()."','$row[1]','$row[2]','$row[3]','$row[4]', '$row[5]','$row[6]','$ans')") or die(mysqli_error());
							if($ans==$row[6])
							{
										$_SESSION[trueans]=$_SESSION[trueans]+1;
							}
							$_SESSION[qn]=$_SESSION[qn]+1;
					}
					else if($submit=='Get Result' && isset($ans))
					{
							mysqli_data_seek($rs,$_SESSION[qn]);
							$row= mysqli_fetch_row($rs);	
							mysqli_query($link,"insert into mst_useranswer(sess_id, que_des, ans1,ans2,ans3,ans4,true_ans,your_ans) values ('".session_id()."','$row[1]','$row[2]','$row[3]','$row[4]', '$row[5]','$row[6]','$ans')") or die(mysqli_error());
							if($ans==$row[6])
							{
										$_SESSION[trueans]=$_SESSION[trueans]+1;
							}
							echo "<h1 class=head1> Result</h1>";
							$_SESSION[qn]=$_SESSION[qn]+1;
							echo "<Table align=center><tr class=tot><td>Total Question: <td> $_SESSION[qn]";
							if ($_SESSION[trueans] == 0){
								echo "<tr class=tans><td>True Answer: 0<td>";
							}
							else {
								echo "<tr class=tans><td>True Answer: <td>".$_SESSION[trueans];
							}
							$w=$_SESSION[qn]-$_SESSION[trueans];
							echo "<tr class=fans><td>Wrong Answer: <td> ". $w;
							echo "</table>";
							
							unset($_SESSION[qn]);
							unset($_SESSION[trueans]);
							exit;
					}
			}
			$rs=mysqli_query($link,"select * from mst_question",$cn) or die(mysqli_error("Something wrong!!!!"));
			if($_SESSION[qn]>mysqli_num_rows($rs)-1)
			{
			unset($_SESSION[qn]);
			echo "<h1 class=head1>Some Error  Occured</h1>";
			session_destroy();
			echo "Please <a href=../index.html> Start Again</a>";

			exit;
			}
			mysqli_data_seek($rs,$_SESSION[qn]);
			echo "<br>";

			$row= mysqli_fetch_row($rs);
			echo "<form name=myfm method=post action=quiz.php>";
			echo "<table width=100%> <tr> <td width=30>&nbsp;<td> <table border=0>";
			$n=$_SESSION[qn]+1;
			echo "<tR><td><span class=style2>Question ".  $n .": $row[1]</style>";
			echo "<BR>";
			echo "<BR>";
			echo "<tr><td class=style8><input type=radio name=ans value=1>  $row[2]";
			echo "<BR>";
			echo "<BR>";
			echo "<tr><td class=style8> <input type=radio name=ans value=2>  $row[3]";
			echo "<BR>";
			echo "<BR>";
			echo "<tr><td class=style8><input type=radio name=ans value=3>  $row[4]";
			echo "<BR>";
			echo "<BR>";
			echo "<tr><td class=style8><input type=radio name=ans value=4>  $row[5]";
			echo "<BR>";
			echo "<BR>";
			if($_SESSION[qn]<mysqli_num_rows($rs)-1)
			echo "<tr><td><input type=submit name=submit value='Next Question'></form>";
			else
			echo "<tr><td><input type=submit name=submit value='Get Result'></form>";
			echo "</table></table>";
			?>

		</div>

	</div>

</body>
</html>