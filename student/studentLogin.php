<?php
require_once("../database.php");
session_start();

// Defin variables and initalize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
	
	// Check if username is empty
   if(empty($_POST["username"])){
      $username_err = "Please enter username";
   } else {
      $username = $_POST["username"];
   }

   // Check if password is empty
   if(empty($_POST["password"])){
      $password_err= "Please enter password";
   } else {
      $password = $_POST["password"];
   }
   // Validate credentials
   if(empty($username_err) && empty($password_err)){
      // Prepare a select statement
      $sql = "SELECT id, username, password FROM student WHERE username = ?";
      
      if ($stmt = mysqli_prepare($link, $sql)){
         // bind variables to the prepared statement as parameters
         mysqli_stmt_bind_param($stmt, "s", $param_username);
         // set parameters
         $param_username = $username;
         // Attempt to execute the prepared statment
         if(mysqli_stmt_execute($stmt)){
            // store result
            mysqli_stmt_store_result($stmt);
            // Check if username exists, if yes then verify password
            if(mysqli_stmt_num_rows($stmt) == 1){
               // // /Bind result variables
				mysqli_stmt_bind_result($stmt, $id, $username, $tablepassword);
				if(mysqli_stmt_fetch($stmt)){
					echo $tablepassword;
					echo $password;
					if($password == $tablepassword){
						 //Password is correct, start new session
						 session_start();
						 // Store data in session variables
						 $_SESSION["loggedin"] = true;
						 $_SESSION["id"] = $id;
						 $_SESSION["username"] = $username;
						 // Redirect user to main page
						 header("Location: quiz.php");
                  } else {
					  // Display an error message if password is not correct
                     $password_err = "The password you entered was not valid.";
                  }
				}
            } else {
				// Display an error message if username doesn't exist
               $username_err = "No account found with that username.";
            }
         } else {
            echo "Something went wrong. Please try again later!";
         }
         // Close statment
         mysqli_stmt_close($stmt);
      }
   }
   // Close connection
   mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Student Login</title>
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
            <h1>Student Login</h1>
        </div>
   </nav>

   <div id="topfooter">
        <div class="containter">
            <div class="row">

      <div class="col-lg-2 text-center">
               <div class="wrapper">
                     <p>Please fill in your username and password.</p>
                  <form style="text-align: center; display: inline-block;"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                           <label> Username </label>
                           <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                           <span class="help-block"><?php echo $username_err; ?></span>
               </div>

                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                           <label> Password </label>
                           <input type="password" name="password" class="form-control">
                           <span class="help-block"><?php echo $password_err; ?></span>
                        </div>

                        <div class="form-group">
                           <input type="submit" class="btn btn-primary" value="Login">
                        </div>  

                        <p>Don't have an account <a href="studentSignUp.php">Sign up now</a>.</p>
                        <p><a href="../index.html">Return to portal</a></p>
                     </form>
               </div>

      </div>

                </div>
            </div> <!--row-->
        </div><!--container-->
    </div><!--topfooter-->

</body>
</html>
