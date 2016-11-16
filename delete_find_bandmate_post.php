<?php
ob_start();
session_start();
include_once 'inc/db.php';
?>

<?php include 'inc/head.php'; ?>
    <title>Home | Index</title>
    <meta name="robots" content="noindex, nofollow">
</head>
  <body>
  <?php include ('inc/menu.php'); ?>

          <div class="container">
     
            <h3>Delete a post</h3>

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
                      //echo "Not same user";
                    } else {

                // Delete
                  if (isset($_GET['id']) ) {
                    if(isset($_POST['delete'])) { 
                        
                        // sql to delete a record
                        $sql = "DELETE FROM find_post WHERE id='$id'";
                        if ($con->query($sql) === TRUE) {
                              header('Location: profile.php');
                              die();
                            //echo "Record deleted successfully";
                        } else {
                            echo "Error deleting record: " . $conn->error;
                        }
                    }
                  }

                ?> 

              <form class="form-horizontal" method="post">
                <input type="hidden" name="id" value="<?php echo $id;?>"/>
                <p class="alert alert-error">Are you sure to delete ?</p>
                <div class="form-actions">
                    <button type="submit" name="delete" class="btn btn-danger">Yes</button>
                    <a class="btn" href="profile.php">No</a>
                  </div>
              </form>
               <?php
              }
            }
          } 
          ?>
                 
          </div> <!-- /container -->

          </div>
  <?php include ('inc/footer.php'); ?>
  </body>
</html>