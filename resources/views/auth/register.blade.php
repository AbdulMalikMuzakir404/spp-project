<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPP | Register</title>

    {{-- bootstrap css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    {{-- icon web app --}}
    <link rel="shortcut icon" href="{{ asset('storage/images/logo_aplikasi.png') }}">

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('aa/fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('aa/css/style.css') }}">

    {{-- bootstrap icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    {{-- Link CSS Toastr --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Plugin JqueryCDN --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    {{-- Plugin Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('template/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <h5 class="login-box-msg mb-3">REGISTERATION</h5>

                <form action="{{ route('register') }}" method="post">
                    @csrf

                    <div class="px-2">
                        <div class="form-group">
                            <label for="nama"><i class="bi bi-person"></i></label>
                            <input type="text" class="@error('nama') is-invalid @enderror" id="nama"
                                name="nama" value="{{ old('nama') }}" placeholder="Nama" required
                                autocomplete="on" autofocus>
                            @error('nama')
                                <script>
                                    toastr.error("{{ $message }}")
                                </script>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="bi bi-envelope"></i></label>
                            <input type="email" class="@error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}" placeholder="Email" required
                                autocomplete="on">
                            @error('email')
                                <script>
                                    toastr.error("{{ $message }}")
                                </script>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username"><i class="bi bi-person-circle"></i></label>
                            <input type="text" class="@error('username') is-invalid @enderror" id="username"
                                name="username" value="{{ old('username') }}" placeholder="Username" required
                                autocomplete="off">
                            @error('username')
                                <script>
                                    toastr.error("{{ $message }}")
                                </script>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password"><i class="bi bi-lock"></i></label>
                            <input type="password" class="@error('password') is-invalid @enderror" id="password"
                                name="password" value="{{ old('password') }}" placeholder="Password" required
                                autocomplete="off">
                            @error('password')
                                <script>
                                    toastr.error("{{ $message }}")
                                </script>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation"><i class="bi bi-lock"></i></label>
                            <input type="password" class="@error('password_confirmation') is-invalid @enderror" id="password_confirmation"
                                name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Password Confirm" required
                                autocomplete="new-password">
                            @error('password_confirmation')
                                <script>
                                    toastr.error("{{ $message }}")
                                </script>
                            @enderror
                        </div>
                    </div>

                    {{-- <div class="input-type-group px-2 mt-3 mb-3">
                        {!! NoCaptcha::renderJs('en', false, 'onloadCallback') !!}
                        {!! NoCaptcha::display(['data-theme' => 'light']) !!}
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="help-block">
                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                            </span>
                        @endif
                    </div> --}}

                    <div class="px-2 mt-3">
                        <button type="submit" style="background: #2F5D62; color: rgb(255, 255, 255);"
                            class="btn-block mx-auto rounded-pill">Continue</button>
                    </div>

                </form>

                @if (Route::has('login'))
                    <a class="btn btn-link" href="{{ route('register') }}">
                        {{ __('Back to Login Page?') }}
                    </a>
                @endif

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>


    {{-- script bootsrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
        integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous">
    </script>

    <!-- JS -->
    <script src="{{ asset('aa/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('aa/js/main.js') }}"></script>

    {{-- onload reaptha --}}
    <script>
        let onloadCallback = function() {
            alert("grecaptcha is ready!");
        };
    </script>
    <!-- jQuery -->
    <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>

    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}")
        @endif

        @if (Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}")
        @endif

        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}")
        @endif
    </script>

    <!-- jQuery -->
    <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('template/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
