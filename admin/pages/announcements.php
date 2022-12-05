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
            <h1 class="m-0">Announcement</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Announcement</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-md-3">
              <button class="btn btn-sm btn-warning btn-block mb-3 " data-toggle="modal" data-target="#modal-add-annoucement" type="button">Create Announcement</button>
          </div>
        </div>
        <div class="card card-primary card-outline">
          <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">      
            <div class="card-body">
              <div class="row">
                <div class=col-md-12>
                  <table id="educators" class="table table-striped table-bordered dt-responsive" style="width:100%">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Attachment</th>    
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Attachment</th>    
                        <th>Created At</th>
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
    </section>
  </div>
</div>

<?php include '../templates/admin-footer.php';?>
<?php include 'modals/add-announcement-modal.php';?>
<script>
$(function () {
  bsCustomFileInput.init();
});

$( document ).ready(function() {
  LoadDatatable();
});

function LoadDatatable() {
  $("#educators").DataTable({
    "responsive": true,
    "autoWidth": false,
    "processing": true,
    "serverSide": true,
    "destroy" : true,
    "ajax": "dtserver/getannouncement.php",
    // "columnDefs": [
    //   { "width": "5%", "targets":5 },{ "width": "2%", "targets":0 },{ "width": "4%", "targets":6 }
    // ]

  });
}

function deleteannouncement(id) {
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
