<?php include '../templates/user-header.php'?>
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
        <div class="row">   
          <div class="col-md-12">
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Request Details</h3>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="articles">            
                  </div>
                </div>
              </div>     
            </div>
          </div>
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
    GetArticle();
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

</script>
</body>
</html>
