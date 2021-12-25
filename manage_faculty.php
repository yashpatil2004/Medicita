<?php
   include "action/databaseconn.php";
?>
<?php
   include "header.php";
?>
<?php
   $sql = "SELECT * FROM faculty";
   $result = $conn->query($sql);
   $arr_users = [];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Manage Faculty</h4>
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
                                    <th>Image</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Email</th>
                                    <th>Branch</th>
                                    <th>College</th>
                                    <th>Education</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($arr_users)) { ?>
                                <?php foreach($arr_users as $r) { ?>
                                <tr>
                                    <td><img class="rounded-circle" width="35" src="images/avatar/1.png" alt=""></td>
                                    <td><?php echo $r['first_name'] ?></td>
                                    <td><?php echo $r['last_name'] ?></td>
                                    <td><?php echo $r['email'] ?></td>
                                    <td><?php echo $r['branch'] ?></td>
                                    <td><?php echo $r['college'] ?></td>
                                    <td><?php echo $r['education'] ?></td>
                                    <td><?php echo $r['mobile_number'] ?></td>
                                    <td><?php echo $r['address'] ?></td>
                                    <td>
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-primary shadow btn-xs sharp mr-1 edit-modal" data-toggle="modal" data-id="<?= $r['id'] ?>" data-target="#editModal"><i class="fa fa-pencil"></i></button>
                                        <button type="button" class="btn btn-danger shadow btn-xs sharp mr-1 delete-modal" data-toggle="modal" data-id="<?= $r['id'] ?>" data-target="#deleteModal"><i class="fa fa-trash"></i></button>
                                    </div>
                                    </td>
                                </tr>
                                <?php }} ?>
                            </body>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
   include "footer.php";
