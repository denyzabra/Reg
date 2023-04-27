<?php
$title = "Add/Edit Student";

include('model/authenticate.php'); // load authentication script to validate user is logged in
include('model/model_addedit_student.php'); // load and/or process DB data for Add/Edit Student page
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
            elseif (isset($update_failed)) { ?><p style="background-color:red;color:white;font-weight:bold">Update failed. Please check correct field formats.</p><?php } ?>
            
            <?php if (isset($photo_err)) { ?><p style="background-color:red;color:white;font-weight:bold"><?= $photo_err ?></p><?php } ?>

            <form action="addedit_student.php<?php if($student['student_id'] > 0 ) echo "?student_id=" . $student['student_id'] ?>" enctype="multipart/form-data" method="post">
              
              <?php if($student['student_id'] > 0 ) { ?><input type="hidden" name="student_id" value="<?= $student['student_id'] ?>"><?php } ?>
              
              <?php if($student['entry_year'] > 0 ) { ?><input type="hidden" name="entry_year" value="<?= $student['entry_year'] ?>"><?php } ?>
              
              <?php if($student['student_num'] > 0 ) { ?><input type="hidden" name="student_num" value="<?= $student['student_num'] ?>"><?php } ?>
              
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <h3>Add/Edit Student</h3>
            <p class="mb-4">Student information form - Part A</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group first justify-content-center">
                    <?php if(strlen($student['photo'])>0) { ?><a href="<?= $photos_folder . $student['photo'] ?>">
                    <div  style="display: inline-block;width: 150px;height: 150px;border-radius: 50%;background-repeat: no-repeat;background-position: center center;background-size: cover;background-image: url('<?= $photos_folder . $student['photo'] ?>');" onclick="record_attendance(<?= $student_list[$i]['session_id'] ?>,<?= $student_list[$i]['student_id'] ?>)">
                      
                    </div>
                    </a> <?php } ?>
                    
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="student_num">Student Number</label><br>
                    <?php if($student['student_id'] > 0 ) echo "<h1>" . $student_num_prefix . $student['entry_year'] . "-" . sprintf('%03d', $student['student_num']) . "</h1>";
                    else echo "<em>To be assigned</em>"; ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="photo">Photo</label>
                    <input type="file" class="form-control" id="photo" name="photo" value="<?= $student['photo'] ?>">
                    
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="f_name">First Name</label>
                    <input type="text" class="form-control" placeholder="e.g. John" id="f_name" name="f_name" value="<?= $student['f_name'] ?>">
                    
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="l_name">Last Name</label>
                    <input type="text" class="form-control" placeholder="e.g. Smith" id="l_name" name="l_name" value="<?= $student['l_name'] ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group first">
                    <label for="contact">Contact</label>
                    <input type="text" class="form-control" placeholder="e.g. 744 910 266" id="contact" name="contact" value="<?= $student['contact'] ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="kin_name">Next of Kin:</label>
                   <input type="text" id="kin_name" name="kin_name" class="form-control" placeholder="e.g. Sally Jones" value="<?= $student['kin_name'] ?>">
                    
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="kin_contact">Kin Contact:</label>
                    <input type="text" id="kin_contact" name="kin_contact" class="form-control" placeholder="e.g. 700 882 114" value="<?= $student['kin_contact'] ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="dob">Date of Birth:</label>
                    <input type="text" id="dob" name="dob" class="form-control" placeholder="e.g. 1980-03-26" value="<?= $student['dob'] ?>">
                    
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="age">Age:</label>
                    <input type="text" id="age" name="age" class="form-control" placeholder="e.g. 42" value="<?= $student['age'] ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group first">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" placeholder="e.g. john@your-domain.com" id="email" name="email" value="<?= $student['email'] ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="residence">Residence:</label>
                    <input type="text" id="residence" name="residence" class="form-control" placeholder="e.g. Kisenyi" value="<?= $student['residence'] ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="workplace">Workplace:</label>
                    <input type="text" id="workplace" name="workplace" class="form-control" placeholder="e.g. Restaurant"  value="<?= $student['workplace'] ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
              
                  <div class="form-group first">
                    
Gender:<br>
<?php
for($i = 0;$i < count($gender_dd);$i++) {
?>
  <input type="radio" id="<?= $gender_dd[$i]['gender'] ?>" name="gender_id" value="<?= $gender_dd[$i]['gender_id'] ?>" <?php if($student['gender_id']==$gender_dd[$i]['gender_id']) echo "checked" ?> >
  <label for="<?= $gender_dd[$i]['gender'] ?>"><?= $gender_dd[$i]['gender'] ?></label><br>
<?php
  }
?>
                  </div>
                </div>

                <div class="col-md-6">
              
                  <div class="form-group first">
                    
Marital Status:<br>
<?php
for($i = 0;$i < count($marital_status_dd);$i++) {
?>
  <input type="radio" id="<?= $marital_status_dd[$i]['marital_status'] ?>" name="marital_id" value="<?= $marital_status_dd[$i]['marital_id'] ?>" <?php if($student['marital_id']==$marital_status_dd[$i]['marital_id']) echo "checked" ?> >
  <label for="<?= $marital_status_dd[$i]['marital_status'] ?>"><?= $marital_status_dd[$i]['marital_status'] ?></label><br>
<?php
  }
?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <label class="control control--checkbox mb-0" for="children">
                  <span>Do you have children?</span>
                  <input type="checkbox" id="children" name="children" value="1" <?php if($student['children']=='1') echo "checked" ?> >
                  <div class="control__indicator"></div></label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="num_children">Number of Children?</label>
                    <input type="text" id="num_children" name="num_children" class="form-control" placeholder="e.g. 4"  value="<?= $student['num_children'] ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group first">
                    <label for="health_issues">Health Issues:</label>
                    <input type="text" id="health_issues" name="health_issues" class="form-control" value="<?= $student['health_issues'] ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group first">
                    <label for="notes">Notes:</label><br>
                    <textarea id="notes" class="form-control" name="notes" rows="4" cols="50"><?= $student['notes'] ?>
                    </textarea>
                  </div>
                </div>
              </div>
               <div class="row">
                <div class="col-md-12">
                  <div class="form-group first">
                    <h3>Programs:</h3>
                    <?php
                  for($i = 0;$i < count($program_checkboxes);$i++) {
                    ?>
                  <label class="control control--checkbox mb-0" for="program_<?= $program_checkboxes[$i]['program_id'] ?>">
                  <span><?= $program_checkboxes[$i]['program_name'] ?></span>
                  <input type="checkbox" id="program_<?= $program_checkboxes[$i]['program_id'] ?>" name="program_<?= $program_checkboxes[$i]['program_id'] ?>" value="1" <?php if(!empty($student['program_'.$program_checkboxes[$i]['program_id']])) echo "checked" ?> ><br><br>
                  <div class="control__indicator"></div></label>
                  <?php
                  }
                  ?>
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
