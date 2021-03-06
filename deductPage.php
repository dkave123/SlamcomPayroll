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

    <title>Widgets | Creative - Bootstrap 3 Responsive Admin Template</title>
    <?php
    include("exe/database.php");
    include("scripts.html");
    ?>
  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
      <?php
        include("sidebar.php");
        include("header.php");
      ?>
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <div class="row">
                  <div class="col-lg-12">
					<h3 class="page-header"><i class="icon_genius"></i> Inventory Action</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
                        <li><i class="icon_genius"></i>Inventory</li>
                        <li><i class="icon_genius"></i>Deduct</li>
                    </ol>
				</div>
            </div>

            <div class = "col-lg-6">
            <div class = "panel panel-default">
                <div class = "panel-heading">Restock</div>
                <div class = "panel-body">
                    <form>
                    <div class = "form-group">
                            <label class = "col-sm-3">Item ID:</label>
                            <input class = "col-sm-8" id = "itemID" disabled></input>
                        </div></br></br>
                        <div class = "form-group">
                            <label class = "col-sm-3">Item Name:</label>
                            <input class = "col-sm-8" id = "itemName" disabled></input>
                        </div></br>
                        <div class = "form-group">
                            <label class = "col-sm-3">Category:</label>
                            <input class = "col-sm-8" id = "itemCategory" disabled></input>
                        </div></br>
                        <div class = "form-group">
                            <label class = "col-sm-3">Quantity:</label>
                            <input class = "col-sm-8" id = "itemQty" disabled></input>
                        </div></br>
                        <div class="form-group">
                            <label>Item Description:</label>
                            <textarea class="form-control" rows="9.8" id="itemDesc" disabled></textarea>
                        </div></br>
                        <div class = "form-group">
                            <label class = "col-sm-3">Deduct</label>
                            <input class = "col-sm-8" type = "number" id = "deductQty">
                        </div></br>

                        <button type = "button" class = "btn btn-default">Cancel</button>
                        <button type = "submit" id = "deductkBtn" class = "btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

            <div class = "col-lg-6">
                <div class = "panel panel-default">
                    <div class = "panel-heading">Item List</div>
                    <div class = "panel-body">
                    <div>
                        <table id="itemList" class="table table-hover table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Item Name</th>
                                        <th>Category</th>
                                        <th>Quantity</th>
                                        <th>Description</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = 'SELECT `id`, `name`, `category`, `qty`, `itemDesc` FROM item';
                                    $result = mysqli_query($con, $query);

                                    while($row = mysqli_fetch_array($result)){
                                        echo '<tr id='.$row[0].'>
                                                <td>'.$row[0].'</td>
                                                <td>'.$row[1].'</td>
                                                <td>'.$row[2].'</td>
                                                <td>'.$row[3].'</td>
                                                <td>'.$row[4].'</td>
                                                </tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                    </div>
                    </div>
                </div>
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
  <!-- container section end -->


  <script>

      var taskTable = $("#itemList").DataTable({
        "bLengthChange":false,
    });


      $("#itemList tbody").on("click","td",function(){
          data = taskTable.row($(this).parent('tr')).data();

          $("#itemID").val(data[0]);
          $("#itemName").val(data[1]);
          $("#itemCategory").val(data[2]);
          $("#itemQty").val(data[3]);
          $("#itemDesc").val(data[4]);

      });

      $("#deductkBtn").on("click",function(){
           var itemID = $("#itemID").val();
           var deductQty = $("#deductQty").val();
           var oldQty = $("#itemQty").val();

            $.ajax({
                url:"exe/deduct.php",
                method:"POST",
                data: {deductQty: deductQty, itemID: itemID, oldQty: oldQty},
                success: function(data){
                  alert(data);
                  window.location.href="deduct.php";
                },
                error: function(jqXHR, exception){
                  var msg = '';
                  if (jqXHR.status === 0) {
                      msg = 'Not connect.\n Verify Network.';
                  } else if (jqXHR.status == 404) {
                      msg = 'Requested page not found. [404]';
                  } else if (jqXHR.status == 500) {
                      msg = 'Internal Server Error [500].';
                  } else if (exception === 'parsererror') {
                      msg = 'Requested JSON parse failed.';
                  } else if (exception === 'timeout') {
                      msg = 'Time out error.';
                  } else if (exception === 'abort') {
                      msg = 'Ajax request aborted.';
                  } else {
                      msg = 'Uncaught Error.\n' + jqXHR.responseText;
                  }
                  console.log(msg);
                }
            });
      });


  </script>

  </body>
</html>
