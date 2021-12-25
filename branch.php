<?php
   include "action/db.php";
   ?>
<?php
   include "header.php";
   ?>
<?php
   $sql = "SELECT branch.id, branch,name, course.id as course_id  FROM branch inner join course on course.id = branch.course_id";
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
               <h4 class="card-title">Branch</h4>
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
                           <th>Course</th>
                           <th>Branch</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if(!empty($arr_users)) { ?>
                        <?php foreach($arr_users as $r) { ?>
                        <tr>
                           <td><?php echo $r['name'] ?></td>
                           <td><?php echo $r['branch'] ?></td>
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
               <h5 class="modal-title">Add Branch</h5>
               <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
               </button>
            </div>
            <div class="modal-body">
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
                  <label class="col-lg-4 col-form-label" for="name">Branch
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <input type="text" class="form-control" id="branch" name="branch" placeholder="Enter a branch..">
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

<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="edit-form" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Branch</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
               <div class="modal-body">
               <input type="hidden" name="id" id="edit_id">
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
                  <label class="col-lg-4 col-form-label" for="name">Branch
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <input type="text" class="form-control" id="edit_branch" name="branch" placeholder="Enter a branch..">
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
                <h5 class="modal-title">Delete course</h5>
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
<?php
   include "footer.php";
   ?>
<script>
   var table = $('#example3').DataTable();
   
   $("#add-form").validate({
   rules: {
       "branch": {
           required: true,
       },
       "course_id": {
          required: true, 
      },
   },
   messages: {
       "branch": {
           required: "Please enter a branch",
       },
       "course_id": {        
          required: "Please select course",
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
   
      var name = $("#branch").val();
      var course_id = $("#course_id").val();

       console.log('Form submitted',name,course_id);

       $.ajax({
               type: "POST",
               url: "action/addbranch.php",
               dataType: "json",
               data: {branch:name,course_id:course_id},                
               success : function(data){
               if (data){
                   $('#addModal').hide();
                   swal("Good job!", "Details updated successfully", "success");
                   
                   setTimeout(function(){ 
                       window.location.href = "branch.php";
                   }, 2000);
               } else {
                   $('#addModal').hide();
   
                   swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                    setTimeout(function(){ 
                       window.location.href = "branch.php";
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
            url: "action/branchfetchbyid.php",
            dataType: "json",
            data: {id:id},
            success : function(data){
                if (data){
                    $('#edit_id').val(data.id);
                    $('#edit_course_id').val(data.course_id);
                    $('#edit_branch').val(data.branch);         
                } else {
                    swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                }
            }
        });
    });
   $("#edit-form").validate({
    rules: {
        "edit_course_id": {
           required: true,
       },
       "edit_branch": {
            required: true,
        },
    },
    messages: {
        "edit_course_id": {        
           required: "Please enter course",
       },
       "edit_branch": {
            required: "Please enter a branch",
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
         var course_id = $('#edit_course_id').val();
         var name = $('#edit_branch').val(); 
         
        $.ajax({
                type: "POST",
                url: "action/editbranch.php",
                dataType: "json",
                data: {id:id,branch:name,course_id:course_id},                             
                success : function(data){
                if (data){
                    $('#editModal').hide();
                    swal("Good job!", "Details updated successfully", "success");
                        setTimeout(function(){ 
                        window.location.href = "branch.php";
                    }, 2000);
                
                } else {
                    swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                        setTimeout(function(){ 
                        window.location.href = "branch.php";
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
            url: "action/branchfetchbyid.php",
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
                url: "action/deletebranch.php",
                dataType: "json",
            data: {id:id},                
            success : function(data){
                if (data){
                    $('#deleteModal').hide();
                    swal("Good job!", "Details updated successfully", "success");
                        setTimeout(function(){ 
                        window.location.href = "branch.php";
                    }, 2000);
                
                } else {
                    swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                        setTimeout(function(){ 
                        window.location.href = "branch.php";
                    }, 2000);
                }
            }
        });
    });
</script>