<?php

//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
//This is required if user tries to manually enter edit-job-post.php in URL.
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
  <body >

    <!-- NAVIGATION BAR -->
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

          <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">     
            <ul class="nav navbar-nav navbar-right">
              
              <li><a href="../company/dashboard.php">Dashboard</a></li>
              <li><a href="../logout.php">Logout</a></li>
            
            </ul>
            </div><!-- /.navbar-collapse -->
        
 
    </section>   
  
    <section>
    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4 well">
          <h2 class="text-center">Update Job Post</h2>
            <form method="post" action="editpost.php">
            <?php
            //Sql Query for show job post to edit if it is created with logged in company.
            $sql = "SELECT * FROM job_post WHERE id_jobpost='$_GET[id]' AND id_company='$_SESSION[id_user]'";
            $result = $conn->query($sql);

            //If job post is created by logged in company then show job post details to edit.
            if($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) 
              {
            ?>
              <div class="form-group">
                <label for="jobtitle">Job Title</label>
                <input type="text" class="form-control" id="jobtitle" name="jobtitle" value="<?php echo $row['jobtitle']; ?>" placeholder="Job Title" required="">
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" placeholder="Description" required=""><?php echo $row['description']; ?></textarea>
              </div>
              <div class="form-group">
                <label for="contact">Contact</label>
                <input type="text" class="form-control" id="contact" value="<?php echo $row['contact']; ?>" name="contact" placeholder="Contact" required="">
              </div>
              <div class="form-group">
                <label for="jobtype">Type Required</label>
                <input type="text" class="form-control" id="jobtype" name="jobtype" value="<?php echo $row['jobtype']; ?>" placeholder="Type Required" required="">
              </div>
              <input type="hidden" name="target_id" value="<?php echo $_GET['id']; ?>">
              <div class="text-center">
                <button type="submit" class="btn btn-success">Update</button>
              </div>
              <?php 
                }
              } else {
                //If job post not created by logged in company then redirect to dashboard.
                header("Location: dashboard.php");
                exit();
              }
              ?>     
            </form>
          </div>
        </div>
      </div>
    </section>
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
        

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="../js/jquery.js"></script>
     <script src="../js/bootstrap.min.js"></script>
     <script src="../js/jquery.stellar.min.js"></script>
     <script src="../js/owl.carousel.min.js"></script>
     <script src="../js/smoothscroll.js"></script>
     <script src="../js/custom.js"></script>

</body>
</html>