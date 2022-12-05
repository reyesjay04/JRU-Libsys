<?php include '../templates/user-header.php';

$result = GetUserStudentProfile($_GET['profile']);

?>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
  <?php include '../templates/user-nav.php'?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Request</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><a href="#">Request</a></li>
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
                      <img class="profile-user-img img-fluid img-circle" src="<?php echo $result[0]['picture']; ?>" alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center"><?php echo $result[0]['FirstName'].' '.$result[0]['LastName']; ?></h3>
                    <p class="text-muted text-center"><?php echo $result[0]['Role'];?></p>
                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Total Post</b> <a class="float-right" id="totalpost"><?php echo $result[0]['totalpost'];?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Total Ratings</b> <a class="float-right" id="totalratings"><?php echo $result[0]['totalratings'];?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Total Likes</b> <a class="float-right" id="totallikes"><?php echo $result[0]['totallikes'];?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Total Dislikes</b> <a class="float-right" id="totaldislikes"><?php echo $result[0]['totaldislikes'];?></a>
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

                    <p class="text-muted" id="emailadd"><?php echo $result[0]['emailadd'];?></p>

                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Department</strong>

                    <p class="text-muted" id="department"><?php echo $result[0]['department'];?></p>

                    <hr>

                    <strong><i class="fas fa-pencil-alt mr-1" ></i> Course</strong>

                    <p class="text-muted" id="course"><?php echo $result[0]['course'];?></p>
                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i> Contact Number</strong>

                    <p class="text-muted" id="contact"><?php echo $result[0]['contact'];?></p>
                  </div>
                </div>
              </div>
              <div class="col-md-9">
                <div class="card">
                  <div class="card-header p-2">
                    <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link active" href="#statistics" data-toggle="tab">Statistics</a></li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="tab-pane active" id="statistics">

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


$( document ).ready(function() {
    // GetArticle();
    // getuserprofile();
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
        $("#course").text(data[0]['course']);
        $("#contact").text(data[0]['contact']);
      }
  });
}

</script>
</body>
</html>
