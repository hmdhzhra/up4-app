@include('layouts.main.header')

@include('layouts.sidebar.pelanggan')

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Hi, {{$username}}!</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $validasi }}</h3>
              <p>MENUNGGU VALIDASI</p>
            </div>
            <div class="icon">
              <i class="fal fa-file-check"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $validasi_ditolak }}</h3>
              <p>VALIDASI DITOLAK</p>
            </div>
            <div class="icon">
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $stats_pembayaran }}</h3>
              <p>PEMBAYARAN</p>
            </div>
            <div class="icon">
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $selesai }}</h3>
              <p>LAPORAN SELESAI</p>
            </div>
            <div class="icon">
            </div>
          </div>
        </div>
      </div>

      @if(session()->has('toast_success'))
      <div class="container-fluid">
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          {{ session('toast_success') }}
        </div>
      </div>
      @endif

      <div class="card">
        <div class="card-body">
          <section class="cd-h-timeline js-cd-h-timeline margin-bottom-md">
            <div class="cd-h-timeline__container container">
              <div class="cd-h-timeline__dates">
                <div class="cd-h-timeline__line">
                  <ol>
                    <li><a href="#0" data-date="16/01/2014" class="cd-h-timeline__date cd-h-timeline__date--selected"><h5>Permohonan</h5></a></li>
                    <li><a href="#0" data-date="28/02/2014" class="cd-h-timeline__date"><h5>Validasi</h5></a></li>
                    <li><a href="#0" data-date="20/04/2014" class="cd-h-timeline__date"><h5>Penjadwalan</h5></a></li>
                    <li><a href="#0" data-date="20/05/2014" class="cd-h-timeline__date"><h5>Kirim Sample</h5></a></li>
                    <li><a href="#0" data-date="09/07/2014" class="cd-h-timeline__date"><h5>Proses</h5></a></li>
                    <li><a href="#0" data-date="30/08/2014" class="cd-h-timeline__date"><h5>Selesai</h5></a></li>
                  </ol>

                  <span class="cd-h-timeline__filling-line" aria-hidden="true"></span>
                </div>
              </div>

              <ul>
                <li><a href="#0" class="text-replace cd-h-timeline__navigation cd-h-timeline__navigation--prev cd-h-timeline__navigation--inactive">Prev</a></li>
                <li><a href="#0" class="text-replace cd-h-timeline__navigation cd-h-timeline__navigation--next">Next</a></li>
              </ul>
            </div>

            <div class="cd-h-timeline__events">
              <ol>
                <li class="cd-h-timeline__event cd-h-timeline__event--selected text-component">
                  <div class="cd-h-timeline__event-content container">
                    <h2 class="cd-h-timeline__event-title">Permohonan Pengujian</h2>
                    <p class="cd-h-timeline__event-description color-contrast-medium">
                      Proses pengujian diawali dengan Pelanggan mengajukan permohonan pengujian terlebih dahulu dengan mengisikan data beserta syarat berkas yang diperlukan pada halaman Permohonan Pengujian.
                    </p>
                  </div>
                </li>
                <li class="cd-h-timeline__event text-component">
          <div class="cd-h-timeline__event-content container">
            <h2 class="cd-h-timeline__event-title">Validasi Berkas</h2>
            <p class="cd-h-timeline__event-description color-contrast-medium"> 
              Kemudian Bendahara akan mengecek kelengkapan berkas yang diajukan oleh Pelanggan, setelah berkas dinyatakan lengkap Pelanggan diharuskan melakukan pembayaran terlebih dahulu untuk dapat mendownload File SSRD (Surat Setoran Retribusi Daerah)
            </p>
          </div>
        </li>

        <li class="cd-h-timeline__event text-component">
          <div class="cd-h-timeline__event-content container">
            <h2 class="cd-h-timeline__event-title">Menunggu Penjadwalan</h2>
            <p class="cd-h-timeline__event-description color-contrast-medium"> 
              Setelah pembayaran berhasil dilakukan, maka Pelanggan menunggu tim Laboran untuk menentukan jadwal pelaksanaan pengujian
            </p>
          </div>
        </li>

        <li class="cd-h-timeline__event text-component">
          <div class="cd-h-timeline__event-content container">
            <h2 class="cd-h-timeline__event-title">Mengirimkan Sample Pengujian</h2>
            <p class="cd-h-timeline__event-description color-contrast-medium"> 
              Setelah jadwal pengujian keluar, Pelanggan diharapkan untuk segera mengirimkan sample pengujian ke Kantor Pelayanan Teknis UP4 Bina Marga sebelum tanggal pengujian dilaksanakan. Untuk informasi lebih lanjut mengenai pengiriman sample pengujian mohon menghubungi nomor WA: 081318764633
            </p>
          </div>
        </li>

        <li class="cd-h-timeline__event text-component">
          <div class="cd-h-timeline__event-content container">
            <h2 class="cd-h-timeline__event-title">Proses Pengujian</h2>
            <p class="cd-h-timeline__event-description color-contrast-medium"> 
              Setelah sample pengujian diterima, pengujian akan dilakukan sesuai jadwal yang telah ditentukan sebelumnya. Pelanggan menunggu proses pengujian selesai yang memakan waktu sekitar 3-4 hari kerja.
            </p>
          </div>
        </li>

        <li class="cd-h-timeline__event text-component">
          <div class="cd-h-timeline__event-content container">
            <h2 class="cd-h-timeline__event-title">Pengujian Selesai</h2>
            <p class="cd-h-timeline__event-description color-contrast-medium"> 
              Pengujian dapat dikatakan selesai ketika Pelanggan sudah dapat mendownload Laporan hasil pengujian pada halaman Riwayat Pengujian
            </p>
          </div>
        </li>

              </ol>
            </div>
          </section>
        </div>
      </div>

    </div>
  </section>

</div>

@include('layouts.main.footer')

