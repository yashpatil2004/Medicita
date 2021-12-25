<?php
   include "action/databaseconn.php";
   ?>
<?php
   include "header.php";
   ?>
<?php
   $sql = "SELECT * FROM semester";
   $result = $conn->query($sql);
   $arr_users = [];
?>
<div class="container-fluid">
   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-header">
               <h4 class="card-title">Semester</h4>
               <button type="button" class="btn btn-rounded btn-primary add-modal"  data-toggle="modal" data-target="#addModal"><span class="btn-icon-left text-primary"><i class="fa fa-plus color-primary"></i></span>Add</button>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table id="example3" class="display" style="min-width: 845px">
                     <?php 
                        if($result->num_rows > 0)
                            {
                                $arr_users = $result->fetch_all(MYSQLI_ASSOC);
                            }
                        ?>
                     <thead>
                        <tr>
                           <th>Semester</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if(!empty($arr_users)) { ?>
                        <?php foreach($arr_users as $r) { ?>
                        <tr>
                           <td><?php echo $r['semester'] ?></td>
                           <td>
                              <div class="d-flex">
                                 <button type="button" class="btn btn-primary shadow btn-xs sharp mr-1 edit-modal" data-toggle="modal" data-id="<?= $r['id'] ?>" data-target="#editModal"><i class="fa fa-pencil"></i></button>
                                 <button type="button" class="btn btn-danger shadow btn-xs sharp mr-1 delete-modal" data-toggle="modal" data-id="<?= $r['id'] ?>" data-target="#deleteModal"><i class="fa fa-trash"></i></button>
                              </div>
                           </td>
                        </tr>
                        <?php }} ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="addModal">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <form id="add-form" method="POST">
            <div class="modal-header">
               <h5 class="modal-title">Add Semester</h5>
               <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="semester">Semester
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <input type="number" min="0" class="form-control" id="semester" name="semester" placeholder="Enter a Semester..">
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
               <button type="submit" type="button" class="btn btn-primary">Save changes</button>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="modal fade" id="deleteModal">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Delete Semester</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <input type="hidden" name="id" id="id">
            <center>Are you sure ?</center>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger light delete-data">Delete</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="editModal">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <form id="edit-form" method="POST">
            <div class="modal-header">
               <h5 class="modal-title">Edit course</h5>
               <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
               <input type="hidden" name="id" id="edit_id">
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="semester">Semester
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <input type="number" class="form-control" id="edit_semester" name="semester" placeholder="Enter a semester.." min = 0 >
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
               <button type="submit" type="button" class="btn btn-primary">Save changes</button>
            </div>
         </form>
      </div>
   </div>
</div>
<?php
   include "footer.php";
   ?>
<script>
   var table = $('#example3').DataTable();
   
   $("#add-form").validate({
   rules: {
       "semester": {
           required: true,
       },
   },
   messages: {
       "semester": {
           required: "Please enter a semester",
       }
   },
   ignore: [],
   errorClass: "invalid-feedback animated fadeInUp",
   errorElement: "div",
   errorPlacement: function(e, a) {
       jQuery(a).parents(".form-group > div").append(e)
   },
   highlight: function(e) {
       jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
   },
   success: function(e) {
       jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
   },  
   submitHandler: function(form,e) {
       e.preventDefault();
       console.log('Form submitted');
       
       var id = $("#id").val();
       var semester = $("#semester").val();
   
       
   $.ajax({
       type: "POST",
       url: "action/add_semester.php",
       dataType: "json",
       data: {semester:semester},                
       success : function(data){
           if (data){
                toastr.error("Semester Added Succesfully", "", {
                timeOut: 2000,
                closeButton: !0,
                debug: !1,
                newestOnTop: !0,
                progressBar: !0,
                positionClass: "toast-top-right",
                preventDuplicates: !0,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                tapToDismiss: !1,
            })
           }
           else {
               toastr.error("Error", "Top Right", {
               positionClass: "toast-top-right",
               timeOut: 5e3,
               closeButton: !0,
               debug: !1,
               newestOnTop: !0,
               progressBar: !0,
               preventDuplicates: !0,
               onclick: null,
               showDuration: "300",
               hideDuration: "1000",
               extendedTimeOut: "1000",
               showEasing: "swing",
               hideEasing: "linear",
               showMethod: "fadeIn",
               hideMethod: "fadeOut",
               tapToDismiss: !1
           })
           }
           setTimeout(function(){ 
                            window.location.href = "manage_semester.php";
                        }, 2000);
       }
   });
   }
   })
   $('.edit-modal').click(function(){
       var id=$(this).attr('data-id');
       $.ajax({
           type: "GET",
           url: "action/semesterfetch_byid.php",
           dataType: "json",
           data: {id:id},
           success : function(data){
               if (data){
                   $('#edit_id').val(data.id);
                   $('#edit_semester').val(data.semester);               
               } else {
                   swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
               }
           }
       });
   });
   
   $("#edit-form").validate( {
   rules: {
       "semester": {
           required: true,
       },
   },
   messages: {
       "semester": {
           required: "Please enter a semester",
       }
   },
   ignore: [],
   errorClass: "invalid-feedback animated fadeInUp",
   errorElement: "div",
   errorPlacement: function(e, a) {
       jQuery(a).parents(".form-group > div").append(e)
   },
   highlight: function(e) {
       jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
   },
   success: function(e) {
       jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
   },  
   submitHandler: function(form,e) {
       e.preventDefault();
       console.log('Form submitted');
       
       var id = $("#edit_id").val();
       var semester = $("#edit_semester").val();
   
       $.ajax({
           type: "POST",
           url: "action/edit_semester.php",
           dataType: "json",
           data: {id:id, semester:semester},                
           success : function(data){
               if (data){
                   $('#editModal').hide();
                   swal("Good job!", "Details updated successfully", "success");
                       setTimeout(function(){ 
                       window.location.href = "manage_semester.php";
                   }, 2000);
               
               } else {
                   swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                       setTimeout(function(){ 
                       window.location.href = "manage_semester.php";
                   }, 2000);
               }
           }
       });
   } 
   });
   
   $('.delete-modal').click(function(){
       var id=$(this).attr('data-id');
       $.ajax({
           type: "GET",
           url: "action/semesterfetch_byid.php",
           dataType: "json",
           data: {id:id},
           success : function(data){
               if (data){
                   $('#id').val(data.id);               
               } else {
                   swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
               }
           }
       });
   });
   $( ".delete-data" ).click(function() {
       var id = $("#id").val();
       $.ajax({
               type: "POST",
               url: "action/delete_semester.php",
               dataType: "json",
           data: {id:id},                
           success : function(data){
               if (data){
                   $('#deleteModal').hide();
                   swal("Good job!", "Details updated successfully", "success");
                       setTimeout(function(){ 
                       window.location.href = "manage_semester.php";
                   }, 2000);
               
               } else {
                   swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                       setTimeout(function(){ 
                       window.location.href = "manage_semester.php";
                   }, 2000);
               }
           }
       });
   });
</script>