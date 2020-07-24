<?php
//To Handle Session Variables on This Page
session_start();

//If user is already logged in then redirect them back to dashboard. 
//This is required if user tries to manually enter company-register.php in URL.
if(isset($_SESSION['id_user'])) {
    header("Location: user/dashboard.php");
    exit();
  }

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

   


     <!-- MENU -->
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

               <!-- MENU LINKS -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">     
            <ul class="nav navbar-nav navbar-right">
            <?php
            //Show user dashboard link once logged in.
            if(isset($_SESSION['id_user']) && empty($_SESSION['companyLogged'])) { 
              ?>
              <li><a href="user/dashboard.php">Dashboard</a></li>
              <li><a href="logout.php">Logout</a></li>
            <?php
              } else if(isset($_SESSION['id_user']) && isset($_SESSION['companyLogged'])) { 
              ?>
              <li><a href="company/dashboard.php">Dashboard</a></li>
              <li><a href="logout.php">Logout</a></li>
              <?php }  else { 
              //Show Login Links if no one is logged in.
            ?>
              <li><a href="company.php">Provider</a></li>
              <li><a href="register.php">Register</a></li>
              <li><a href="login.php">Login</a></li>
            <?php } ?>
            </ul>
          </div>

          </div>
     </section>

    <section id="home" data-stellar-background-ratio="0.5" >
    <div class="overlay"></div> 
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4 well">
          <h2 class="text-center">Provider Register</h2>
            <form method="post" action="addcompany.php">
              <div class="form-group">
                <label for="companyname">Provider Name</label>
                <input type="text" class="form-control" id="companyname" name="companyname" placeholder="Provider Name" required="">
              </div>
              <div class="form-group">
                <label for="headofficecity">Head Office City</label>
                <input type="text" class="form-control" id="headofficecity" name="headofficecity" placeholder="Head Office City" required="">
              </div>
              <div class="form-group">
                <label for="country">Country</label>
                <select class="form-control" id="country" name="country">
                <option selected="" value="">Select Country</option>
                <?php
                  $sql="SELECT * FROM countries";
                  $result=$conn->query($sql);

                  if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      echo "<option value='".$row['name']."' data-id='".$row['id']."'>".$row['name']."</option>";
                    }
                  }
                ?>
                  
                </select>
              </div>  
              <div id="stateDiv" class="form-group" style="display: none;">
                <label for="state">State</label>
                <select class="form-control" id="state" name="state">
                  <option value="" selected="">Select State</option>
                </select>
              </div>   
              <div id="cityDiv" class="form-group" style="display: none;">
                <label for="city">City</label>
                <select class="form-control" id="city" name="city">
                  <option selected="">Select City</option>
                </select>
              </div>               
              <div class="form-group">
                <label for="contactno">Contact Number</label>
                <input type="text" class="form-control" id="contactno" name="contactno" placeholder="Contact Number" minlength="10" maxlength="10" autocomplete="off" onkeypress="return validatePhone(event);" required="">
              </div>
              <div class="form-group">
                <label for="website">Website</label>
                <input type="text" class="form-control" id="website" name="website" placeholder="Website">
              </div>
              <div class="form-group">
                <label for="companytype">Provider Type</label>
                <input type="text" class="form-control" id="companytype" name="companytype" placeholder="Provider Type">
              </div>
              <div class="form-group">
                <label for="email">Provider Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required="">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="">
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
              <?php 
              //If Provider already registered with this email then show error message.
              if(isset($_SESSION['registerError'])) {
                ?>
                <div>
                  <p class="text-center">Email Already Exists! Choose A Different Email!</p>
                </div>
              <?php
               unset($_SESSION['registerError']); }
              ?>     
            </form>
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
      function validatePhone(event) {

        //event.keycode will return unicode for characters and numbers like a, b, c, 5 etc.
        //event.which will return key for mouse events and other events like ctrl alt etc. 
        var key = window.event ? event.keyCode : event.which;

        if(event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 39) {
          // 8 means Backspace
          //46 means Delete
          // 37 means left arrow
          // 39 means right arrow
          return true;
        } else if( key < 48 || key > 57 ) {
          // 48-57 is 0-9 numbers on your keyboard.
          return false;
        } else return true;
      }
    </script>

    <script>
      $("#country").on("change", function() {
        var id = $(this).find(':selected').attr("data-id");
        $("#state").find('option:not(:first)').remove();
        if(id != '') {
          $.post("state.php", {id: id}).done(function(data) {
            $("#state").append(data);
          });
          $('#stateDiv').show();
        } else {
          $('#stateDiv').hide();
          $('#cityDiv').hide();
        }
      });
    </script>

    <script>
      $("#state").on("change", function() {
        var id = $(this).find(':selected').attr("data-id");
        $("#city").find('option:not(:first)').remove();
        if(id != '') {
          $.post("city.php", {id: id}).done(function(data) {
            $("#city").append(data);
          });
          $('#cityDiv').show();
        } else {
          $('#cityDiv').hide();
        }
      });
    </script>
 
 
        

     <!-- SCRIPTS -->

     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/custom.js"></script>

</body>
</html>