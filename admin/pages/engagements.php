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
            <h1 class="m-0">Engagements</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Engagements</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary card-outline">
          <div class="card-body">
            <div class="row">
              <div class=col-md-12>
                <table id="educators" class="table table-striped table-bordered dt-responsive" style="width:100%">
                  <thead>
                    <tr>
                      <th></th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>    
                      <th>Gender</th>
                      <th>Course</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th></th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>    
                      <th>Gender</th>
                      <th>Course</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
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
  //LoadDatatable();
});

function LoadDatatable() {
  $("#educators").DataTable({
    "responsive": true,
    "autoWidth": false,
    "processing": true,
    "serverSide": true,
    "destroy" : true,
    "ajax": "dtserver/geteducators.php",
    "columnDefs": [
      { "width": "5%", "targets":5 },{ "width": "2%", "targets":0 },{ "width": "4%", "targets":6 }
    ]

  });
}

function deletestud(id) {
  let text = "Are you sure you want to delete this record?";
  if (confirm(text) == true) {
    $.ajax({
      url:"actions/?deluser",
      method:"POST",
      data:{id:id},
      success:function(data){
          alert(data);
          $("#educators").empty();
          LoadDatatable();
      }

    });
  } 
 
}
</script>
</body>
</html>
