<!-- Modal Show Data -->
<div class="modal fade" id="modal-show{{$pembayaran->id}}">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Data Pembayaran</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="#" method="POST">
                {{ method_field('PATCH') }}
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="id">ID</label>
                            <input type="text" class="form-control" id="id" name="id" value="{{$pembayaran->id}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="no_skrd">No. SKRD</label>
                            <input type="text" class="form-control" id="no_skrd" name="no_skrd" value="{{$pembayaran->no_skrd}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="no_order">No. Order</label>
                            <input type="text" class="form-control" id="no_order" name="no_order" value="{{$pembayaran->no_order}}" readonly>
                            </div>
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_proyek">Nama Proyek</label>
                            <input type="text" class="form-control" id="nama_proyek" name="nama_proyek" value="{{$pembayaran->nama_proyek}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="lokasi_proyek">Lokasi Proyek</label>
                            <input type="text" class="form-control" id="lokasi_proyek" name="lokasi_proyek" value="{{$pembayaran->lokasi_proyek}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="bidang">Bidang</label>
                            <input type="text" class="form-control" id="bidang" name="bidang" value="{{$pembayaran->bidang}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Layanan</label>
                            <input type="text" class="form-control" id="jenis_layanan" name="jenis_layanan" value="{{ $pembayaran->layanan->jenisLayanan->nama_layanan}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="laporan">Total Bayar</label>
                            <input type="text" class="form-control" id="laporan" name="laporan" value="{{$pembayaran->layanan->total}}" readonly>
                        </div>
                    </div>
                </div>
    
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Bayar sekarang</button>
                </div>

            </form>

        </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <script type="text/javascript">
      // For example trigger on button clicked, or any time you need
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{ $snapToken }}', {
          onSuccess: function(result){
            /* You may add your own implementation here */
            alert("payment success!"); console.log(result);
          },
          onPending: function(result){
            /* You may add your own implementation here */
            alert("wating your payment!"); console.log(result);
          },
          onError: function(result){
            /* You may add your own implementation here */
            alert("payment failed!"); console.log(result);
          },
          onClose: function(){
            /* You may add your own implementation here */
            alert('you closed the popup without finishing the payment');
          }
        })
      });
    </script>
