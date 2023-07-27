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
            <li class="breadcrumb-item active">Detail Pembayaran</li>
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

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Detail Pembayaran</h3>
        </div><!-- /.card-header -->

        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="id">ID</label>
                <input type="text" class="form-control" id="id" name="id" value="{{$bayar->pengujian->id}}" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="no_skrd">No. SKRD</label>
                <input type="text" class="form-control" id="no_skrd" name="no_skrd" value="{{$bayar->pengujian->no_skrd}}" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="no_order">No. Order</label>
                <input type="text" class="form-control" id="no_order" name="no_order" value="{{$bayar->pengujian->no_order}}" readonly>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="nama_proyek">Nama Proyek</label>
            <input type="text" class="form-control" id="nama_proyek" name="nama_proyek" value="{{$bayar->pengujian->nama_proyek}}" readonly>
          </div>
          <div class="form-group">
            <label for="lokasi_proyek">Lokasi Proyek</label>
            <input type="text" class="form-control" id="lokasi_proyek" name="lokasi_proyek" value="{{$bayar->pengujian->lokasi_proyek}}" readonly>
          </div>
          <div class="form-group">
            <label for="bidang">Bidang</label>
            <input type="text" class="form-control" id="bidang" name="bidang" value="{{$bayar->pengujian->bidang}}" readonly>
          </div>
          <div class="form-group">
            <label for="">Jenis Layanan</label>
            <input type="text" class="form-control" id="jenis_layanan" name="jenis_layanan" value="{{$bayar->jenisLayanan->nama_layanan}}" readonly>
          </div>
          <div class="form-group">
            <label for="laporan">Total Bayar</label>
            <input type="text" class="form-control" id="total" name="total" value="{{$bayar->total}}" readonly>
          </div>

          <div class="card-footer">
            <button type="button" class="btn btn-default" onclick="window.location.href='{{route('bayar.index')}}'">Cancel</button>
            <button type="button" class="btn btn-primary float-right" id="pay-button">Bayar Sekarang</button>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<form action="" id= "submit_form" method="POST">
  @csrf
  <input type="hidden" name="json" id="json_callback">
</form>
<script type="text/javascript">
      // For example trigger on button clicked, or any time you need
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{ $snapToken }}', {
          onSuccess: function(result){
            /* You may add your own implementation here */
            alert("payment success!"); console.log(result);
            send_response_to_form(result);

            // Redirect to bayar.index
            window.location.href = '{{ route('bayar.index') }}';
          },
          onPending: function(result){
            /* You may add your own implementation here */
            alert("wating your payment!"); console.log(result);
            send_response_to_form(result);
            // Redirect to bayar.index
            window.location.href = '{{ route('bayar.index') }}';
          },
          onError: function(result){
            /* You may add your own implementation here */
            alert("payment failed!"); console.log(result);
            send_response_to_form(result);
            // Redirect to bayar.index
           window.location.href = '{{ route('bayar.index') }}';
          },
          onClose: function(){
            /* You may add your own implementation here */
            alert('you closed the popup without finishing the payment');
          }
        })
      });

      function send_response_to_form(result){
        document.getElementById('json_callback').value = JSON.stringify(result);
        $('#submit_form').submit();
      }
    </script>

@include('layouts.main.footer')
