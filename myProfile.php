<?php
  session_start();
  if(!$_SESSION['checker']){
  header("Location:index.php ");
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>SLAMCOM - Profile</title>

    <?php
      include("scripts.html");
      include("exe/database.php");
    ?>
  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
      <?php
        include("header.php");
        include("sidebar.php");
      ?>

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
		  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-user-md"></i> Profile</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="home.php">Home</a></li>
						<li><i class="fa fa-user-md"></i>Profile</li>
					</ol>
				</div>
			</div>
              <div class="row">
                <!-- profile-widget -->
                <div class="col-lg-12">
                    <div class="profile-widget profile-widget-info">
                          <div class="panel-body">
                            <div class="col-lg-2 col-sm-2">
                              <h4><?php echo $_SESSION['user']; ?></h4>
                              <div class="follow-ava">
                                  <img src="img/profile_mini.jpg"> <!-- img path here -->
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
              </div>
              <!-- page start-->
              <div class="row">
                 <div class="col-lg-12">
                    <section class="panel">
                      <div id="profile" class="tab-pane active">
                        <section class="panel">
                          <div class="bio-graph-heading">
                            Self Introduction Here
                          </div>
                          <div class="panel-body bio-graph-info">
                              <h1>Bio Graph</h1>
                              <div class="row">
                                  <div class="bio-row">
                                    <?php
                                      $result = mysqli_query($con,"SELECT firstname FROM adminusers where userID =".$_SESSION['id']);
                                      $row = mysqli_fetch_Array($result);
                                      echo '<p><span>First Name </span>: '.$row[0].'</p>';
                                    ?>
                                  </div>
                                  <div class="bio-row">
                                    <?php
                                      $result = mysqli_query($con,"SELECT lastname FROM adminusers where userID =".$_SESSION['id']);
                                      $row = mysqli_fetch_Array($result);
                                      echo '<p><span>Last Name </span>: '.$row[0].'</p>';
                                    ?>
                                  </div>
                                  <div class="bio-row">
                                    <?php
                                      $result = mysqli_query($con,"SELECT bday FROM adminusers where userID =".$_SESSION['id']);
                                      $row = mysqli_fetch_Array($result);
                                      echo '<p><span>Birthday </span>: '.$row[0].'</p>';
                                    ?>
                                  </div>
                                  <div class="bio-row">
                                    <?php
                                      $result = mysqli_query($con,"SELECT address FROM adminusers where userID =".$_SESSION['id']);
                                      $row = mysqli_fetch_Array($result);
                                      echo '<p><span>Address </span>: '.$row[0].'</p>';
                                    ?>
                                  </div>
                                  <div class="bio-row">
                                    <?php
                                      $result = mysqli_query($con,"SELECT mobileNo FROM adminusers where userID =".$_SESSION['id']);
                                      $row = mysqli_fetch_Array($result);
                                      echo '<p><span>Mobile No </span>: '.$row[0].'</p>';
                                    ?>
                                  </div>
                                  <div class="bio-row">
                                    <?php
                                      $result = mysqli_query($con,"SELECT email FROM adminusers where userID =".$_SESSION['id']);
                                      $row = mysqli_fetch_Array($result);
                                      echo '<p><span>Email Address </span>: '.$row[0].'</p>';
                                    ?>
                                  </div>
                              </div>
                          </div>
                        </section>
                          <section>
                              <div class="row">
                              </div>
                          </section>
                      </div>
          </section>
      </section>
      <!--main content end-->
      <div class="text-right">
            <div class="credits">
                <!--
                    All the links in the footer should remain intact.
                    You can delete the links only if you purchased the pro version.
                    Licensing information: https://bootstrapmade.com/license/
                    Purchase the pro version form: https://bootstrapmade.com/buy/?theme=NiceAdmin
                -->
                <a href="https://bootstrapmade.com/free-business-bootstrap-themes-website-templates/">Business Bootstrap Themes</a> by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
  </section>

  <script>

    $(document).ready(function(){

        $("#ConfirmNewPassword").on("input",function(){
          if($("#NewPassword").val() != $("#ConfirmNewPassword").val()){
            $("#ConfirmNewPassword").css('border-color', 'red');
            $("#ConfirmNewPassword").css('border-width', '2px');
          }else{
            $("#ConfirmNewPassword").css('border-color', 'green');
          }
        });

        function validateEmail($email){
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,6})?$/;

            return ($email.length > 0 && emailReg.test($email));
        }

        $("#email").on("input",function(){
          if(!validateEmail($("#email").val())){
            $("#email").css('border-color', 'red');
            $("#email").css('border-width', '2px');
          }else{
            $("#email").css('border-color', 'green');
          }
        });

    });
  </script>


  </body>
</html>
