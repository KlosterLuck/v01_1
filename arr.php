<?php
    session_start();
    //$role = $_SESSION['sess_userrole'];
    if(!isset($_SESSION['usr_id']) /*|| $role!="admin"*/){
      header('Location: index.php?err=2');
    }


ob_start();
//session_start();

include_once 'inc/db.php';
?>

<?php include 'inc/head.php'; ?>

    <title>Profile</title>
    <meta name="robots" content="noindex, nofollow">
    <meta HTTP-EQUIV="Pragma" content="no-cache">
</head>
	<body>
		<?php include ('inc/menu.php'); ?>

			<h1>Welcome <?php echo $_SESSION['usr_name']; ?></h1>
			<h2>Role <?php echo $_SESSION['usr_role']; ?></h2>
			<br/>
			
			<?php
			//Save Username to variable
			$username = $_SESSION['usr_name'];
			$userid =  $_SESSION['usr_id'];

			?>			
			logo
			genre
			social media
			beskrivelse
			posts/events?

			


		<?php
		// close connection
		mysqli_close($con);
		ob_end_flush();
		?>			
		<?php include 'inc/footer.php'; ?>
	</body>
</html>