?>
<div class="modal fade" id="addModal">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <form id="add-form" method="POST">
            <div class="modal-header">
               <h5 class="modal-title">Add Faculty</h5>
               <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="first_name">First_name
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <input type="text"  class="form-control" id="first_name" name="first_name" placeholder="Enter a First_name..">
                  </div>
               </div>
            </div>
            <div class="modal-body">
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="last_name">Last_name
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter a Last_name..">
                  </div>
               </div>
            </div>
            <div class="modal-body">
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="email">Email
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <input type="text" class="form-control" id="email" name="email" placeholder="Enter a Email..">
                  </div>
               </div>
            </div>
            <div class="modal-body">
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="branch">Branch
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <input type="text"  class="form-control" id="branch" name="branch" placeholder="Enter a Branch..">
                  </div>
               </div>
            </div>
            <div class="modal-body">
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="college">College
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <input type="text" class="form-control" id="college" name="college" placeholder="Enter a College..">
                  </div>
               </div>
            </div>
            <div class="modal-body">
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="education">Education
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <input type="text" class="form-control" id="education" name="education" placeholder="Enter a Education..">
                  </div>
               </div>
            </div>
            <div class="modal-body">
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="mobile_number">Mobile_number
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <input type="number" min="0" class="form-control" id="mobile_number" name="mobile_number" placeholder="Enter a Mobile_number..">
                  </div>
               </div>
            </div>
            <div class="modal-body">
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="address">Address
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <input type="text"  class="form-control" id="address" name="address" placeholder="Enter a Address..">
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
               <button type="submit" type="button" class="btn btn-primary">Add</button>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="modal fade" id="deleteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
           
                <div class="modal-header">
                    <h5 class="modal-title">Delete Faculty Details</h5>
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
                <h5 class="modal-title">Edit Faculty Details</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <input type="hidden" name="id" id="id">
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-firstname">First Name
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter a firstname..">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-lastname">Last Name
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter a lastname..">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-email">Email <span
                            class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Your valid email..">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-branch">Branch <span
                            class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="branch" name="branch" placeholder="Enter a branch..">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-college">College <span
                            class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="college" name="college" placeholder="Enter a college.">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-education">Education <span
                            class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="education" name="education" placeholder="Enter a Education..">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-phoneus">Mobile No
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6">
                        <input type="number" class="form-control" id="mobile_number" name="mobile_number" placeholder="212-999-0000">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-address">Address <span
                            class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter a address..">
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
<script>
    

    var table = $('#example3').DataTable();

    
    $('.edit-modal').click(function(){
        var id=$(this).attr('data-id');
        $.ajax({
            type: "GET",
            url: "action/facultyfetch_byid.php",
            dataType: "json",
            data: {id:id},
            success : function(data){
                if (data){
                    $('#id').val(data.id);
                    $('#first_name').val(data.first_name);
                    $('#last_name').val(data.last_name);
                    $('#email').val(data.email);
                    $('#branch').val(data.branch);
                    $('#college').val(data.college);
                    $('#education').val(data.education);
                    $('#mobile_number').val(data.mobile_number);
                    $('#address').val(data.address);              
                } else {
                    swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                }
            }
        });
    });
    

    $("#edit-form").validate({
    rules: {
        "first_name": {
            required: true,
        },
        "last_name": {
            required: true,
        },
        "email": {
            required: true,
            email: true
        },
        "branch": {
            required: true,
        },
        "college": {
            required: true,
        },
        "education": {
            required: true,
        },
        "mobile_number": {
            required: true,            
        },
        "address": {
            required: true, 
        },
    },
    messages: {
        "first_name": {
            required: "Please enter a firstname",
        },
        "last_name": {
            required: "Please enter a lastname",
        },
        "email": {
            required: "Please enter a email",
            email: "Please enter valid email"
        },
        "branch": {
            required: "Please enter a branch",
        },
        "college": {
            required: "Please enter a college",
        },
        "education": {
            required: "Please enter a education",
        },
        "mobile_number": {
            required: "Please enter a mobile_number",
        },
        "address":{
            required: "Please enter a address!",
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
        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var email = $("#email").val();
        var branch = $("#branch").val();
        var college = $("#college").val();
        var education = $("#education").val();
        var mobile_number = $("#mobile_number").val();
        var address = $("#address").val();

        $.ajax({
                type: "POST",
                url: "action/edit_faculty.php",
                dataType: "json",
            data: {id:id, first_name:first_name, last_name:last_name, email:email,branch:branch, college:college,  education:education,  mobile_number:mobile_number,  address:address },                
            success : function(data){
                if (data){
                    $('#editModal').hide();
                    swal("Good job!", "Details updated successfully", "success");
                        setTimeout(function(){ 
                        window.location.href = "manage_faculty.php";
                    }, 2000);
                
                } else {
                    swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                        setTimeout(function(){ 
                        window.location.href = "manage_faculty.php";
                    }, 2000);
                }
            }
        }); 
    } 
});

$('.add-modal').click(function(){
        var id=$(this).attr('data-id');
        $.ajax({
            type: "GET",
            url: "action/facultyfetch_byid.php",
            dataType: "json",
            data: {id:id},
            success : function(data){
                if (data){
                    $('#id').val(data.id);
                    $('#first_name').val(data.first_name);
                    $('#last_name').val(data.last_name);
                    $('#email').val(data.email);
                    $('#branch').val(data.branch);
                    $('#college').val(data.college);
                    $('#education').val(data.education);
                    $('#mobile_number').val(data.mobile_number);
                    $('#address').val(data.address);              
                } else {
                    swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                }
            }
        });
    });
    

    $("#add-form").validate({
    rules: {
        "first_name": {
            required: true,
        },
        "last_name": {
            required: true,
        },
        "email": {
            required: true,
            email: true
        },
        "branch": {
            required: true,
        },
        "college": {
            required: true,
        },
        "education": {
            required: true,
        },
        "mobile_number": {
            required: true,            
        },
        "address": {
            required: true, 
        },
    },
    messages: {
        "first_name": {
            required: "Please enter a firstname",
        },
        "last_name": {
            required: "Please enter a lastname",
        },
        "email": {
            required: "Please enter a email",
            email: "Please enter valid email"
        },
        "branch": {
            required: "Please enter a branch",
        },
        "college": {
            required: "Please enter a college",
        },
        "education": {
            required: "Please enter a education",
        },
        "mobile_number": {
            required: "Please enter a mobile_number",
        },
        "address":{
            required: "Please enter a address!",
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
        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var email = $("#email").val();
        var branch = $("#branch").val();
        var college = $("#college").val();
        var education = $("#education").val();
        var mobile_number = $("#mobile_number").val();
        var address = $("#address").val();

        $.ajax({
                type: "POST",
                url: "action/add_faculty.php",
                dataType: "json",
            data: {id:id, first_name:first_name, last_name:last_name, email:email,branch:branch, college:college,  education:education,  mobile_number:mobile_number,  address:address },                
            success : function(data){
                if (data){
                    $('#editModal').hide();
                    swal("Good job!", "Details updated successfully", "success");
                        setTimeout(function(){ 
                        window.location.href = "manage_faculty.php";
                    }, 2000);
                
                } else {
                    swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                        setTimeout(function(){ 
                        window.location.href = "manage_faculty.php";
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
            url: "action/facultyfetch_byid.php",
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
                url: "action/delete_faculty.php",
                dataType: "json",
            data: {id:id},                
            success : function(data){
                if (data){
                    $('#deleteModal').hide();
                    swal("Good job!", "Details updated successfully", "success");
                        setTimeout(function(){ 
                        window.location.href = "manage_faculty.php";
                    }, 2000);
                
                } else {
                    swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                        setTimeout(function(){ 
                        window.location.href = "manage_faculty.php";
                    }, 2000);
                }
            }
        });
    });
</script>