<?php // extra header content for AJAX in class_attendance.php
?>
<script>
function record_attendance(session_id,student_id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("attendance_text"+student_id).innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "recordattendance.php?session_id=" + session_id + "&student_id=" + student_id, true);
    xmlhttp.send();
}
</script>
<?php
?>