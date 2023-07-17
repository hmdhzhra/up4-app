@include('layouts.main.header')

  <!-- Main Sidebar Container -->
  @include('layouts.sidebar.bendahara')
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
              <li class="breadcrumb-item active">Status Pembayaran</li>
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
                <h3 class="card-title">Status Pembayaran</h3>
              </div><!-- /.card-header -->
              
              
              
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                    <th>No.</th>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Nama Proyek</th>
                    <th>Tanggal Permohonan</th>
                    <th>Tanggal Transaksi</th>
                    <th>Total Pembayaran</th>
                    <th>Status Transaksi</th>
                  </thead>
                  <tbody>
                  @foreach($data_pembayaran as $pembayaran)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pembayaran->pengujian->id }}</td>
                    <td>{{ $pembayaran->pengujian->pelanggan->user->username }}</td>
                    <td>{{ $pembayaran->pengujian->nama_proyek }}</td>
                    <td>{{ $pembayaran->pengujian->tgl_permohonan }}</td>
                    <td>2022-02-03</td>
                    <td>{{ $pembayaran->total }}</td>
                    <td>{{$pembayaran->status_pembayaran }}</td>
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
