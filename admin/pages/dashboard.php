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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6 col-6">

            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>
                <p>Pending Post</p>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-6 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53</h3>
                <p>Number of Likes</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>


        </div>
        <div class="row">
          <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>44</h3>

                  <p>Number of Dislikes</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>65</h3>

                  <p>Average rate of posting</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          <div class="col-lg-3 col-6">

            <div class="small-box bg-muted">
              <div class="inner">
                <h3>150</h3>
                <p>Number of Post Views</p>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>53</h3>
                <p>Number of citations</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-cog"></i>
              Author Summary
            </h3>
          </div>
          <div class="card-body">
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Author Summary Tab</a>
              </li>
            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">      
                <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                      <!-- select -->
                      <div class="form-group">
                        <label>Select</label>
                        <select class="form-control">
                          <option>option 1</option>
                          <option>option 2</option>
                          <option>option 3</option>
                          <option>option 4</option>
                          <option>option 5</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Select Disabled</label>
                        <select class="form-control" disabled="">
                          <option>option 1</option>
                          <option>option 2</option>
                          <option>option 3</option>
                          <option>option 4</option>
                          <option>option 5</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class=col-md-12>
                      <table id="categories" class="table table-striped table-bordered dt-responsive" style="width:100%">
                        <thead>
                          <tr>
                            <th>Code</th>
                            <th>Category Name</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Status</th>    
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Code</th>
                            <th>Category Name</th>
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

<script>
$( document ).ready(function() {
  LoadDatatable();
  LoadDepartments();
});

function LoadDatatable() {
  $("#categories").DataTable({
    "responsive": true,
    "autoWidth": false,
    "processing": true,
    "serverSide": true,
    "destroy" : true,
    "ajax": "dtserver/getcategories.php",
    "columnDefs": [
      { "width": "5%", "targets":4 }, { "width": "5%", "targets":5 }
    ]

  });
}
function LoadDepartments() {
    $.ajax({
      url: 'dtserver/getdepartments.php',
      dataType: 'json',
      success:function(response){     
        $("#dept").empty();
        $("#dept").append("<option value='All'>All</option>")
        for( var i = 0; i<len; i++){
            var code = response[i]['code'];
            var name = response[i]['name']; 
            $("#dept").append("<option value='"+id+"'>"+name+"</option>");           
        }
      }
    });
  }
</script>
</body>
</html>
