<?php
session_start();
include_once 'inc/db.php';
?>

<?php include 'inc/head.php'; ?>
    <title>Find Bandmate | Index</title>
    <meta name="robots" content="noindex, nofollow">
</head>
	<body>
	<?php include ('inc/menu.php'); ?>
<div class="container">
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <h4>John's Blog</h4>
<form class="form-horizontal" role="form">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search Blog..">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>
      <br/>

      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="#section1">Home</a></li>
        <li><a href="#section2">Friends</a></li>
        <li><a href="#section3">Family</a></li>
        <li><a href="#section3">Photos</a></li>
      </ul>

    <span>Looking for Bandmates</span>
    <div class="checkbox">
    	<label><input type="checkbox"/> Guitarist</label>
    </div>

    <div class="checkbox">
    	<label><input type="checkbox"/> Bassist</label>
    </div>
    <br/>

    <div class="form-group col-sm-12">
        <span>Looking For Band</span>
		<br/>
	    <select class="form-control inputstl" id="gender">
			<option>Bassist</option>
		    <option>Guitarist</option>
	    </select>
	     
    </div>

    Landsdel

    Genre

<input type="submit" name="" value="submit" class="btn btn-primary" />
</form>
    </div>



  <section>
  <div class="col-sm-9">
                  <h4><small>RECENT POSTS</small></h4>
                  <hr>
  </div>
  <?php
      $sql_find_bandmate_posts = "SELECT * FROM find_post ORDER BY id DESC";
        if($result = mysqli_query($con, $sql_find_bandmate_posts)){
          if(mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_row($result)){
              $row_rowid = $row[0]; 
              $row_username = $row[1];
              $row_user_id = $row[2];
              $row_titel = $row[3];
              $row_desc = $row[4];
              ?>

                <div class="col-sm-9">

                  <h2><a href="find_bandmate_post.php?id=<?php echo $row_rowid; ?>"><?php echo $row_titel; ?></a></h2>
                  <h5><span class="glyphicon glyphicon-time"></span> Post by <?php echo $row_username; ?> , Sep 27, 2015.</h5>
                  <h5><span class="label label-success">Lorem</span>
                  <span class="label label-danger">Food</span> 
                  <span class="label label-primary">Ipsum</span>
                  </h5>
                  <br>
                  <p> <?php echo substr($row_desc, 0, 300); ?> ... </p>
                  <hr>
                </div>
              <?php
              }
            }
          }
          ?>
  </section>

  </div>
</div>

<?php include 'inc/footer.php' ?>

</body>
</html>
