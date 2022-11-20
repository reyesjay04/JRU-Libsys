<!-- Main Sidebar Container -->
<?php


?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="?dashboard" class="brand-link">
      <img src="../templates/images/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">JRU ADMIN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/admin.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">

          <a href="#" class="d-block"><?php echo $_SESSION['FIRST_NAME']." ".$_SESSION['LAST_NAME'] ;?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="?dashboard" class="nav-link 
            <?php 
              if($_SERVER['REQUEST_URI'] == $LIB_SYS_DIR.'admin/' || $_SERVER['REQUEST_URI'] == $LIB_SYS_DIR.'admin/?dashboard' ) {
                echo 'active';
              }
            ?> ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item       
            <?php
              switch ($_SERVER['REQUEST_URI']) {
                case $LIB_SYS_DIR.'admin/?category':
                  echo 'menu-is-opening menu-open';
                  break;
                case $LIB_SYS_DIR.'admin/?post':
                  echo 'menu-is-opening menu-open';
                  break;
                case $LIB_SYS_DIR.'admin/?approvedpost':
                  echo 'menu-is-opening menu-open';
                  break;
                case $LIB_SYS_DIR.'admin/?rejectedpost':
                  echo 'menu-is-opening menu-open';
                  break;
                case $LIB_SYS_DIR.'admin/?pendingpost':
                  echo 'menu-is-opening menu-open';
                    break;
              }       
            ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Post
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?category" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == $LIB_SYS_DIR.'admin/?category') ? "active" : ""?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?post" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == $LIB_SYS_DIR.'admin/?post') ? "active" : ""?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Post</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?approvedpost" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == $LIB_SYS_DIR.'admin/?approvedpost') ? "active" : ""?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Approved Post</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?rejectedpost" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == $LIB_SYS_DIR.'admin/?rejectedpost') ? "active" : ""?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Rejected Post</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?pendingpost" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == $LIB_SYS_DIR.'admin/?pendingpost') ? "active" : ""?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Pending Post</p>
                </a>
              </li>
            </ul>
          </li>     
          <li class="nav-item <?php
              switch ($_SERVER['REQUEST_URI']) {
                case $LIB_SYS_DIR.'admin/?studentlist':
                  echo 'menu-is-opening menu-open';
                  break;
                case $LIB_SYS_DIR.'admin/?course':
                  echo 'menu-is-opening menu-open';
                  break;
              }       
            ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Students
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?studentlist" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == $LIB_SYS_DIR.'admin/?studentlist') ? "active" : ""?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student List</p>
                </a>
              </li>
           
              <li class="nav-item">
                <a href="?course" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == $LIB_SYS_DIR.'admin/?course') ? "active" : ""?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Course</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="?educators" class="nav-link <?php 
              if( $_SERVER['REQUEST_URI'] == $LIB_SYS_DIR.'admin/?educators' ) {
                echo 'active';
              }
            ?> ">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Educators
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Comments/ Reactions
                <!-- <i class="fas fa-angle-left right"></i> -->
              </p>
            </a>
            <!-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/forms/general.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General Elements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/advanced.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Advanced Elements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/editors.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Editors</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/validation.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Validation</p>
                </a>
              </li>
            </ul> -->
          </li>

          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>