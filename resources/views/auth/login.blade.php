<!DOCTYPE html>
<html lang="en">
<head>
	<title>SPP | Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- bootstrap css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    {{-- icon web app --}}
    <link rel="shortcut icon" href="{{ asset('storage/images/logo_aplikasi.png') }}">


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


<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login_asset/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login_asset/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login_asset/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login_asset/vendor/animate/animate.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login_asset/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login_asset/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login_asset/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login_asset/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login_asset/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('login_asset/css/main.css') }}">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form action="{{ route('login') }}" method="post" class="login100-form validate-form">
					@csrf
                    <span class="login100-form-title p-b-43">
						Login
					</span>

                    <div class="container d-flex justify-content-center">
                        <div class="row-auto">
                            <div class="col-auto">
                                <figure><img src="{{ asset('storage/images/logo_aplikasi.png') }}" alt="logo"
                                    class="rounded-circle img-responsive" width="150" height="150"></figure>
                            </div>
                        </div>
                    </div>

                    <div class="container d-flex justify-content-center mb-5">
                        <div class="row-auto">
                            <div class="col-auto">
                                <p class="login-box-msg mb-3 text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim,
                                    ducimus.</p>
                            </div>
                        </div>
                    </div>


					<div class="wrap-input100">
						<input class="input100 @error('username') is-invalid @enderror" type="text" name="username" value="{{ old('username') }}" required autocomplete="off" autofocus>
						<span class="focus-input100"></span>
						<span class="label-input100">Username</span>
                        @error('username')
                            <script>
                                toastr.error("{{ $message }}")
                            </script>
                        @enderror
					</div>


					<div class="wrap-input100">
						<input class="input100 @error('password') is-invalid @enderror" type="password" name="password"required autocomplete="current-password">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
                        @error('password')
                            <script>
                                toastr.error("{{ $message }}")
                            </script>
                        @enderror
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link txt1" href="{{ route('password.request') }}">
                                    {{ __('Forgot password?') }}
                                </a>
                            @endif
						</div>
					</div>


					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Masuk
						</button>
					</div>

                    <div class="mt-3 container-login100-form-btn">
						<a href="{{ route('loginSiswa') }}" class="login100-form-btn">
							Masuk Sebagai Siswa
                        </a>
					</div>
				</form>

				<div class="login100-more" style="background-image: url('{{ asset('storage/images/image_sekolah.jpg') }}');">
				</div>
			</div>
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




<!--===============================================================================================-->
	<script src="{{ asset('login_asset/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('login_asset/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('login_asset/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('login_asset/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('login_asset/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('login_asset/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('login_asset/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('login_asset/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('login_asset/js/main.js') }}"></script>

</body>
</html>
