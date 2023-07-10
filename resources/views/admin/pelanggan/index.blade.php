@include('layouts.main.header')

  <!-- Main Sidebar Container -->
  @include('layouts.sidebar.admin')
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
              <li class="breadcrumb-item active">Data Pelanggan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

           @if(session()->has('toast_success'))
            <div class="container-fluid">
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('toast_success') }}
            </div>
            </div>
             @endif

            <!-- TABEL DATA -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Pelanggan</h3>
              </div><!-- /.card-header -->
              
              
              
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped table-responsive">
                  <thead>
                    <th>No.</th>
                    <th>User Name</th>
                    <th>Nama Lengkap</th>
                    <th>NIK</th>
                    <th>No. Telp</th>
                    <th>Jabatan</th>
                    <th>Alamat</th>
                    <th>Nama Perusahaan</th>
                    <th>Email Perusahaan</th>
                    <th>Alamat Perusahaan</th>
                    <th style="width: 150px;">Aksi</th>
                  </thead>
                  <tbody>
                  @foreach ($pelanggan as $data_pelanggan)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data_pelanggan->user->username }}</td>
                    <td>{{ $data_pelanggan->nama_lengkap }}</td>
                    <td>{{ $data_pelanggan->nik }}</td>
                    <td>{{ $data_pelanggan->telp }}</td>
                    <td>{{ $data_pelanggan->jabatan }}</td>
                    <td>{{ $data_pelanggan->alamat }}</td>
                    <td>{{ $data_pelanggan->nama_pr }}</td>
                    <td>{{ $data_pelanggan->email_pr }}</td>
                    <td>{{ $data_pelanggan->alamat_pr }}</td>
                    <td>

                    <form action="{{route('pelanggan.destroy', $data_pelanggan->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-edit{{$data_pelanggan->id}}">
                          <i class="fas fa-edit"></i>
                        </button>
                        <button type="submit" onclick="return confirm ('Apakah Anda yakin untuk menghapus data?')" class="btn btn-danger btn-xs">
									        <i class="fa fa-trash"></i>
								        </button>
                      </form>
                      @include('admin.pelanggan.edit')
                    
                    </td>
                  </tr>
                  @endforeach
                  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

      

        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div>
<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
</div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  
</div>
<!-- ./wrapper -->


@include('layouts.main.footer')
