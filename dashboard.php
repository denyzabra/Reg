<!--?php
$title = "Dashboard";

include('model/authenticate.php'); // load authentication script to validate user is logged in
include('model/model_dashboard.php'); // load and/or process DB data for Add/Edit Staff page
include('header.php'); // load DOCTYPE, <HEAD> content and opening <BODY> tag

?>
  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('images/bg_2.jpg');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-top justify-content-center">
          
          <div class="col-md-7 py-5">
            <h3>Dashboard - Welcome, <!--?= $_SESSION['f_name'] ?></h3>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group first">
                    <h2><a href="attendance.php">Attendance</a></h2>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group first">
                    <h2><a href="list_students.php">List Students</a></h2>
                  </div>
                </div>
                 <!--?php if (!empty($_SESSION['admin']) ) { ?>
                <div class="col-md-3">
                  <div class="form-group first">
                    <h2><a href="list_staff.php">List Staff</a></h2>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group first">
                    <h2><a href="list_classes.php">Setup Terms & Sessions</a></h2>
                  </div>
                </div>
                <!--?php } ?>
                <div class="col-md-3">
                  <div class="form-group first">
                    <h2><a href="logout.php">Logout</a></h2>
                  </div>
                </div>
              </div>
              
              
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
</html-->


<?php
$title = "Dashboard";

include('model/authenticate.php');
include('model/model_dashboard.php');
include('header.php');
?>

<style>
  /* Style for the menu items */
  .form-group h2 {
    color: #333;
    font-weight: 400;
    font-size: 24px;
    transition: all 0.3s ease;
  }
  /* Hover style for menu items */
  .form-group h2:hover {
    color: #f99c22;
  }
  /* Style for the background image */
  .bg {
    background-image: url('images/bg_2.jpg');
    background-position: center;
    background-size: cover;
    height: 100%;
  }
  /* Style for the container */
  .container {
    max-width: 960px;
    margin: 0 auto;
  }
  /* Style for the main content */
  .contents {
    position: relative;
    min-height: 100vh;
    padding: 0;
  }
  .py-5 {
    padding-top: 5rem !important;
    padding-bottom: 5rem !important;
  }
</style>

<div class="d-lg-flex half">
  <div class="bg order-1 order-md-2"></div>
  <div class="contents order-2 order-md-1">

    <div class="container">
      <div class="row align-items-top justify-content-center">

        <div class="col-md-7 py-5">
          <h3>Dashboard - Welcome, <?= $_SESSION['f_name'] ?></h3>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group first">
                <h2><a href="attendance.php">Attendance</a></h2>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group first">
                <h2><a href="list_students.php">List Students</a></h2>
              </div>
            </div>
             <?php if (!empty($_SESSION['admin']) ) { ?>
            <div class="col-md-3">
              <div class="form-group first">
                <h2><a href="list_staff.php">List Staff</a></h2>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group first">
                <h2><a href="list_classes.php">Setup Terms & Sessions</a></h2>
              </div>
            </div>
            <?php } ?>
            <div class="col-md-3">
              <div class="form-group first">
                <h2><a href="logout.php">Logout</a></h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>

