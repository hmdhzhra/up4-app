@include('layouts.auth.header')


<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <img src="/assets/dist/img/logo.jpg" alt="Logo" height="270" width="270" class="brand-image">
    </div>

<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="/" class="h1"><b>UP4</b>APP</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">LOGIN</p>

      <form action="/" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="name@example.com" id="email" autofocus required value="{{ old('email') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
            <div class="invalid feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" id="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
              <p>
                <a href="forgot-password.html">Lupa password</a>
              </p>
          </div>
          <!-- /.col -->
          <div class="col-4 mb-3">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

        <small class="d-block text-center">Belum punya akun? <a href="/register">Daftar Akun Baru</a>
        </small>
      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
    
</div>
<!-- /.login-box -->
@if(session()->has('success'))
    <div class="container-fluid">
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('success') }}
      </div>
    </div>
    @endif

@if(session()->has('loginError'))
    <div class="container-fluid">
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('loginError') }}
      </div>
    </div>
    @endif

@if(session()->has('toast_success'))
    <div class="container-fluid">
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('toast_success') }}
      </div>
    </div>
    @endif

@include('layouts.auth.footer')
