<?php
session_start();

if(isset($_SESSION['usr_id'])!="") {
    header("Location: index.php");
}

include_once 'inc/db.php';

//check if form is submitted
if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $result = mysqli_query($con, "SELECT * FROM users WHERE email = '" . $email. "' and password = '" . md5($password) . "'");

    if ($row = mysqli_fetch_array($result)) {
        $_SESSION['usr_id'] = $row['id'];
        $_SESSION['usr_name'] = $row['username'];
        $_SESSION['usr_role'] = $row['role'];
        	if ($_SESSION['usr_role'] == 1){
        		header("Location: profile.php");
        	}
        	elseif ($_SESSION['usr_role'] == 2){
        		header("Location: arr.php");
        	}
        	else{
        		 header("Location: index.php");
        	}
       
    } else {
        $errormsg = "Incorrect Email or Password!!!";
    }
}
?>

<?php include 'inc/head.php'; ?>

	<title>PHP Login Script</title>
	<meta name="robots" content="noindex, nofollow">
</head>
	<body>
	<?php include 'inc/menu.php'; ?>

	<div class="container">
	<h3>Login</h3>
		<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
			<label for="name" class="sr-only">Email</label>
			<input type="text" name="email" placeholder="Your Email" required class="form-control" />
	  
			<label for="name" class="sr-only">Password</label>
			<input type="password" name="password" placeholder="Your Password" required class="form-control" />

			<input type="submit" name="login" value="Login" class="btn btn-primary" />
		</form>
		<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>

		<p>New User? <a href="register.php">Sign Up Here</a></p>
	</div>

	<?php include 'inc/footer.php'; ?>		
	</body>
</html>