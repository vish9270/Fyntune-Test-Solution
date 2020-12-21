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
.registerbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
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

        // case 3:
        //         echo '<div class="alert alert-danger alert-dismissable">
        //             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        //              Please upload the Students Photo As well.
        //         </div>';
        // break;

        // case 4:
        //         echo '<div class="alert alert-danger alert-dismissable">
        //             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        //             The Image You have Uploaded is Already Exist
        //         </div>';
        // break;

        // case 5:
        //         echo '<div class="alert alert-danger alert-dismissable">
        //             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        //             Sorry Your Uploaded Image Size is Too Large. Please Upload the image below 400 kb.
        //         </div>';
        // break;

        // case 6:
        //         echo '<div class="alert alert-danger alert-dismissable">
        //             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        //             Sorry, only JPG, JPEG, PNG & files are allowed.
        //         </div>';
        // break;
            default:
                echo '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Sorry There was an error Creating your account.
                </div>';
                break;
        }
        }
        ?>


<form action="create_guest.php" method="post" name="create-guest-form">
  <div class="container col col-md-10">
    <h1>Register for the test</h1>
    <p>Please fill this form to create an account.</p>
    <hr>

    <label for="name"><b>Name</b></label>
    <input type="text" placeholder="Enter name" name="g_name" id="name" required>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="g_email" id="email" required>

    <hr>
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

    <button type="submit" class="registerbtn" name="registerbtn">Register</button>
  </div>
</form>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
</body>
</html>
