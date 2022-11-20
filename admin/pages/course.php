<?php include '../templates/admin-header.php';?>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <?php include '../templates/admin-nav.php';?>
  <?php include '../templates/admin-side.php';?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Course</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Course</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
              <button class="btn btn-sm btn-warning btn-block mb-3 " data-toggle="modal" data-target="#modal-add-course" type="button">New Course</button>
          </div>
        </div>

        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-cog"></i>
              List of Course
            </h3>
          </div>
          <div class="card-body">
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Course Tab</a>
              </li>
            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">      
                <div class="card-body">
                  <div class="row">
                    <div class=col-md-12>
                      <table id="course" class="table table-striped table-bordered dt-responsive" style="width:100%">
                        <thead>
                          <tr>
                            <th>Code</th>
                            <th>Course</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Status</th>    
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Code</th>
                            <th>Course</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Status</th>    
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
<?php include 'modals/add-course-modal.php';?>
<?php include 'modals/edit-course-modal.php';?>
<script>
$( document ).ready(function() {
  LoadDatatable();
});

function LoadDatatable() {
  $("#course").DataTable({
    "responsive": true,
    "autoWidth": false,
    "processing": true,
    "serverSide": true,
    "destroy" : true,
    "ajax": "dtserver/getcourse.php",
    "columnDefs": [
      { "width": "5%", "targets":5 }
    ]

  });
}

function deletecourse(id) {
  let text = "Are you sure you want to delete this category?";
  if (confirm(text) == true) {
    $.ajax({
      url:"actions/?deletecourse",
      method:"POST",
      data:{id:id},

      success:function(data){
          alert(data);
          $("#categories").empty();
          LoadDatatable();
      }

    });
  } 
 
}

function editcourse(id) {
  $.ajax({  
    url:"actions/?getcoursedata",  
    method:"post",  
    data:{id:id},  
    success:function(data){  
      $('#course-detail').html(data);  
      $('#modal-edit-course').modal("show");
    }

    });
}



</script>
</body>
</html>
