<?php
   include "action/db.php";
   ?>
<?php
   include "header.php";
   ?>
<?php

  $sql = "SELECT managecollege.id, college_name, administrator_name, email, password, address, name, course.id as course_id FROM managecollege inner join course on course.id = managecollege.course_id";
   $result = $conn->query($sql);
   $arr_users = [];
   
   $sql1="select * from course";
   $result1 = $conn->query($sql1);
   $arr_course = $result1->fetch_all(MYSQLI_ASSOC);
   
   ?>
<div class="container-fluid">
   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-header">
               <h4 class="card-title">Manage College</h4>
               <button type="button" class="btn btn-rounded btn-primary add-modal"  data-toggle="modal" data-target="#addModal"><span class="btn-icon-left text-primary"><i class="fa fa-plus color-primary"></i></span>Add</button>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table id="example3" class="display dataTable no-footer" aria-describedby="example3_info" style="min-width: 845px">
                     <thead>
                        <?php 
                           if($result->num_rows > 0)
                           {
                               $arr_users = $result->fetch_all(MYSQLI_ASSOC);
                           }
                           ?> 
                        <tr>
                           <th>Profile</th>
                           <th>College name</th>
                           <th>Administrator name</th>
                           <th>Course</th>
                           <th>Email</th>
                           <th>Password</th>
                           <th>Address</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if(!empty($arr_users)) { ?>
                        <?php foreach($arr_users as $r) { ?>
                        <tr>
                           <td><img class="rounded-circle" width="35" src="images/avatar/10.jpg" alt=""></td>
                           <td><?php echo $r['college_name'] ?></td>
                           <td><?php echo $r['administrator_name'] ?></td>
                           <td><?php echo $r['name'] ?></td>
                           <td><?php echo $r['email'] ?></td>
                           <td><?php echo $r['password'] ?></td>
                           <td><?php echo $r['address'] ?></td>
                           <td>
                              <div class="d-flex">
                                 <button type="button" class="btn btn-primary shadow btn-xs sharp mr-1 edit-modal" data-toggle="modal" data-id="<?= $r['id'] ?>" data-target="#editModal"><i class="fa fa-pencil"></i></button>
                                 <button type="button" class="btn btn-danger shadow btn-xs sharp mr-1 delete-modal" data-toggle="modal" data-id="<?= $r['id'] ?>" data-target="#deleteModal"><i class="fa fa-trash"></i></button>
                              </div>
                           </td>
                        </tr>
                        <?php } ?>
                        <?php } ?>
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
               <h5 class="modal-title">Add Course</h5>
               <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="name">College Name
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <input type="text" class="form-control" id="college_name" name="college_name" placeholder="Enter college name..">
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="name">Administrator Name
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <input type="text" class="form-control" id="administrator_name" name="administrator_name" placeholder="Enter administrator name..">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="course" class="col-lg-4 col-form-label" >Choose a course
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <select name="course_id" id="course_id" class="form-control">
                        <option value="">Select Course</option>
                        <?php foreach($arr_course as $value) { ?>
                        <option value="<?=$value['id']?>"><?php echo $value['name'] ?></option>
                        <?php } ?>
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="name">Email
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <input type="text" class="form-control" id="email" name="email" placeholder="Enter email..">
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="name">Password
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <input type="text" class="form-control" id="password" name="password" placeholder="Enter password..">
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="name">Address
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <textarea name="address" id="address" class="form-control" cols="20" rows="10" placeholder="Enter address.."></textarea>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                  <button type="submit" type="button" class="btn btn-primary">Save changes</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="modal fade" id="deleteModal">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Delete College</h5>
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
                    <h5 class="modal-title">Edit College</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="name">College Name
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="edit_college_name" name="name" placeholder="Enter a name..">
                        </div>
                    </div>
                    <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="name">Administrator Name
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <input type="text" class="form-control" id="edit_administrator_name" name="administrator_name" placeholder="Enter administrator name..">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="course" class="col-lg-4 col-form-label" >Choose a course
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <select name="course_id" id="edit_course_id" class="form-control">
                        <option value="">Select Course</option>
                        <?php foreach($arr_course as $value) { ?>
                        <option value="<?=$value['id']?>"><?php echo $value['name'] ?></option>
                        <?php } ?>
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="name">Email
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <input type="text" class="form-control" id="edit_email" name="email" placeholder="Enter email..">
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="name">Address
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <textarea name="address" id="edit_address" class="form-control" cols="20" rows="10" placeholder="Enter address.."></textarea>
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
       "college_name": {
           required: true,
       },
       "administrator_name": {
           required: true,
       },
       "course_id": {
           required: true, 
       },
       "email": {
           required: true,
           email: true
       },
       "password": {
           required: true, 
       },
       
       "address": {
           required: true, 
       },
   },
   messages: {
       "college_name": {
           required: "Please enter collegename",
       },
       "administrator_name": {        
           required: "Please enter administratorname",
       },
       "course_id": {        
           required: "Please select course",
       },
       "email": {
           required: "Please enter a email",
           email: "Please enter valid email"
       },
       "password":{
           required: "Please enter mobile number!",
       },
       "address":{
           required: "Please enter address!",
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
       console.log('Form submitted', college_name, administrator_name, email, name, password, address, course_id);
       
       var college_name = $("#college_name").val();
       var administrator_name = $("#administrator_name").val();
       var course_id = $("#course_id").val();
       var email = $("#email").val();
       var password = $("#password").val();
       var address = $("#address").val();
       
   
       $.ajax({
            type: "POST",
            url: "action/addcollege.php",
            dataType: "json",
            data: {college_name:college_name, administrator_name:administrator_name, course_id:course_id, email:email, password:password,address:address},                
            success : function(data){

               if (data){
                   $('#addModal').hide();
                   swal("Good job!", "Details updated successfully", "success");
                       setTimeout(function(){ 
                       window.location.href = "managecollege.php";
                   }, 2000);
               
               } else {
                $('#addModal').hide();
                   swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                       setTimeout(function(){ 
                       window.location.href = "managecollege.php";
                   }, 2000);
               }
           }
       }); 
   } 
   });
   $('.edit-modal').click(function(){
        var id=$(this).attr('data-id');
        $.ajax({
            type: "GET",
            url: "action/managefetchbyid.php",
            dataType: "json",
            data: {id:id},
            success : function(data){
                if (data){
                    $('#edit_id').val(data.id);
                    $('#edit_college_name').val(data.college_name);
                    $('#edit_administrator_name').val(data.administrator_name); 
                    $('#edit_course_id').val(data.course_id);
                    $('#edit_email').val(data.email);  
                    $('#edit_address').val(data.address);           
                } else {
                    swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                }
            }
        });
    });

    $('.delete-modal').click(function(){
       var id=$(this).attr('data-id');
       $.ajax({
           type: "GET",
           url: "action/managefetchbyid.php",
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
               url: "action/deletecollege.php",
               dataType: "json",
           data: {id:id},                
           success : function(data){
               if (data){
                   $('#deleteModal').hide();
                   swal("Good job!", "Details updated successfully", "success");
                       setTimeout(function(){ 
                       window.location.href = "managecollege.php";
                   }, 2000);
               
               } else {
                   swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                       setTimeout(function(){ 
                       window.location.href = "managecollege.php";
                   }, 2000);
               }
           }
       });
   });   
    $("#edit-form").validate({
    rules: {
        "edit_college_name": {
            required: true,
        },
        "edit_administrator_name": {
           required: true,
       },
       "edit_course_id": {
           required: true, 
       },
       "edit_email": {
           required: true,
           email: true
       },
       "edit_address": {
           required: true, 
       },
    },
    messages: {
        "edit_college_name": {
            required: "Please enter a college name",
        },
        "edit_administrator_name": {        
           required: "Please enter administratorname",
       },
       "edit_course_id": {        
           required: "Please select course",
       },
       "edit_email": {
           required: "Please enter a email",
           email: "Please enter valid email"
       },
       "edit_address":{
           required: "Please enter address!",
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

         var id = $('#edit_id').val();
         var college_name = $('#edit_college_name').val();
         var administrator_name = $('#edit_administrator_name').val(); 
         var course_id = $('#edit_course_id').val();
         var email = $('#edit_email').val();
         var address = $('#edit_address').val();

        $.ajax({
                type: "POST",
                url: "action/editcollege.php",
                dataType: "json",
                data: {id:id, college_name:college_name, administrator_name:administrator_name, course_id:course_id, email:email, address:address},                             
                success : function(data){
                if (data){
                    $('#editModal').hide();
                    swal("Good job!", "Details updated successfully", "success");
                        setTimeout(function(){ 
                        window.location.href = "managecollege.php";
                    }, 2000);
                
                } else {
                    swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                        setTimeout(function(){ 
                        window.location.href = "managecollege.php";
                    }, 2000);
                }
            }
        }); 
    } 
}); 

</script>