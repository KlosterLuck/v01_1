<?php
session_start();

if(isset($_SESSION['usr_id'])) {
    header("Location: index.php");
}

include_once 'inc/db.php';

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    //$role = mysqli_real_escape_string($con, $_POST['role']);
    $role = implode(',', $_POST['role']);
    
    //name can contain only alpha characters and space
    if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        $error = true;
        $name_error = "Name must contain only alphabets and space";
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "Please Enter Valid Email ID";
    }
    if(strlen($password) < 6) {
        $error = true;
        $password_error = "Password must be minimum of 6 characters";
    }
    if($password != $cpassword) {
        $error = true;
        $cpassword_error = "Password and Confirm Password doesn't match";
    }

    if (!$error) {
        if(mysqli_query($con, "INSERT INTO users(username,email,password,role) 
            VALUES('" . $name . "', '" . $email . "', '" . md5($password) . "', '" . $role . "')")) {
            $successmsg = "Successfully Registered! <a href='login.php'>Click here to Login</a>";
        } else {
            $errormsg = "Error in registering...Please try again later!";
        }
    }
}
?>
<?php include 'inc/head.php'; ?>
	<head><title>User Registration Script</title>
    <meta name="robots" content="noindex, nofollow">
    </head>
	<body>
    <?php include 'inc/menu.php'; ?>

    <div class="container">
		<h2>Sign Up</h2>
		<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">

			<label for="name" class="sr-only">>Name</label>
			<input type="text" name="name" placeholder="Username" required value="<?php if($error) echo $name; ?>" class="form-control" />
			<span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
			<br/>

			<label for="name" class="sr-only">>Email</label>
			<input type="text" name="email" placeholder="Email" required value="<?php if($error) echo $email; ?>" class="form-control" />
			<span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
			<br/>
			
			<label for="name" class="sr-only">>Password</label>
			<input type="password" name="password" placeholder="Password" required class="form-control" />
			<span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
			<br/>

			<label for="name" class="sr-only">>Confirm Password</label>
			<input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
			<span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
			<br/>

            <div class="checkbox">
                <label><input type="checkbox" name="role[]" value="1">Band</label>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" name="role[]" value="2">Arrangor</label>
            </div>
            <br/>

			<input type="submit" name="signup" value="Sign Up" class="btn btn-primary" />
			 
		</form>
			<span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>

			<p>Already Registered? <a href="login.php">Login Here</a></p>
    </div>
        <?php include 'inc/footer.php'; ?>

	</body>
</html>