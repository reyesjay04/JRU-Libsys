<?php include '../templates/admin-header.php';?>
<?php

if(isset($_SESSION['ADMIN_USER'])) {
    echo "<script>window.location.href = /?dashboard";
}
?>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="?dashboard" class="h1"><b>JRU</b>Repository</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="actions/?login" method="post">
                    <div class="input-group mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-user"></span>
                        </div>
                    </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>      
            </div>      
        </div>
    </div>
    <?php include '../templates/admin-footer.php';?>
    <script>
        <?php
        if(isset($_GET['err'])) {
            echo "$( document ).ready(function() {
                    toastr.error('User does not exist.')
                  });";
        }
        ?>
    </script>
</body>
</html>
