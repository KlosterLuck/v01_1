<?php
ob_start();
session_start();
include_once ('inc/db.php');
?>

<?php include 'inc/head.php'; ?>
    <title>Home | Update Post</title>
    <meta name="robots" content="noindex, nofollow">
</head>
	<body>
	<?php include ('inc/menu.php'); ?>
	<?php
$id = $_REQUEST['id'];
$user_id = $_SESSION['usr_id'];

// Check if logged in user is same as author
if(isset($_SESSION['usr_id'])){
	//echo "User id is set";
	echo "<br/>";
	$result = mysqli_query($con, "SELECT id, user_id FROM find_post WHERE id = '$id'");
	$row = mysqli_fetch_array($result);
		if ($result) {
			//Row from database
			$row_user_id = $row['user_id'];
			//Same user logged as author of the post?
			if ($user_id != $row_user_id){
				header('Location: index.php');
				exit();
			} else {
//If logged in user is the same as author then Update post
$result = mysqli_query($con, "SELECT titel, description FROM find_post WHERE id = '$id' AND user_id = '$user_id' ");
$row = mysqli_fetch_array($result);
if (!$result) {
		die("Error: Data not found..");
		}
		$titel = $row['titel'];
		$description = $row['description'];

if(isset($_POST['save'])) {	
	$title_save = $_POST['titel'];
	$description_save = $_POST['description'];
	mysqli_query($con, "UPDATE find_post SET titel ='$title_save', description='$description_save' WHERE id = '$id'")
	or die(mysql_error()); 
	echo "Saved! Refresh to save changes";
	}
	
mysqli_close($con);
?>

	<div class="container">
		<form class="form-horizontal" method="post">
			<div class="control-group">
				<label class="control-label">Titel</label>
				<div class="controls">
					<input name="titel" type="text"  placeholder="<?php echo $titel ?>" value="<?php echo $titel ?>">
				</div>
			</div>
			
			<div class="form-group">
			  <label for="comment">Description:</label>
			  <textarea class="form-control" rows="5" id="description" name="description">
				<?php echo htmlspecialchars ($description); ?>
			  </textarea>
			</div>

			<div class="form-actions">
			  <button type="submit" name="save" class="btn btn-success">Update</button>
			  <a class="btn" href="profile.php">Back</a>
			</div>
		</form>
	</div>
<?php
///
			}
		}
	// If user id is not set
	} else {
		echo "User id is not set";
		header('Location: index.php');
		die();
	}

	 include ('inc/footer.php'); ?>	
	</body>
</html>