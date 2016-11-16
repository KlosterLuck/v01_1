<?php
session_start();
include_once 'inc/db.php';
?>

<?php include 'inc/head.php'; ?>
    <title>Home | Index</title>
    <meta name="robots" content="noindex, nofollow">
</head>
	<body>
	<?php include ('inc/menu.php'); ?>
		<h1>Read this post</h1>
		<div class="container">
		    <div class="span10 offset1">
                <div class="row">
                    <h3>Read a Customer</h3>
                </div>

                <?php
                if (isset($_GET['id'])) {
                	$post_id =  $_GET['id'];
					echo $post_id;
				} else {
					echo "NO ID";
				}

				$sql_find_bandmate_post = "SELECT id, username, user_id, titel, description FROM find_post WHERE id='$post_id';";
				 
				if($result = mysqli_query($con, $sql_find_bandmate_post)){
					if(mysqli_num_rows($result) > 0){
						while ($row = mysqli_fetch_row($result)){
							$row_rowid = $row[0]; 
							$row_username = $row[1];
							$row_user_id = $row[2];
							$row_titel = $row[3];
							$row_desc = $row[4];
							?>
							<div class="form-horizontal" >
			                  <div class="control-group">
			                    <label class="control-label">Titel</label>
			                    <div class="controls">
			                        <label class="checkbox">
			                            <?php echo $row_titel; ?>
			                        </label>
			                    </div>
			                  </div>
			                  <div class="control-group">
			                    <label class="control-label">Description</label>
			                    <div class="controls">
			                        <label class="checkbox">
			                            <?php echo $row_desc;  ?>
			                        </label>
			                    </div>
			                  </div>

			                  <small>Created by:<?php echo $row_username; ?></small>

			                    <div class="form-actions">
			                      <a class="btn" href="index.php">Back</a>
			                   </div>
			                 
			                  
			                </div>
			            </div>






							<?php
						}
					}	
				}
				?>



		</div>
		<?php
		// close connection
		mysqli_close($con);
		include ('inc/footer.php'); 
		?>
	</body>
</html>