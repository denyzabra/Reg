<?php
$title = "Attendance";

include('model/authenticate.php'); // load authentication script to validate user is logged in
include('model/model_attendance.php'); // load and/or process DB data for Add/Edit Staff page
include('header.php'); // load DOCTYPE, <HEAD> content and opening <BODY> tag

?>
  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('images/bg_2.jpg');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-top justify-content-center">
          
          <div class="col-md-7 py-5">
            <?php  include('nav.php'); // load navigation ?>
        -> <a href="change_date.php">Change Date</a>
            <h3>Attendance for <?= $full_date ?></h3>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group first">
                    <h2>Class</h2>
                  </div>
                </div>
              </div>
 
 
 <?php
for($i = 0;$i < count($class_list);$i++) {
?>
              <div class="row">
                <div class="col-md-12">
              
                  <div class="form-group first">
                <a href="class_attendance.php?session_id=<?= $class_list[$i]['session_id'] ?>"><?= $class_list[$i]['session_name'] ?> - <?= $class_list[$i]['program_name'] ?> - <?= $class_list[$i]['class_name'] ?> </a>

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
