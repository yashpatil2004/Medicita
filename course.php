<?php
   include "action/db.php";
?>
<?php
   include "header.php";
?>
<?php
   $sql = "SELECT * FROM course";
   $result = $conn->query($sql);
   $arr_users = [];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Course</h4>
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
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($arr_users)) { ?>
                                <?php foreach($arr_users as $r) { ?>
                                <tr>
                                    <td><?php echo $r['name'] ?></td>
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
                <h5 class="modal-title">Add Course</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="name">Name
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter a name..">
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
                        <label class="col-lg-4 col-form-label" for="name">Name
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="edit_name" name="name" placeholder="Enter a name..">
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
        "name": {
            required: true,
        },
    },
    messages: {
        "name": {
            required: "Please enter a name",
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
        var name = $("#name").val();

        $.ajax({
                type: "POST",
                url: "action/addcourse.php",
                dataType: "json",
            data: {id:id, name:name},                
            success : function(data){
                if (data){
                    $('#addModal').hide();
                    swal("Good job!", "Details updated successfully", "success");
                    
                    setTimeout(function(){ 
                        window.location.href = "course.php";
                    }, 2000);
                
                } else {
                    $('#addModal').hide();

                    swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                     setTimeout(function(){ 
                        window.location.href = "course.php";
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
            url: "action/coursefetchbyid.php",
            dataType: "json",
            data: {id:id},
            success : function(data){
                if (data){
                    $('#edit_id').val(data.id);
                    $('#edit_name').val(data.name);               
                } else {
                    swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                }
            }
        });
    });

    $("#edit-form").validate({
    rules: {
        "name": {
            required: true,
        },
    },
    messages: {
        "name": {
            required: "Please enter a firstname",
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
        var name = $("#edit_name").val();

        $.ajax({
                type: "POST",
                url: "action/editcourse.php",
                dataType: "json",
            data: {id:id, name:name},                
            success : function(data){
                if (data){
                    $('#editModal').hide();
                    swal("Good job!", "Details updated successfully", "success");
                        setTimeout(function(){ 
                        window.location.href = "course.php";
                    }, 2000);
                
                } else {
                    swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                        setTimeout(function(){ 
                        window.location.href = "course.php";
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
            url: "action/coursefetchbyid.php",
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
                url: "action/deletecourse.php",
                dataType: "json",
            data: {id:id},                
            success : function(data){
                if (data){
                    $('#deleteModal').hide();
                    swal("Good job!", "Details updated successfully", "success");
                        setTimeout(function(){ 
                        window.location.href = "course.php";
                    }, 2000);
                
                } else {
                    swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                        setTimeout(function(){ 
                        window.location.href = "course.php";
                    }, 2000);
                }
            }
        });
    });
</script>