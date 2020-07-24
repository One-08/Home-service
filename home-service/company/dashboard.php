<?php

//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
//This is required if user tries to manually enter dashboard.php in URL.
if(empty($_SESSION['id_user'])) {
	header("Location: ../index.php");
	exit();
}

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
  <body >

    <!-- NAVIGATION BAR -->
    <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
    
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

          <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">     
            <ul class="nav navbar-nav navbar-right">
              
              <li><a href="../company/dashboard.php">Dashboard</a></li>
              <li><a href="../logout.php">Logout</a></li>
            
            </ul>
            </div><!-- /.navbar-collapse -->
        
 
    </section>
    <section id="home" data-stellar-background-ratio="0.5">
          <div class="overlay"></div>

    <!-- Job Post Created Success Message. -->
    <!-- Todo: Remove Success Message Without Reload. -->
    <div class="container">
    <div class="col-md-11 ">
    <?php if(isset($_SESSION['jobPostSuccess'])) { ?>
      <div class="row successMessage">
        <div class="alert alert-success">
          Job Post Created Successfully!
        </div>
      </div>
    <?php unset($_SESSION['jobPostSuccess']); } ?>
    
    <!-- Job Post Updated Success Message. -->
    <!-- Todo: Remove Success Message Without Reload. -->
    <?php if(isset($_SESSION['jobPostUpdateSuccess'])) { ?>
      <div class="row successMessage">
        <div class="alert alert-success">
          Job Post Updated Successfully!
        </div>
      </div>
    <?php unset($_SESSION['jobPostUpdateSuccess']); } ?>

    <!-- Job Post Deleted Success Message. -->
    <!-- Todo: Remove Success Message Without Reload. -->
    <?php if(isset($_SESSION['jobPostDeleteSuccess'])) { ?>
      <div class="row successMessage">
        <div class="alert alert-success">
          Job Post Deleted Successfully!
        </div>
      </div>
    <?php unset($_SESSION['jobPostDeleteSuccess']); } ?>
    </div>
    <div class="container">
              

    <div class="col-md-11 ">
      <div class="row">
        <h1>Dashboard</h1>
        <div class="col-md-offset-1 col-md-11 col-sm-12">
        <div class="col-md-3">
          <a href="create-job-post.php" class="btn btn-success btn-block btn-lg"><h3>Create Job Post</h3></a>
        </div>
        <div class="col-md-3">
          <a href="view-service-post.php" class="btn btn-success btn-block btn-lg"><h3>View Job Post</h3></a>
        </div>
        <?php
          $sql = "SELECT * FROM get_service WHERE id_company='$_SESSION[id_user]' AND status='0'";
          $result = $conn->query($sql);
          if($result->num_rows > 0) {
            ?>
           <div class="col-md-4">
             <a href="view-service-request.php" class="btn btn-success btn-block btn-lg"><h3>View Application <span class="badge"><?php echo $result->num_rows; ?></h3></a>
           </div> 
            <?php
          }
        ?>
      </div>
    </div>
        </section>
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