<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <span class="d-flex brand-text font-weight-light justify-content-center">YANTI BINA MARGA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('bagitugas.index')}}" class="nav-link">
            <i class="nav-icon fas fa-columns"></i>
              <p>
                Pengendalian Tugas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('laporan.index')}}" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Laporan
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>