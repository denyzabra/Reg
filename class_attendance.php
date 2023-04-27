<?php
$title = "Attendance";

include('model/authenticate.php'); // load authentication script to validate user is logged in
include('model/model_class_attendance.php'); // load and/or process DB data for Add/Edit Staff page
$extra_header = "model/header_class_attendance.php"; // extra header content for AJAX on class_attendance.php page
include('header.php'); // load DOCTYPE, <HEAD> content and opening <BODY> tag

?>
  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('images/bg_2.jpg');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-top justify-content-center">
          
          <div class="col-md-7 py-5">
            <?php  include('nav.php'); // load navigation ?>
            <h3><?= $class_list[0]['session_name'] ?> - <?= $class_list[0]['program_name'] ?> - <?= $class_list[0]['class_name'] ?><br>
            Attendance for <?= $full_date ?></h3>
               <div class="row">
                <div class="col-md-3">
                  <div class="form-group first">
                    <h2>Photo</h2>
                    </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group first">
                    <h2>Name</h2>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group first">
                    <h2>Contact</h2>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group first">
                    <h2>Email</h2>
                  </div>
                </div>
              </div>
 
 
 <?php
for($i = 0;$i < count($student_list);$i++) {
 
?>
              <div class="row">
                <div class="col-md-3">
              
                    

                  <div class="form-group first justify-content-center">
                    <?php if(strlen($student_list[$i]['photo'])>0) { ?>
                    <div  style="display: inline-block;width: 100px;height: 100px;border-radius: 50%;background-repeat: no-repeat;background-position: center center;background-size: cover;background-image: url('<?= $photos_folder . $student_list[$i]['photo'] ?>');" onclick="record_attendance(<?= $student_list[$i]['session_id'] ?>,<?= $student_list[$i]['student_id'] ?>)">
                      
                    </div>

                    <?php } ?>
                    </div>
                  
                </div>

                <div class="col-md-3">
              
                  <div class="form-group first">
                <?= $student_list[$i]['f_name'] ?> <?= $student_list[$i]['l_name'] ?><br>
                <span id="attendance_text<?= $student_list[$i]['student_id'] ?>"><?php if(strlen($student_list[$i]['attendance_date'])>0) { ?><div style="background-color:green;color:white;font-weight:bold;text-align:center;border-radius:5%" onclick="record_attendance(<?= $student_list[$i]['session_id'] ?>,<?= $student_list[$i]['student_id'] ?>)">Present</div><?php }
                else { ?><div style="background-color:red;color:white;font-weight:bold;text-align:center;border-radius:5%" onclick="record_attendance(<?= $student_list[$i]['session_id'] ?>,<?= $student_list[$i]['student_id'] ?>)">Absent</div>
                <?php } ?></span>

                  </div>
                </div>
                <div class="col-md-3">
              
                  <div class="form-group first">
                    

  <?= $student_list[$i]['contact'] ?>

                  </div>
                </div>

                <div class="col-md-3">
              
                  <div class="form-group first">
                <?= $student_list[$i]['email'] ?>

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
