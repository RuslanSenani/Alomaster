<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alo Master | Qeydiyyat Səhifəsi</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset("assets")}}/vendor/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset("assets")}}/vendor/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("assets")}}/dist/css/adminlte.min.css">

</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        <b>Alo Master </b>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Yeni üzvlük üçün qeydiyyatdan keçin</p>
            @if(session('status'))
                <div class="alert alert-success text-center">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="input-group mb-3">
                    <input type="text"
                           name="username"
                           class="form-control @error('username') is-invalid @enderror"
                           value="{{ old('username') }}"
                           placeholder="User Name"
                           required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="{{old("name")}}" name="name" placeholder="Full name">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{old("email")}}" name="email" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password" class="form-control" value="{{old("password")}}" name="password"
                           id="password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text" id="toggle-password">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" value="{{old("password_confirmation")}}" name="password_confirmation"
                           class="form-control" placeholder="Confirm Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8">

                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Qeyd Ol</button>
                    </div>
                    <!-- /.col -->
                </div>
                {{--                <div class="row">--}}
                {{--                    <div class="col-8">--}}

                {{--                    </div>--}}
                {{--                    <div class="col-4">--}}
                {{--                        <div class="card card-secondary">--}}
                {{--                            <div class="card-body">--}}
                {{--                                <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch--}}
                {{--                                       data-off-color="danger" data-on-color="success">--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}

                {{--                </div>--}}
            </form>

            <a href="{{Route("login")}}" class="text-center">Artıq üzvlüyüm var</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include('sweetalert::alert')
<!-- jQuery -->
<script src="{{asset("assets")}}/vendor/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset("assets")}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset("assets")}}/dist/js/adminlte.min.js"></script>
<script src="{{asset("assets")}}/custom/js/hideAndShowPassword.js"></script>
<script src="{{asset("assets")}}/vendor/bootstrap-switch/js/bootstrap-switch.min.js"></script>
</body>
</html>



