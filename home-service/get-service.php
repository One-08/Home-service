<?php

//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
//This is required if user tries to manually enter get-service.php in URL.
if(empty($_SESSION['id_user'])) {
  $_SESSION['callFrom'] = "get-service.php?id=".$_GET[id];
	header("Location: login.php");
	exit();
}

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");
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

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/owl.carousel.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/tooplate-style.css">

</head>
  <body>
    
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
                    <a href="index.php" class="navbar-brand">Home Service</a>
               </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">     
            <ul class="nav navbar-nav navbar-right">
              <li><a href="user/profile.php">Profile</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
            </div><!-- /.navbar-collapse -->
        
 
    </section>
    <section id="home" data-stellar-background-ratio="0.5" >
    <div class="overlay"></div> 
    <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php 
          //Get Job Post details From id passed through url.
          $sql = "SELECT * FROM job_post WHERE id_jobpost='$_GET[id]'";
          $result = $conn->query($sql);
          
          //If job post with Url Id exists then show details about the post.
          if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) 
            {
             ?>
                    <h1 class="text-center"><?php echo $row['jobtitle']; ?></h1>
                    <h2><?php echo $row['description']; ?><h2>
                   <button> <a href="get.php?id=<?php echo $row['id_jobpost']; ?>" ><h4>Get</h4></a></button>
              <?php
            }
          }
          ?>
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
        

     <!-- SCRIPTS -->
   
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/custom.js"></script>

</body>
</html>