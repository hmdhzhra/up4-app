@include('layouts.main.header')

  <!-- Main Sidebar Container -->
  @include('layouts.sidebar.pelanggan')
    <!-- /.sidebar -->
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

            <!-- Alert Info -->
        <div class="alert alert-info alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-info"></i> Alert!</h5>
          Lengkapi Data Pelanggan!
        </div>

        @if(session()->has('toast_success'))
            <div class="container-fluid">
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('toast_success') }}
            </div>
            </div>
        @endif

        <!-- FORM -->
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Profile Data Pelanggan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('profile.update', $user->id) }}
              " method="POST">
              @csrf
              @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="username">User Name</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{$user->username}}" readonly>
                  </div>
                  <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control @error('nama_lengkap')is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan Nama Lengkap" required value="{{ optional($pelanggan)->nama_lengkap }}">
                    @error('nama_lengkap')
                      <div class="invalid-feedback">
                      {{ $message }}
                      </div>
                    @enderror
                  </div>


                  <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="text" class="form-control @error('nik')is-invalid @enderror" id="nik" name="nik" placeholder="Masukkan NIK" required value="{{optional($pelanggan)->nik}}">
                    @error('nik')
                      <div class="invalid-feedback">
                      {{ $message }}
                      </div>
                    @enderror
                  </div>


                  <div class="form-group">
                    <label for="telp">No. Telp/HP</label>
                    <input type="text" class="form-control @error('telp')is-invalid @enderror" id="telp" name="telp" placeholder="Masukkan No. Telepon" required value="{{optional($pelanggan)->telp}}">
                    @error('telp')
                      <div class="invalid-feedback">
                      {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" class="form-control @error('jabatan')is-invalid @enderror" id="jabatan" name="jabatan" placeholder="Masukkan Jabatan" required value="{{optional($pelanggan)->jabatan}}">
                    @error('jabatan')
                      <div class="invalid-feedback">
                      {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control @error('alamat')is-invalid @enderror" id="alamat" name="alamat" placeholder="Masukkan Alamat" required value="{{optional($pelanggan)->alamat}}">
                    @error('alamat')
                      <div class="invalid-feedback">
                      {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="nama_pr">Nama Perusahaan</label>
                    <input type="text" class="form-control @error('nama_pr')is-invalid @enderror" id="nama_pr" name="nama_pr" placeholder="Masukkan Nama Perusahaan" required value="{{optional($pelanggan)->nama_pr}}">
                    @error('nama_pr')
                      <div class="invalid-feedback">
                      {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="email_pr">Email Perusahaan</label>
                    <input type="email" class="form-control @error('email_pr')is-invalid @enderror" id="email_pr" name="email_pr" placeholder="Masukkan Email Perusahaan" required value="{{optional($pelanggan)->email_pr}}">
                    @error('email_pr')
                      <div class="invalid-feedback">
                      {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="alamat_pr">Alamat Perusahaan</label>
                    <input type="text" class="form-control @error('alamat_pr')is-invalid @enderror" id="alamat_pr" name="alamat_pr" placeholder="Masukkan Alamat Perusahaan" required value="{{optional($pelanggan)->alamat_pr}}">
                    @error('alamat_pr')
                      <div class="invalid-feedback">
                      {{ $message }}
                      </div>
                    @enderror
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" class="btn btn-default" onclick="window.location.href='{{ route('dashboard') }}'">Cancel</button>
                  <button type="submit" class="btn btn-primary float-right">Simpan</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
        

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@include('layouts.main.footer')
