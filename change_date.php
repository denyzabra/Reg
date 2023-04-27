<?php
$title = "Attendance";

include('model/authenticate.php'); // load authentication script to validate user is logged in
include('model/model_change_date.php'); // load and/or process DB data for Add/Edit Staff page
include('header.php'); // load DOCTYPE, <HEAD> content and opening <BODY> tag

?>
  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('images/bg_2.jpg');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-top justify-content-center">
          
          <div class="col-md-7 py-5">
            <?php  include('nav.php'); // load navigation ?>
            <h3>Change Date for Attendance</h3>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group first">
                    <h2>Current Attendance Date: <?= $full_date ?></h2>
                  </div>
                </div>
              </div>
              
          <form action="change_date.php" method="post">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group first">
            <label for="new_date">Change Attendance Date to:</label> <input type="date" name="new_date" id="new_date" value="<?php echo $current_date ?>" />

                  </div>
                </div>
              </div>
                <input type="submit" value="Change Attendance Date" name="submit" class="btn px-5 btn-primary">
              </form>
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
