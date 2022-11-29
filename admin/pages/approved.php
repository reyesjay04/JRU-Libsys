<?php include '../templates/admin-header.php';?>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <?php include '../templates/admin-nav.php';?>
  <?php include '../templates/admin-side.php';?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Approved Post</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Approved Post</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-cog"></i>
              Approved Post List
            </h3>
          </div>
          <div class="card-body">
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Approved Post Tab</a>
              </li>
            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">      
                <div class="card-body">
                  <div class="row">
                    <div class=col-md-12>
                      <table id="approve" class="table table-striped table-bordered dt-responsive" style="width:100%">
                        <thead>
                          <tr>
                            <th>Title</th>
                            <th>Department</th>
                            <th>Course</th>
                            <th>Content</th>
                            <th>Availability</th>    
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Title</th>
                            <th>Department</th>
                            <th>Course</th>
                            <th>Content</th>
                            <th>Availability</th>    
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
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

<?php include '../templates/admin-footer.php';?>
<script>
$( document ).ready(function() {
  LoadDatatable();
});

function LoadDatatable() {
  $("#approve").DataTable({
    "responsive": true,
    "autoWidth": false,
    "processing": true,
    "serverSide": true,
    "destroy" : true,
    "ajax": "dtserver/getallapprovepost.php",
    // "columnDefs": [
    //   { "width": "5%", "targets":4 }, { "width": "5%", "targets":5 }
    // ]

  });
}

function disapprovepost(id) {
  let text = "Are you sure you want to disapprove this post?";
  if (confirm(text) == true) {
    $.ajax({
      url:"actions/?disapprovepost",
      method:"POST",
      data:{id:id},
      success:function(data){
          $("#pending").empty();
          LoadDatatable();
      }

    });
  } 
 
}

</script>
</body>
</html>
