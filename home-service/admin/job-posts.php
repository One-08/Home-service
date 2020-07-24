<?php

//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
//This is required if user tries to manually enter dashboard.php in URL.
if(empty($_SESSION['id_admin'])) {
	header("Location: index.php");
	exit();
}

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("../db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<title>Home Service</title>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="team" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="../css/bootstrap.min.css">
     <link rel="stylesheet" href="../css/owl.carousel.css">
     <link rel="stylesheet" href="../css/owl.theme.default.min.css">
     <link rel="stylesheet" href="../css/font-awesome.min.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="../css/tooplate-style.css">

</head>
<body>

   


     <!-- MENU -->
     <section id="vish" class="navbar custom-navbar navbar-fixed-top" role="navigation">
          <div class="container">

               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT HERE -->
                    <a href="index.php" class="navbar-brand">Home Service</a>
               </div>

               <!-- MENU LINKS -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">     
            <ul class="nav navbar-nav navbar-right">
            
              <li><a href="../logout.php">Logout</a></li>
          
            </ul>
          </div>

          </div>
     </section>
    <section>
    <section>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <div class="list-group">
            <a href="dashboard.php" class="list-group-item">Dashboard</a>
            <a href="user.php" class="list-group-item">Users</a>
            <a href="company.php" class="list-group-item ">Provider</a>
            <a href="job-posts.php" class="list-group-item active">Job Posts</a>
          </div>
        </div>
        <div class="col-md-6">
          <div class="col-md-6">
        <?php
          $sql = "SELECT * FROM job_post";
          $result = $conn->query($sql);
          if($result->num_rows > 0) {
            echo '<h3>Total Job Posts: ' . $result->num_rows . '</h3>'; 
          }
        ?>
          <table class="table">
            <thead>
              <th>SNo</th>
              <th>Job Tile</th>
              <th>Description</th>
              <th>Contact</th>
              <th>Total Users Taken</th>
              <th>Action</th>
            </thead>
            <tbody>
              <?php
                $sql = "SELECT * FROM job_post";
                $result = $conn->query($sql);
                if($result->num_rows > 0) {
                  $i = 0;
                  while($row = $result->fetch_assoc()) {
                    ?>
                      <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $row['jobtitle']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['contact']; ?></td>
                        <?php
                          $sql1 = "SELECT COUNT(get_service.id_apply) AS totalNo FROM job_post INNER JOIN get_service ON job_post.id_jobpost=get_service.id_jobpost WHERE job_post.id_jobpost='$row[id_jobpost]'";
                          $result1 = $conn->query($sql1);
                          if($result1->num_rows > 0) {
                             while($row1 = $result1->fetch_assoc()) {
                            ?>
                             <td><?php echo $row1['totalNo']; ?></td>
                            <?php
                          }
                        }
                        ?>
                        <td><a href="delete-job-post.php?id=<?php echo $row['id_jobpost']; ?>">Delete</a></td>
                      </tr>
                    <?php
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    </section> </section>
    <footer id="footer" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="copyright-text col-md-12 col-sm-12">
                         <div class="col-md-6 col-sm-6">
                              <p>Copyright &copy; 2020 Home Service : expviz</p>
                         </div>

                         <div class="col-md-6 col-sm-6">
                              <ul class="social-icon">
                                   <li><a href="#" class="fa fa-facebook-square" attr="facebook icon"></a></li>
                                   <li><a href="#" class="fa fa-twitter"></a></li>
                                   <li><a href="#" class="fa fa-instagram"></a></li>
                              </ul>
                         </div>
                    </div>

               </div>
          </div>
     </footer>
        

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script type="text/javascript">
      $(function() {
        $("#successMessage:visible").fadeOut(2000);
      });
    </script>
     </script>
     <script src="../js/jquery.js"></script>
     <script src="../js/bootstrap.min.js"></script>
     <script src="../js/jquery.stellar.min.js"></script>
     <script src="../js/owl.carousel.min.js"></script>
     <script src="../js/smoothscroll.js"></script>
     <script src="../js/custom.js"></script>

</body>
</html>