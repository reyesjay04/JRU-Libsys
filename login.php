<?php include 'templates/login-header.php';?>
<?php include 'res/googleapi/google-auth.php';?>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>JRU </b>Repository</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>
        <div class="social-auth-links text-center mt-2 mb-3">
            <a href="<?php echo $client->createAuthUrl()?>" class="btn btn-danger btn-block">          
                <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
            </a>
        </div>
    </div>
  </div>
</div>
<!-- /.login-box -->
<?php include 'templates/login-footer.php';?>
</body>
</html>