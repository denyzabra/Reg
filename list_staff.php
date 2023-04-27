<?php
$title = "Staff List";

include('model/authenticate.php'); // load authentication script to validate user is logged in
include('model/authenticate_admin.php'); // load authentication script to validate admin user is logged in
include('model/model_list_staff.php'); // load and/or process DB data for Add/Edit Staff page
include('header.php'); // load DOCTYPE, <HEAD> content and opening <BODY> tag

?>
  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('images/bg_2.jpg');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-top justify-content-center">
          
          <div class="col-md-7 py-5">
            <?php  include('nav.php'); // load navigation ?>
        -> <a href="addedit_staff.php">Add New Staff</a>
            <h3>List Staff</h3>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group first">
                    <h2>Name</h2>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group first">
                    <h2>Email</h2>
                  </div>
                </div>
              </div>
 
 
 <?php
for($i = 0;$i < count($staff_list);$i++) {
?>
              <div class="row">
                <div class="col-md-3">
              
                  <div class="form-group first">
                <a href="addedit_staff.php?staff_id=<?= $staff_list[$i]['staff_id'] ?>"><?= $staff_list[$i]['f_name'] ?> <?= $staff_list[$i]['l_name'] ?></a>

                  </div>
                </div>

                <div class="col-md-3">
              
                  <div class="form-group first">
                <?= $staff_list[$i]['email'] ?>

                  </div>
                </div>
              </div>
  <?php
  }
?>
              
              
          </div>
        </div>
      </div>
    </div>

    
  </div>
      
    
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
