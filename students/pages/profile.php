<?php include '../templates/user-header.php';

$result = GetUserStudentProfileForForm($_SESSION['USER_ID']);
?>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
  <?php include '../templates/user-nav.php'?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><a href="#">Profile</a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container">
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3">
                <div class="card card-primary card-outline">
                  <div class="card-body box-profile">
                    <div class="text-center">
                      <img class="profile-user-img img-fluid img-circle" src="<?php echo $_SESSION['USER_PICTURE']; ?>" alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center"><?php echo $_SESSION['USER_FIRST'].' '.$_SESSION['USER_LAST']; ?></h3>
                    <p class="text-muted text-center"><?php echo $_SESSION['USER_ROLE'];?></p>
                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Total Post</b> <a class="float-right" id="totalpost">0</a>
                      </li>
                      <li class="list-group-item">
                        <b>Total Ratings</b> <a class="float-right" id="totalratings">0</a>
                      </li>
                      <li class="list-group-item">
                        <b>Total Likes</b> <a class="float-right" id="totallikes">0</a>
                      </li>
                      <li class="list-group-item">
                        <b>Total Dislikes</b> <a class="float-right" id="totaldislikes">0</a>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">About Me</h3>
                  </div>
                  <div class="card-body">
                    <strong><i class="fas fa-book mr-1"></i> Email Address</strong>

                    <p class="text-muted" id="emailadd"></p>

                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Department</strong>

                    <p class="text-muted" id="department"></p>

                    <hr>

                    <strong><i class="fas fa-pencil-alt mr-1" ></i> Course</strong>

                    <p class="text-muted" id="usercourse"></p>
                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i> Contact Number</strong>

                    <p class="text-muted" id="contact"></p>
                  </div>
                </div>
              </div>
              <div class="col-md-9">
                <div class="card">
                  <div class="card-header p-2">
                    <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link active" href="#statistics" data-toggle="tab">Statistics</a></li>
                      <li class="nav-item"><a class="nav-link" href="#savedlist" data-toggle="tab">Saved List</a></li>
                      <li class="nav-item"><a class="nav-link" href="#request" data-toggle="tab">Article Request List</a></li>
                      <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="tab-pane active" id="statistics">
                        
                      </div>
                      <div class="tab-pane" id="savedlist">
                        
                      </div>
                      <div class="tab-pane" id="request">
                        
                      </div>
                      <div class="tab-pane" id="settings">
                        <form class="form-horizontal" action="actions/?updateuserprofile" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                          <label for="reference_id" class="col-sm-2 col-form-label">Student ID</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="reference_id" name="reference_id" placeholder="Student ID" value="<?php echo  $result[0]['reference_id'];?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="firstname" class="col-sm-2 col-form-label">First Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="<?php echo  $result[0]['FirstName'];?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="lastname" class="col-sm-2 col-form-label">Last Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="<?php echo  $result[0]['LastName'];?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="contact" class="col-sm-2 col-form-label">Contact Number</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact Number" value="<?php echo  $result[0]['contact'];?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="dept" class="col-sm-2 col-form-label">Department</label>
                          <div class="col-sm-10">
                            <select class="form-control" id="dept" name="dept" required>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="course" class="col-sm-2 col-form-label">Course</label>
                          <div class="col-sm-10">
                            <select class="form-control" id="course" name="course" required>
                            </select>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="course" class="col-sm-2 col-form-label">Gender</label>
                          <div class="col-sm-10">
                            <div class="custom-control custom-radio">
                              <input class="custom-control-input" type="radio" id="gender2" name="gender" value="M" <?php echo ($result[0]['gender'] == "M" ? 'checked=""' : "");?>>
                              <label for="gender2" class="custom-control-label">Male</label>
                            </div>
                            <div class="custom-control custom-radio">
                              <input class="custom-control-input" type="radio" id="gender1" name="gender" value="F" <?php echo ($result[0]['gender'] == "F" ? 'checked=""' : "");?>>
                              <label for="gender1" class="custom-control-label">Female</label>
                            </div>
                            <div class="custom-control custom-radio">
                              <input class="custom-control-input" type="radio" id="gender3" name="gender" value="U" <?php echo ($result[0]['gender'] == "U" ? 'checked=""' : "");?>>
                              <label for="gender3" class="custom-control-label">Unknown</label>
                            </div>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="course" class="col-sm-2 col-form-label">profile</label>
                          <div class="col-sm-10">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="profilepic" name="profilepic" accept="image/png, image/jpeg">
                              <label class="custom-file-label" for="profilepic">Choose file</label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-danger">Submit</button>
                          </div>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
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
$(function () {
  bsCustomFileInput.init();
});

$( document ).ready(function() {
    GetArticle();
    getuserprofile();
    getsavedarticles();
    LoadDepartments();
    getrequestlist();
    $("#dept").change(function() {
        var dept_code = $("#dept").val();
        LoadCourse(dept_code);
    });
});


function GetArticle() {
  $.ajax({
      url:"actions/?getarticlesrequest",
      method:"POST",
      success:function(data){
        $("#articles").empty();
        $("#articles").append(data);
      }
  });
}

function cancelrequest(art_id) {
  $.ajax({
      url:"actions/?cancelrequest",
      method:"POST",
      data:{art_id:art_id},
      success:function(data){
        location.reload();
      }
  });
}

function getuserprofile() {
  $.ajax({
      url:"actions/?userprofile",
      method:"POST",
      dataType: "json",
      success:function(data){
        $("#totalpost").text(data[0]['totalpost']);
        $("#totalratings").text(data[0]['totalratings']);
        $("#totallikes").text(data[0]['totallikes']);
        $("#totaldislikes").text(data[0]['totaldislikes']);

        $("#emailadd").text(data[0]['emailadd']);
        $("#department").text(data[0]['department']);
        $("#usercourse").text(data[0]['course']);
        $("#contact").text(data[0]['contact']);
      }
  });
}

function getsavedarticles() {
  $.ajax({
      url:"actions/?getsavedarticles",
      method:"POST",
      success:function(data){
        $("#savedlist").append(data);
      }
  });
}

function getrequestlist() {
  $.ajax({
      url:"actions/?getrequestlist",
      method:"POST",
      success:function(data){
        $("#request").append(data);
      }
  });
}

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
        $("#dept").val("<?php echo  $result[0]['department'];?>");
        var dept_code = $("#dept").val();
        LoadCourse(dept_code);
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
        $("#course").val("<?php echo  $result[0]['course'];?>");
      }
    });
}
</script>
</body>
</html>
