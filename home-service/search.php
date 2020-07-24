<?php
  //To Handle Session Variables on This Page
  session_start();
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

<style>
.cards tbody tr {
   float: left;
   width: 19rem;
   margin: 0.5rem;
   border: 0.0625rem solid rgba(0, 0, 0, .125);
   border-radius: .25rem;
   box-shadow: 0.25rem 0.25rem 0.5rem rgba(0, 0, 0, 0.25);
}

.cards tbody td {
   display: block;
}

.cards thead {
   display: none;
}

.cards td:before {
   content: attr(data-label);
   position: relative;
   float: left;
   color: #808080;
   min-width: 4rem;
   margin-left: 0;
   margin-right: 1rem;
   text-align: left;   
}

tr.selected td:before {
   color: #CCC;
}

.table .avatar {
   width: 50px;
}

.cards .avatar {
   width: 150px;
   margin: 15px;
}
</style>
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
            <?php
            //Show user dashboard link once logged in.
            if(isset($_SESSION['id_user']) && empty($_SESSION['companyLogged'])) { 
              ?>
              <li><a href="user/dashboard.php">Dashboard</a></li>
              <li><a href="search.php">Search</a></li>
              <li><a href="user/used-services.php">History</a></li>
              <li><a href="user/profile.php">Profile</a></li>
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

    <section>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="jumbotron text-center">
              <h1>Search Service</h1>
              <p>Get Every Service At Home</p>
            </div>
          </div>
        </div>
      </div>
   
      <div class="container">
      <div class="row">
        <div class="col-md-12">
          <form id="myForm" class="online-form">
            <div class="form-group">
            </div>
            <div class="form-group">
              <label>Type</label>
              <select id="jobtype" class="form-control">
                <option value="" selected="">Select Type</option>
                <?php 
                // SQL query to get all differnet jobtype that has been entered in our database
                  $sql ="SELECT DISTINCT(jobtype) FROM job_post WHERE jobtype IS NOT NULL";
                  $result = $conn->query($sql);
                  if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()) {
                      echo "<option value'".$row['jobtype']."'>".$row['jobtype']."</option>";
                    }
                  }
                ?>
              </select>
            </div>
            <button class="btn btn-success">Search</button>
          </form>
        </div>
        <?php
            //Show user dashboard link once logged in.
            //Todo: Check if Provider logged in then show company dashboard? 
            if(isset($_SESSION['id_user'])) { 
              ?>
      </div>
        <div class="row" style="margin-top: 5%;">
          <div class="table-responsive">
            <table id="myTable" class="table table-sm table-hover" cellspacing="0" width="100%">
              <thead>
                <th>Job Name</th>
                <th>Description</th>
                <th>Contact</th>
                <th>Type</th>
                <th>Action</th>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <?php
            } else { 
              //Show Login Links if no one is logged in.
            ?>

</div>
        <div class="row" style="margin-top: 5%;">
          <div class="table-responsive">
            <table id="myTable" class="table">
              <thead>
                <th>Job Name</th>
                <th>Description</th>
                <th>Type</th>
                <th>Action</th>
              </thead>
              <tbody >
                
              </tbody>
            </table>
          </div>
        </div>
      </div>

<?php } ?>
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
     </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

    <script src="//bartaz.github.io/sandbox.js/jquery.highlight.js"></script>

    <script src="//cdn.datatables.net/plug-ins/1.10.15/features/searchHighlight/dataTables.searchHighlight.min.js"></script>

    <script type="text/javascript">
      $(function() {
        //this is how datatables are created. we are getting data from refresh_search page using ajax
        var oTable = $('#myTable').DataTable({
          "autoWidth": false,
          "ajax" : {
            "url" : "refresh_search.php",
            "dataSrc" : "",
          "data" : function (d) {
              d.jobtype = $("#jobtype").val();
            }
          }
        });

        oTable.on('draw', function() {
          var body = $(oTable.table().body());

          body.unhighlight();

          body.highlight(oTable.search());


        });

        //We only want to reload the ajax on submit button click instead of redirecting to form post page. so we use preventDefault();
        $("#myForm").on("submit", function(e) {
          e.preventDefault();
          oTable.ajax.reload( null, false);
        })

      });
    </script>


</body>
</html>