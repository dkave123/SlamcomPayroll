
<?php
include("../AdminServer/AdminLoginVerification.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>



    <!-- Bootstrap Core CSS -->
    <link href="../../AdminPageBootStrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../AdminPageBootStrap/css/sb-admin.css" rel="stylesheet">


    <!-- Morris Charts CSS -->
    <link href="../../AdminPageBootStrap/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../AdminPageBootStrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


    <link href="../../munchkinBootStrap/CSS/userCSS.css" rel="stylesheet" type="text/css">

    <link href="../../fullCalendar/css/fullcalendar.min.css" rel="stylesheet"/>
    <link href="../../fullCalendar/css/fullcalendar.print.min.css" rel="stylesheet" media="print"/>

    <?php include("cssRefs.php") ?>
    <style>
      body {
    		margin: 40px 10px;
    		padding: 0;
    		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    		font-size: 14px;
    	}

    	#calendar {
    		width: inherit;
            height: inherit;
    		margin: 0 auto;
    	}
        #mainContent{
            width: 85%;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div id="wrapper">

        <?php include("sideBar.php"); ?>

        <div id="mainContent">

            <div class="container-fluid">
                <!--just make it a list of days where its special holiday-->

                <div class="row">
                    <div class="col-lg-12">

                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Total hours per month for each user
                            </li>
                        </ol>
                    </div>
                </div>
                <button id="deleteDataMonthBtn" class="btn btn-primary" style="margin-bottom: 10px;">Reset month</button>
                <div class="table-responsive">
                    <table id="TotalHoursperMonth" class="table table-hover table-striped" cellspacing="0" width="100%" style= "width: 80%">
                        <thead>
                            <tr>
                                <th>Total Late</th>
                                <th>Total Hours Made</th>
                                <th>Total Overtime</th>
                                <th>First name</th>
                                <th>Last name</th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- turn this into a form so we can serialize and pass to ajax POST  -->
                            <?php
                                include("../AdminServer/DBconnect.php");
                                $query = 'SELECT * FROM `totalhourspermonth` WHERE `Active` = 1';


                                $result = mysqli_query($conn,$query);

                                if($result){
                                  while($row = mysqli_fetch_array($result)){
                                      $userID = $row["userID"];
                                      $sql = "SELECT `firstname`, `lastname` FROM `user` WHERE `userID` = '$userID'";

                                      $userResult = mysqli_query($conn,$sql);

                                        if($userResult){
                                            $userRow = mysqli_fetch_array($userResult);
                                            echo '<tr id='.$row[0].'>
                                                  <td>'.$row[0].'</td>
                                                  <td>'.$row[1].'</td>
                                                  <td>'.$row[2].'</td>
                                                  <td>'.$userRow[0].'</td>
                                                  <td>'.$userRow[1].'</td>
                                                  </tr>';
                                        }
                                  }
                                }
                            ?>

                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            <!-- /.container-fluid -->
            <!--<div id="calendar" class="calendarClass">


            </div>-->
        </div>

        <!-- /#page-wrapper -->

    </div>

    <!-- /#wrapper -->

      <!-- jQuery -->
      <script src="../../fullCalendar/js/moment.min.js"></script>
      <script src="../../fullCalendar/js/jquery.min.js"></script>
    <!--<script src="//code.jquery.com/jquery-1.12.4.js"></script>-->
    <script src="../../fullCalendar/js/fullcalendar.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../AdminPageBootStrap/js/bootstrap.js"></script>
    <script type="text/javascript" charset="utf-8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
    <!-- Latest compiled and minified JavaScript -->






    <script>
        jQuery(document).ready(function(){
          $('#calendar').fullCalendar({
      			defaultDate: '2017-09-12',
      			editable: true,
      			eventLimit: true // allow "more" link when too many events

      		});

            $("#TotalHoursperMonth").DataTable();
            $("#deleteDataMonthBtn").on("click",function(){
                //window.location.replace("../AdminServer/refreshMonthData.php");
                $.ajax({
                  url: "../AdminServer/refreshMonthData.php",
                  success: function(data){
                    if(data == "refresh successful"){
                      window.location.replace("AdminDashboard.php");
                    }else{
                      alert(data);
                    }
                  },
                  error: function(data){
                    console.log(data);
                  }
                });
            });
        });
    </script>





</body>

</html>
