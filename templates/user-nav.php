<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="?dashboard" class="navbar-brand">
        <img src="" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">JRU REPOSITORY</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="?post" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == $LIB_SYS_DIR_STUD."?post" ? "active" : "" )?>">Post</a>
          </li>
          <li class="nav-item">
            <a href="?request" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == $LIB_SYS_DIR_STUD."?request" ? "active" : "" )?>">Request</a>
          </li>
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>


          </div>
        </li>
        <li class="nav-item dropdown ">
          <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
            <i class="far fa-user"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right " style="left: inherit; right: 0px;">
            <div class="dropdown-divider"></div>
            <a href="?profile" class="dropdown-item">
              <div class="media" onclick="profile();">
                <img src=" <?php echo $_SESSION['USER_PICTURE']?>" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">

                    <?php echo $_SESSION['USER_FIRST'] . " " .  $_SESSION['USER_LAST']?>
                  </h3>
                  <p class="text-sm"> <?php echo $_SESSION['USER_ROLE']?></p>
                </div>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" onclick="logout()" class="dropdown-item dropdown-footer">Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>