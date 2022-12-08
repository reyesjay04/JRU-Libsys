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
                <h3 id="totalpending">0</h3>
                <p>Pending Post</p>
              </div>
              <!-- <a href="?pendingpost" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>

          <div class="col-lg-6 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3 id="totallikes">0</h3>
                <p>Number of Likes</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>


        </div>
        <div class="row">
          <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3 id="totaldislikes">0</h3>

                  <p>Number of Dislikes</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3 id="averagerate">0</h3>

                  <p>Average rate of posting</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
              </div>
            </div>
          <div class="col-lg-3 col-6">

            <div class="small-box bg-muted">
              <div class="inner">
                <h3 id="totalpostviews">0</h3>
                <p>Number of Post Views</p>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3 id="totalcitations">0</h3>
                <p>Number of citations</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
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

                  <div class="form-group">
                    <label>Filter by Department</label>
                      <div class="input-group">
                        <select class="form-control" id="dept">
                        </select>
                        <div class="input-group-prepend">
                          <button type="button" id="1" onclick="SearchAuthor(this.id) ;" class="btn btn-block btn-secondary btn-flat">Search</button>          
                        </div>
                      </div>              
                    </div>
                  </div>
                  <div class="row">
                    <div class=col-md-12>
                      <table id="authors" class="table table-striped table-bordered dt-responsive" style="width:100%">
                        <thead>
                          <tr>
                            <th>Full Name</th>
                            <th></th>
                            <th>Total Articles</th>
                            <th>Pending Post</th>
                            <th>Total Likes</th>    
                            <th>Total Dislikes</th>
                            <th>Total Ratings</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Full Name</th>
                            <th></th>
                            <th>Total Articles</th>
                            <th>Pending Post</th>
                            <th>Total Likes</th>    
                            <th>Total Dislikes</th>
                            <th>Total Ratings</th>
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
<?php include 'modals/view-count-modal.php';?>


<script>
$( document ).ready(function() {
  LoadDatatable(0);
  LoadDepartments();
  DashSummary();
});

function LoadDatatable(id) {
  var filter = "";
  if(id == 0) {
    filter = "All";
  } else {
    filter = $("#dept").val();
  }
  console.log(filter);
  $("#authors").DataTable({
    "responsive": true,
    "autoWidth": false,
    "processing": true,
    "serverSide": true,
    "destroy" : true,
    "ajax": "dtserver/getauthorsummary.php?filter="+filter,
    "columnDefs": [
      {
        render: function (data, type, row) {
            return row[0] + ' ' + row[1];
        },
        targets: 0,
      },
      { visible: false, targets: [1] },
      { "width": "10%", "targets":6 }, 
      { "width": "5%", "targets":7 },

    ]

  });
}
function SearchAuthor(id){
  $("#authors").empty();
  LoadDatatable(id);
}
function LoadDepartments() {
    $.ajax({
      url: 'actions/?getdept',
      dataType: 'json',
      success:function(response){     
        $("#dept").empty();
        $("#dept").append("<option value='All'>All</option>")
        var len = response.length;
        for( var i = 0; i<len; i++){
            var code = response[i]['Code'];
            var name = response[i]['Name']; 
            $("#dept").append("<option value='"+code+"'>"+name+"</option>");           
        }
      }
    });
}

function DashSummary() {
  
  $.ajax({
      url: 'actions/?getdashdetails',
      dataType: 'json',
      success:function(response){     
        $("#totalpending").text(response[0]['totalpending']);
        $("#totallikes").text(response[0]['totallikes']);
        $("#totaldislikes").text(response[0]['totaldislikes']);
        $("#averagerate").text(response[0]['averagerate']);
        $("#totalpostviews").text(response[0]['totalpostviews']);
        $("#totalcitations").text(response[0]['totalcitations']);
      }
    });
}

function viewcount(id) {
  $.ajax({  

    url:"actions/?getcount",  
    method:"post",  
    data:{id:id},  

    success:function(data){  
      $('#view-count').html(data);  
      $('#modal-view-count').modal("show");
    }

  });
}
</script>
</body>
</html>
