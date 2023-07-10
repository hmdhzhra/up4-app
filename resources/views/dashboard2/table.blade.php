<!-- TABEL DATA -->
<div class="card">
    <div class="card-header">
    <h3 class="card-title">Data Pengujian</h3>
    </div><!-- /.card-header -->
    <div class="card-body">
    <table id="example2" class="table table-bordered table-striped table-responsive">
        <thead>
        <th>No.</th>
        <th>ID</th>
        <th>User Name</th>
        <th>Nama Perusahaan</th>
        <th>Nama Proyek</th>
        <th>Email</th>
        <th>No. Telp</th>
        <th>Tanggal Permohonan</th>
        <th>Jadwal Pengujian</th>
        <th>Status</th>
        <th>Aksi</th>
        </thead>
        <tbody>
        @foreach($full_pengujian as $pengujian)
        <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $pengujian->id }}</td>
        <td>{{ $pengujian->pelanggan->user->username }}</td>
        <td>{{ $pengujian->pelanggan->nama_pr }}</td>
        <td>{{ $pengujian->nama_proyek }}</td>
        <td>{{ $pengujian->pelanggan->user->email }}</td>
        <td>{{ $pengujian->pelanggan->telp }}</td>
        <td>{{ $pengujian->tgl_permohonan }}</td>
        <td>{{ $pengujian->jadwal_pengujian }}</td>
        <td>{{ $pengujian->status }}</td>
        <td>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-show{{$pengujian->id}}">
            <i class="fas fa-eye"></i>
            </button>

            @include('dashboard2.show')
        </td>
        
        </tr>
        @endforeach
        
        </tbody>
    </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->