<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["adminloggedin"]) && $_SESSION["adminloggedin"] === true){
    header("location: home.php");
    exit;
}

// Include config file
require_once "admin_connection.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){

        // Prepare a select statement
        $sql = "SELECT uid,username, password FROM user WHERE username = ?";
        
        if($stmt = mysqli_prepare($tcon, $sql)){
           // print_r('HI');
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){

                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $uid, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if($password==$hashed_password){
                            // Password is correct, so start a new session
                            //session_start();
                            
                            // Store data in session variables
                            $_SESSION["adminloggedin"] = true;
                            $_SESSION["uid"] = $uid;
                            $_SESSION["username"] = $username;                            
                            

                            // Redirect user to welcome page
                            header("location: home.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
                echo 'sdg';
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($tcon);
}
?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: #fff;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.loginbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}
.help-block{
  color: red;
  margin: 0;
  padding: 0;
}

.loginbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">

</head>
<body>

<?php 
      if(isset($_GET['id'])){
      $id=$_GET['id'];
      switch ($id) {
          case 1:
              echo '<div class="alert alert-success alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  Information Submitted Successfully..!! 
              </div>';
      break;

            case 2:
              echo '<div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                You have already given the test. Please change your mail id to create another account.
              </div>';
      break;

      case 3:
        echo '<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         You have been logged out sucesfully.
        </div>';
break;

          default:
              echo '<div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  Sorry There was an error Creating your account.
              </div>';
        break;
      }
    }
  ?>

<form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="login-form">
  <div class="container col col-md-6">
    <h1>Login here</h1>
     <p>Login here using your admin credentials.</p>
      <hr>
      <div class="form-group">
          <label class="sr-only" for="form-username">Username</label>
          <input type="text" name="username" placeholder="Username..." class="form-username form-control"  id="enroll" value="<?php echo $username; ?>" style="margin-bottom: 2px;">
          <span class="help-block"><?php echo $username_err; ?></span>
      </div>
    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
        <label class="sr-only" for="form-password">Password</label>
        <input type="password" name="password" placeholder="Password..." class="form-password form-control" id="password" style="margin-bottom: 2px;">
          <span class="help-block" ><?php echo $password_err; ?></span>
    </div>
    <hr>
    <p>By login in you agree to our <a href="#">Terms & Privacy</a>.</p>

    <button type="submit" class="loginbtn" name="loginbtn">Login</button>
  </div>
</form>





<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<script type="text/javascript">
function checkmobile()
{
	var inputtxt=document.getElementById('mobileno');
  var mobile = /^\d{10}$/;
  var mobilemessage = document.getElementById('confirmmobileMessage');
	var goodColor = "#66cc66";
  var badColor = "#ff6666";
  
  if(inputtxt.value.match(mobile))
  {
	  inputtxt.style.backgroundColor = goodColor;
    message.style.color = goodColor;
 }
  else
  {
	   inputtxt.style.backgroundColor = badColor;
     message.style.color = badColor;
  }
}
</script>

</body>
</html>
