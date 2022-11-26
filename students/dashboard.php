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
        <div class="form-group">
          <label>Search</label>
          <select id="cell" class="input-group js-data-example-ajax"></select>

          <select class="input-group input-group-lg select2" multiple="multiple" data-placeholder="Any" style="width: 100%;">
              <!-- <option>Text only</option>
              <option>Images</option>
              <option>Video</option> -->
          </select>
        </div>
        <div class="row">   
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#articles" data-toggle="tab">Articles</a></li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="articles">
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                        <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                        </span>
                        <span class="description">Shared publicly - 7:30 PM today</span>
                      </div>
                      <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore the hate as they create awesome
                        tools to help create filler text for everyone from bacon lovers
                        to Charlie Sheen fans.
                      </p>
                      <p>
                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> View Article</a>
                      </p>
                    </div>
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
    $(function () {
      $('.select2').select2()
    });


$( document ).ready(function() {
  a();
  $('#cell').on('change', function() {
    a();
  });
});

function a() {
  $('#cell').select2({
  ajax: {
    url: 'https://api.github.com/search/repositories',
    dataType: 'json'
  // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
  }
  });
}
</script>
</body>
</html>
