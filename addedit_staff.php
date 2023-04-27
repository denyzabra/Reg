<?php
$title = "Add/Edit Staff";

include('model/authenticate.php'); // load authentication script to validate user is logged in
include('model/authenticate_admin.php'); // load authentication script to validate admin user is logged in
include('model/model_addedit_staff.php'); // load and/or process DB data for Add/Edit Staff page
include('header.php'); // load DOCTYPE, <HEAD> content and opening <BODY> tag

?>
  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('images/bg_2.jpg');"></div>
    
    <div class="contents order-2 order-md-1">
      <div class="container">
        <div class="row align-items-top justify-content-center">
          <div class="col-md-7 py-5">
            <?php  include('nav.php'); // load navigation ?>
            <?php if (isset($update_success) || isset($insert_success)) { ?><p style="background-color:green;color:white;font-weight:bold"">Record updated successfully.</p><?php }
            elseif (isset($update_failed) || isset($insert_failed)) { ?><p style="background-color:red;color:white;font-weight:bold">Update failed. Please check that all fields are completed.</p><?php } ?>
            
            <?php if (isset($photo_err)) { ?><p style="background-color:red;color:white;font-weight:bold"><?= $photo_err ?></p><?php } ?>

            <form action="addedit_staff.php<?php if($staff['staff_id'] > 0 ) echo "?staff_id=" . $staff['staff_id'] ?>" enctype="multipart/form-data" method="post">
              
              <?php if(!empty($staff['staff_id']) ) { ?><input type="hidden" name="staff_id" value="<?= $staff['staff_id'] ?>"><?php } ?>
              
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <h3>Add/Edit Staff</h3>
            <p class="mb-4">Staff Profile</p>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="f_name">First Name</label>
                    <input type="text" class="form-control" placeholder="e.g. John" id="f_name" name="f_name" value="<?= $staff['f_name'] ?>">
                    
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="l_name">Last Name</label>
                    <input type="text" class="form-control" placeholder="e.g. Smith" id="l_name" name="l_name" value="<?= $staff['l_name'] ?>">
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group first">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" placeholder="e.g. john@your-domain.com" id="email" name="email" value="<?= $staff['email'] ?>">
                  </div>
                </div>
              </div>
             
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group first">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" >
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <label class="control control--checkbox mb-0" for="admin">
                  <span>Is this an admin user?</span>
                  <input type="checkbox" id="admin" name="admin" value="1" <?php if($staff['admin']=='1') echo "checked" ?> >
                  <div class="control__indicator"></div></label>
                  </div>
                </div>
              </div>

              <input type="submit" value="Save" name="submit" class="btn px-5 btn-primary">

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
