<?php // extra header content for AJAX in list_classes.php
?>
<script>

function get_classes(program_id){


   // Empty the dropdown
   var class_el = document.getElementById('class_id');
   
   class_el.innerHTML = "";
   
   var class_opt = document.createElement('option');
   class_opt.value = 0;
   class_opt.innerHTML = '--- Select Class ---';
   class_el.appendChild(class_opt);

   // AJAX request
   var xhttp = new XMLHttpRequest();
   xhttp.open("POST", "get_classes.php", true);
   xhttp.setRequestHeader("Content-Type", "application/json");
   xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         // Response
         var response = JSON.parse(this.responseText);

         var len = 0;
         if(response != null){
            len = response.length;
         }

         if(len > 0){
            // Read data and create <option >
            for(var i=0; i<len; i++){

               var id = response[i].id;
               var name = response[i].name;

               // Add option to class dropdown
               var opt = document.createElement('option');
               opt.value = id;
               opt.innerHTML = name;
               class_el.appendChild(opt);

            }
         }
      }
   };
   var data = {request:'get_classes',program_id: program_id};
   xhttp.send(JSON.stringify(data));

}

</script>
<?php
?>