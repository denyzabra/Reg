<?php
$title = "Setup Terms & Sessions";

include('model/authenticate.php'); // load authentication script to validate user is logged in
include('model/model_list_classes.php'); // load and/or process DB data for List Classes page
include('model/dropdowns.php'); // load and/or process DB data for List Classes page
$extra_header = "model/header_list_classes.php"; // extra header content for AJAX on class_attendance.php page
include('header.php'); // load DOCTYPE, <HEAD> content and opening <BODY> tag

?>
  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('images/bg_2.jpg');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-top justify-content-center">
          
          <div class="col-md-7 py-5">
            <?php  include('nav.php'); // load navigation
            if (!empty($term_selected)) echo " -> <a href='list_classes.php?term_id=" . $term_id ."'>Term: " . $term_selected['term_name'] . "</a>";
            ?>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group first">
                    <h2>Setup Terms & Sessions</h2>
                  </div>
                </div>
              </div>
 
 
 <?php
 
if (!empty($term_selected)) { // a term has been selected so display the term name ?>

<h3>Selected Term: <?= $term_selected['term_name'] ?></h3>

<?php
}
else {
for($i = 0;$i < count($terms);$i++) {
?>
              <div class="row">
                <div class="col-md-12">
              
                  <div class="form-group first">
                <strong><a href="list_classes.php?term_id=<?= $terms[$i]['term_id'] ?>">TERM <?= $terms[$i]['term_name'] ?></a></strong> (<?= $terms[$i]['start_date'] ?> - <?= $terms[$i]['end_date'] ?>)

                  </div>
                </div>

              </div>
  <?php
  } // end for loop listing terms
  
} // end if no term has been selected
?>

 <?php
 
if (!empty($session_selected)) { // a term has been selected so display the term name ?>

<h3>Selected Session: <?= $session_selected['program_name'] ?> - <?= $session_selected['session_name'] ?> <?= $session_selected['class_name'] ?></h3>

<form action="list_classes.php" method="post">

<input type="hidden" name="term_id" id="term_id" value="<?= $term_id ?>">
<input type="hidden" name="session_id" id="session_id" value="<?= $session_selected['session_id'] ?>">
<input type="hidden" name="delete_session" id="delete_session" value="1" >
<input type="submit" value="Delete this Session" name="submit" class="btn px-5 btn-primary" onclick="confirm('Are you sure you want to delete this session?')">

</form>

<?php
}
else {
for($i = 0;$i < count($sessions);$i++) {
?>
              <div class="row">
                <div class="col-md-12">
              
                  <div class="form-group first">
                <strong><a href="list_classes.php?term_id=<?= $term_selected['term_id'] ?>&session_id=<?= $sessions[$i]['session_id'] ?>"><?= $sessions[$i]['program_name'] ?> - <?= $sessions[$i]['session_name'] ?> <?= $sessions[$i]['class_name'] ?></a></strong>

                  </div>
                </div>

              </div>
              
              
              
  <?php
  } // end for loop listing sessions
  
 ?>
  
  
  
<?php
} // end if no session has been selected
?>



<?php if (!empty($term_id) && empty($session_id)) {
?>
                
              <div class="row">
                <div class="col-md-12">
              
                  <div class="form-group first">
                <h3>Add New Session:</h3>
<form action="list_classes.php" method="post">

<input type="hidden" name="term_id" id="term_id" value="<?= $term_id ?>">
  
<label for="staff_id">Staff: </label><select name="staff_id" id="staff_id" >
  <option value="0">--- Select Staff ---</option>
                <?php
                for($i = 0;$i < count($staff_dd);$i++) {
?>
                  <option value="<?= $staff_dd[$i]['staff_id'] ?>"><?= $staff_dd[$i]['f_name'] ?> <?= $staff_dd[$i]['l_name'] ?></option>
  <?php
  } // end for loop listing programs
  
                ?>
</select><br>
  
<label for="program_id">Program: </label><select name="program_id" id="program_id" onchange="get_classes(this.value);">
  <option value="0">--- Select Program ---</option>
                <?php
                for($i = 0;$i < count($program_checkboxes);$i++) {
?>
                  <option value="<?= $program_checkboxes[$i]['program_id'] ?>"><?= $program_checkboxes[$i]['program_name'] ?></option>
  <?php
  } // end for loop listing programs
  
                ?>

</select><br>
<label for="class_id">Class: </label><select id="class_id" name="class_id"  >
            <option value="0" >--- Select Class ---</option>
         </select><br>

      <label for="session_name">Session Name: </label><input type="text" id="session_name" name="session_name" placeholder="ie. 10:30AM" value="" ><br>
<input type="hidden" name="new_session" id="new_session" value="1" >

              <input type="submit" value="Add Session" name="submit" class="btn px-5 btn-primary">

</form>
                  </div>
                </div>

              </div>
  <?php
} // end if a term is selected
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
