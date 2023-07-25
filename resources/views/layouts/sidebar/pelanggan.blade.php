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

      @if(!optional($pelanggan)->id)
      <li class="nav-item">
          <a href="{{ route('profile.index') }}" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('profile.index') }}" class="nav-link">
            <i class="nav-icon fas fa-columns"></i>
            <p>
              Profile
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('profile.index') }}" class="nav-link">
            <i class="nav-icon fas fa-columns"></i>
            <p>
              Riwayat Pengujian
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('profile.index') }}" class="nav-link">
            <i class="nav-icon fas fa-columns"></i>
            <p>
              Permohonan Pengujian
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('profile.index') }}" class="nav-link">
            <i class="nav-icon fas fa-columns"></i>
            <p>
              Pembayaran Layanan
            </p>
          </a>
        </li>
      @else
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('profile.index') }}" class="nav-link">
            <i class="nav-icon fas fa-columns"></i>
            <p>
              Profile
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('riwayat.index') }}" class="nav-link">
          <i class="nav-icon fas fa-columns"></i>
            <p>
             Riwayat Pengujian
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('permohonan.index') }}" class="nav-link">
            <i class="nav-icon fas fa-columns"></i>
            <p>
              Permohonan Pengujian
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('bayar.index') }}" class="nav-link">
            <i class="nav-icon fas fa-columns"></i>
            <p>
              Pembayaran Layanan
            </p>
          </a>
        </li>
      @endif
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>

    </div>
    <!-- /.sidebar -->
  </aside>