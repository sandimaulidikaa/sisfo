 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?=BASE_URL?>/theme/AdminLTE/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=BASE_URL?>/assets/avatar/<?=$_SESSION['foto']?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?=$_SESSION['nama']?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="<?=BASE_URL?>/pegawai/profile.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profil
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=BASE_URL?>/pegawai/data_kepegawaian/detail.php?nip=<?=$_SESSION['nip']?>" class="nav-link">
              <i class="nav-icon fas fa-street-view"></i>
              <p>
                Data diri lengkap
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=BASE_URL?>/pegawai/absensi" class="nav-link">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
                Absensi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=BASE_URL?>/pegawai/absensi/list_cuti.php" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Pengajuan Cuti
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=BASE_URL?>/auth/logout.php" class="nav-link">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>