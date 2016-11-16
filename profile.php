<?php
	ob_start();
    session_start();
    //$role = $_SESSION['sess_userrole'];
    if(!isset($_SESSION['usr_id']) /*|| $role!="admin"*/){
      header('Location: index.php?err=2');
    }


include_once 'inc/db.php';
?>

<?php include 'inc/head.php'; ?>

    <title>Profile</title>
    <meta name="robots" content="noindex, nofollow">
    <meta HTTP-EQUIV="Pragma" content="no-cache">
</head>
	<body>
		<?php include ('inc/menu.php'); ?>
		<div class="container">
			<h1>Welcome <?php echo $_SESSION['usr_name']; ?></h1>
			<h2>Role <?php echo $_SESSION['usr_role']; ?></h2>
			<br/>
			
			<?php
			//Save Username to variable
			$username = $_SESSION['usr_name'];
			$user_id =  $_SESSION['usr_id'];
			echo $user_id;

			?>			
			logo
			genre
			social media
			beskrivelse
			posts/events?
			<hr/>
			<h2>Opret opslag</h2>
			
<!-- POST a POST -->

			<form method="POST">
				<div class="form-group">
				  <label for="titel">Titel:</label>
				  <input type="text" name="add_titel" class="form-control" id="titel">
				</div>
				<div class="form-group">
				  <label for="description">Description:</label>
				  <textarea class="form-control" name="add_desc" rows="5" id="description"></textarea>
				</div>
				<input type="submit" name="submitpost" value="submit" class="btn btn-primary" />
			</form>
		
		<?php

			if (isset($_POST["submitpost"])) {
				// Saves the inputs to variables
				$add_titel = mysqli_real_escape_string($con, $_POST['add_titel']);
				$add_desc = mysqli_real_escape_string($con, $_POST['add_desc']);
				// MySQL Code

				$sql_insert = "
				INSERT INTO find_post 
				(username, user_id, titel, description) 
				VALUES 
				('$username', '$user_id', '$add_titel', '$add_desc');";
					
				if(mysqli_query($con, $sql_insert)) {
					$sql_insert;
					echo 'Your post has been created';

				} else{
					echo "ERROR: Could not able to execute $sql_insert. " . mysqli_error($con);
				}
			}

		?>	
<!-- SEE ALL POSTS -->

			<h2>My posts</h2>
			<?php
			
				$sqlselected = "SELECT id, username, user_id, titel, description FROM find_post WHERE user_id = '$user_id';";
				/*Delete Email from DB*/


				/* My Devices List*/
 				if($result = mysqli_query($con, $sqlselected)){
					if(mysqli_num_rows($result) > 0){
						
						while ($row = mysqli_fetch_row($result)){  
						$row_rowid = $row[0]; 
						$row_name = $row[1];
						$row_user_id = $row[2];
						$row_titel = $row[3];
						$row_desc = $row[4];
						?>
							<table class="table">
								<tr>
									<th>ROW ID</th>
									<th>Actions</th>
									<th>Name</th>
									<th>User_id</th>
									<th>Titel</th>
									<th>Desc</th>
								</tr>
								<tr>
									<td><?php echo $row_rowid; ?></td>
									<td>
									<a class="btn btn-default" href="find_bandmate_post.php?id=<?php echo $row_rowid; ?>">Read
									</a>
									<a class="btn btn-success" href="update_find_bandmate_post.php?id=<?php echo $row_rowid; ?>">Update</a>
                              		<a class="btn btn-danger" href="delete_find_bandmate_post.php?id=<?php echo $row_rowid; ?>">Delete</a>
									</td>
									
									<td><?php echo $row_name; ?></td>
									<td><?php echo $row_user_id; ?></td>
									<td><?php echo $row_titel; ?></td>
									<td><?php echo substr($row_desc, 0, 50); ?>..</td>
								</tr>
							</table>
						<?php
						}
					}
				}

		// close connection
		mysqli_close($con);
		ob_end_flush();
		?>	
		</div> <!-- CONTAINER -->		
		<?php include 'inc/footer.php'; ?>
	</body>
</html>