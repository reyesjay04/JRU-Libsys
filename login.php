<?php include 'templates/login-header.php';?>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>JRU </b>Repository</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

        <form action="../../index3.html" method="post">
        <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
            </div>
        </div>
        <div class="social-auth-links text-center mt-2 mb-3">
            <button type="submit" class="btn btn-danger btn-block">          
                <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
            </button>
        </div>
        </form>
        <p class="mb-0">
            <a href="?register" class="text-center">Register a new membership</a>
        </p>
    </div>
  </div>
</div>
<!-- /.login-box -->
<?php include 'templates/login-footer.php';?>

<script>
  $( document ).ready(function() {
  });
</script>
</body>
</html>