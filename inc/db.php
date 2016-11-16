<?php
//connect to mysql database
/*
$con = mysqli_connect("mysql9.gigahost.dk", "bjorkvig", "Live#999", "bjorkvig_qonit"); // or die("Error " . mysqli_error($con));

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error($con);
  }
*/
  	//Connects to DB - DB name: php
	$con = mysqli_connect("localhost", "root", "root", "db");
	
	//Is there connection (True)? If False = Show error
	if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
	}
?>