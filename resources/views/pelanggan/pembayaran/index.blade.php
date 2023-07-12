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
              <li class="breadcrumb-item active">Pembayaran Layanan</li>
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
                <h3 class="card-title">Pembayaran Layanan</h3>
              </div><!-- /.card-header -->
              
              
              
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                    <th>No.</th>
                    <th>ID</th>
                    <th>Nama Proyek</th>
                    <th>Tanggal Permohonan</th>
                    <th>Status</th>
                    <th>Status Pembayaran</th>
                    <th style="width: 150px;">Pembayaran</th>
                  </thead>
                  <tbody>
                  @foreach($data_pembayaran as $pembayaran)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pembayaran->id }}</td>
                    <td>{{ $pembayaran->nama_proyek }}</td>
                    <td>{{ $pembayaran->tgl_permohonan }}</td>
                    <td>{{ $pembayaran->status }}</td>
                    <td>{{ $pembayaran->layanan->status_pembayaran }}</td>
                    <td >

                        <a type="button" class="btn btn-warning btn-sm" href="{{route('bayar.showDetail', $pembayaran->id)}}">
                          <i class="fas fa-receipt"></i>
                        </a>
                      
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


@include('layouts.main.footer')
