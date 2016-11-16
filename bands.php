<?php
//session_start();
include_once 'inc/db.php';
?>

<?php include 'inc/head.php'; ?>
    <title>Home | Index</title>
    <meta name="robots" content="noindex, nofollow">
</head>
	<body>
	<?php include ('inc/menu.php'); ?>
		<div class="container">
			<section>
				<h1>All bands</h1>
  <?php
      $sql_all_bands = "SELECT * FROM users WHERE role=1 ORDER BY id DESC";
        if($result = mysqli_query($con, $sql_all_bands)){
          if(mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_row($result)){
              $row_band_id = $row[0]; 
              $row_band_username = $row[1];
              ?>


              	<div class="all-bands-box">
                  <h2>Band<?php echo $row_band_username; ?></a></h2>
                  <h5><span class="label label-success">Lorem</span>
                  <span class="label label-danger">Genre</span> 
                  <span class="label label-primary">Location?</span>
                  </h5>
                  <br>
                  <p> <?php //echo substr($row_desc, 0, 300); ?> ... </p>
                  <hr>
             	</div>

              <?php
              }
            }
          }
          ?>
  			</section>

		</div>
	<?php include ('inc/footer.php'); ?>
	</body>
</html>