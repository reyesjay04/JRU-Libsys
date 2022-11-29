<?php include '../templates/user-header.php'?>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> Student Information Screen </h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Fill up all required fields</h3>
                    </div>
                    <form method="POST" action="actions/?configuser"  enctype="multipart/form-data">
                        <div class="card-body">           
                            <input type="hidden" name="oauth_uid" value="<?php echo $_SESSION['USER_AUTHID']?>" required>
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" value="<?php echo $_SESSION['USER_FIRST']?>" required>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" value="<?php echo $_SESSION['USER_LAST']?>" required>
                            </div>
                            <div class="form-group">
                                <label for="student_no">Student No.</label>
                                <input type="text" class="form-control" id="student_no" name="student_no" placeholder="Enter Student No." required>
                            </div>
                            <div class="form-group">
                                <label for="dept">Department</label>
                                <select class="form-control" id="dept" name="dept" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="course">Course</label>
                                <select class="form-control" id="course" name="course" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="contact_no">Contact Number</label>
                                <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Enter Contact No." required>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender(Optional)</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value="M">
                                    <label class="form-check-label">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value="F">
                                    <label class="form-check-label">Female</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" checked="" value="U">
                                    <label class="form-check-label">Unknown</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
        </div>
    </footer>
</div>

<?php include '../templates/user-footer.php'?>
<script>
$( document ).ready(function() {
    LoadDepartments()
    $("#dept").change(function() {
        var dept_code = $("#dept").val();
        LoadCourse(dept_code)
    });
});

function LoadDepartments() {
    $.ajax({
      url: 'actions/?getdept',
      dataType: 'json',
      success:function(response){     
        $("#dept").empty();
        $("#dept").append("<option value=''>All</option>")
        var len = response.length;
        for( var i = 0; i<len; i++){
            var code = response[i]['Code'];
            var name = response[i]['Name']; 
            $("#dept").append("<option value='"+code+"'>"+name+"</option>");           
        }
      }
    });
}

function LoadCourse(dept_code) {
    $.ajax({
      url: 'actions/?getcourse',
      dataType: 'json',
      method:"POST",
      data: {dept_code:dept_code},
      success:function(response){     
        $("#course").empty();
        $("#course").append("<option value=''>All</option>")
        var len = response.length;
        for( var i = 0; i<len; i++){
            var code = response[i]['Code'];
            var name = response[i]['Name']; 
            $("#course").append("<option value='"+code+"'>"+name+"</option>");           
        }
      }
    });
}
</script>
</body>
</html>
