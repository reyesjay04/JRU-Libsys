<?php include '../templates/user-header.php'?>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
  <?php include '../templates/user-nav.php'?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><a href="#">Dashboard</a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-8">
            <div class="form-group">
              <select class="form-control" style="width: 100%" id="search">
              </select>
            </div>
          </div>
          <div class="col-4">
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                  </span>
                </div>
                <input type="text" class="form-control float-right" id="datepicker-pick">
              </div>              
            </div>
          </div>
        </div>
        <div class="row">   
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Post Details</h3>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="articles">            
                  </div>
                </div>
              </div>     
            </div>
          </div>
          <div class="col-4">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-text-width"></i>
                  Announcement
                </h3>
              </div>
              <div class="card-body">
                <blockquote>
                  <p>Dear [name], We are excited to announce that, due to our remarkable growth over the last [enter number] of years, we are expanding! In fact, we are opening a new store in [enter location and specifics]. We invite you to celebrate with us during the big opening day on [enter date].</p>
                </blockquote>
                <div class="attachment-block clearfix">
                  <a type="button" id="ATT63846031b6b87.png" onclick="downloadFile(this.id)" class="link-black text-sm"><i class="fas fa-link mr-1"></i>ATT63846031b6b87.png</a>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Statistics<h3>
              </div>
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Category</th>
                      <th>Progress</th>
                      <th style="width: 40px">Label</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Likes</td>
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-danger">55%</span></td>
                    </tr>
                    <tr>
                      <td>Dislikes</td>
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-danger" style="width: 70%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-danger">70%</span></td>
                    </tr>
                    <tr>
                      <td>Pending Post</td>
                      <td>
                        <div class="progress progress-xs progress-striped active">
                          <div class="progress-bar bg-warning" style="width: 30%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-warning">30%</span></td>
                    </tr>
                  </tbody>
                </table>
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
  search();
  updateConfig();
  GetArticle();
  $( "#search" ).change(function() {
    GetArticle($( "#search" ).val());
  });
});

function search() {
  $("#search").select2({
      multiple: true,
      minimumInputLength: 2,
      placeholder: "Search article",
      ajax: {
          url: "actions/?search",
          type: "post",
          dataType: 'json',
          delay: 250,
          
          data: function (params) {
              return {
                  searchTerm: params.term,
                  dateval:  $("#datepicker-pick").val()
              };
          },
          processResults: function (response) {
              return {
                  results: response
              };
          },
          cache: true
      }
  });
}

function updateConfig() { 
    var currentYear = moment().year(); // This Year
    console.log(currentYear);
    var currentYearStart = moment({
      years: currentYear,
      months: '0',
      date: '1'
    }); // 1st Jan this year  
    console.log(currentYear);
    var currentYearEnd = moment({
      years: currentYear,
      months: '11',
      date: '31'
    }); // 31st Dec this year

    $('#datepicker-pick').daterangepicker(
     
      {
        ranges: {
          ['Year Now'] : [moment(currentYearStart, currentYearEnd)],
          ['Year ' + (currentYear - 1)] : [moment(currentYearStart.subtract(1, "year")), moment(currentYearEnd.subtract(1, "year"))],
          ['Year ' + (currentYear - 2)] : [moment(currentYearStart.subtract(1, "year")), moment(currentYearEnd.subtract(1, "year"))],
          ['Year ' + (currentYear - 3)] : [moment(currentYearStart.subtract(1, "year")), moment(currentYearEnd.subtract(1, "year"))],
          ['Year ' + (currentYear - 4)] : [moment(currentYearStart.subtract(1, "year")), moment(currentYearEnd.subtract(1, "year"))],
        },
        startDate: moment(currentYearStart.add(4, "year")),
        endDate: moment(currentYearEnd.add(4, "year"))
      }, 
    function(start, end, label) {
        // alert("A new date range was chosen: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });
}

function GetArticle(art_id) {
  $.ajax({
      url:"actions/?getarticles",
      method:"POST",
      data:{art_id:art_id},
      success:function(data){
        $("#articles").empty();
        $("#articles").append(data);
      }

  });
}

function request(art_id) {
  $.ajax({
      url:"actions/?requestaccess",
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
