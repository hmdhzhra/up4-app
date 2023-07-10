@include('layouts.auth.header')

<!-- <body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <img src="/assets/dist/img/logo.jpg" alt="Logo" height="270" width="270" class="brand-image">
    </div> -->

<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>UP4</b>APP</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Daftarkan Akun Baru</p>

      <form action="/register" method="post">
        @csrf 
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control @error('username')is-invalid @enderror" placeholder="User Name" required value="{{ old('username') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>

          @error('username')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control @error('email')is-invalid @enderror" placeholder="Email" required value="{{ old('email') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>

          @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="input-group mb-3">
          <input id="password" type="password" name="password" class="form-control @error('password')is-invalid @enderror" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>

          @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input id="password" type="password" name="password_confirmation" class="form-control @error('password_confirmation')is-invalid @enderror" placeholder="Ulangi password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>

          @error('password_confirmation')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>

          <div class="col-14 mb-0">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <small class="d-block text-center mb-3">Sudah punya akun? <a href="/">Login</a>
        </small>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

@include('layouts.auth.footer')
