<?php

//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
//This is required if user tries to manually enter dashboard.php in URL.
if(empty($_SESSION['id_user'])) {
	header("Location: ../index.php");
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
                    <a href="../index.php" class="navbar-brand">Home Service</a>
               </div>

               <!-- MENU LINKS -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">     
            <ul class="nav navbar-nav navbar-right">
              <li><a href="dashboard.php">Dashboard</a></li>
              <li><a href="../search.php">Search</a></li>
              <li><a href="used-services.php">History</a></li>
              <li><a href="profile.php">Profile</a></li>
              <li><a href="../logout.php">Logout</a></li>
            </ul>
          </div>

          </div>
     </section> 
     <section> 
        <div class="container">

      <!-- Applied To Job Success Message. -->
      <!-- Todo: Remove Success Message Without Reload. -->
      <?php if(isset($_SESSION['jobApplySuccess'])) { ?>
      <div class="row">
        <div class="col-md-12 successMessage">
          <div class="alert alert-success">
            You Have Successfully Applied!
          </div>
        </div>
      </div>
      <?php unset($_SESSION['jobApplySuccess']); } ?>
      
    
      <!-- Search and Get To Job Posts -->
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <h2 class="text-center">Services</h2>
            <table class="table table-striped">
              <thead>
                <th>Job Name</th>
                <th>Description</th>
                <th>Contact</th>
                <th>Job Type</th>
                <th>Created At</th>
                <th>Action</th>
              </thead>
              <tbody>
                <?php 
                  //Sql for showing all job posts
                  $sql = "SELECT * FROM job_post";
                  $result = $conn->query($sql);

                  //if there are job posts then display them.
                  if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) 
                    {
                      //Check if user has applied to job or not. If applied dont show apply link.
                      $sql1 = "SELECT * FROM get_service WHERE id_user='$_SESSION[id_user]' AND id_jobpost='$row[id_jobpost]'";
                      $result1 = $conn->query($sql1);
                      
                     ?>
                      <tr>
                        <td><?php echo $row['jobtitle']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['contact']; ?></td>
                        <td><?php echo $row['jobtype']; ?></td>
                        <td><?php echo date("d-M-Y", strtotime($row['createdat'])); ?></td>
                        <?php
                        // If User already applied to job post then don't show apply link.
                        if($result1->num_rows > 0) { 
                          ?>
                           <td><strong>Requested</strong></td>
                          <?php
                        } else {
                        ?>
                        <td><a href="get-service.php?id=<?php echo $row['id_jobpost']; ?>">Get</a></td>
                        <?php } ?>                        
                      </tr>
                     <?php
                    }
                  }
                  $conn->close();
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    </section> 
     <!-- FOOTER -->
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


     <script type="text/javascript">
      $(function() {
        $(".successMessage:visible").fadeOut(2000);
      });
    </script>


     <!-- SCRIPTS -->
     <script src="../js/jquery.js"></script>
     <script src="../js/bootstrap.min.js"></script>
     <script src="../js/jquery.stellar.min.js"></script>
     <script src="../js/owl.carousel.min.js"></script>
     <script src="../js/smoothscroll.js"></script>
     <script src="../js/custom.js"></script>

</body>
</html>