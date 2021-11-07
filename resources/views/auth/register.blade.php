{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> --}}
<!------ Include the above in your HEAD tag ---------->
<!DOCTYPE html>
<html>
    
<head>
    <style>
        /* Coded with love by Mutiullah Samim */
    body,
    html {
        margin: 0;
        padding: 0;
        height: 100%;
        background: #2A3F54 !important;
    }
    .user_card {
        height: 600px;
        width: 350px;
        margin-top: auto;
        margin-bottom: auto;
        background: #F7F7F7;
        position: relative;
        display: flex;
        justify-content: center;
        flex-direction: column;
        padding: 10px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        -moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-radius: 5px;

    }
    .brand_logo_container {
        position: absolute;
        height: 170px;
        width: 170px;
        top: -75px;
        border-radius: 50%;
        background: #2A3F54;
        padding: 10px;
        text-align: center;
    }
    .brand_logo {
        height: 150px;
        width: 150px;
        border-radius: 50%;
        border: 2px solid #F7F7F7;
    }
    .form_container {
        margin-top: 100px;
    }
    .login_btn {
        width: 100%;
        background: #2A3F54 !important;
        color: #F7F7F7 !important;
    }
    .login_btn:focus {
        box-shadow: none !important;
        outline: 0px !important;
    }
    .login_container {
        padding: 0 2rem;
    }
    .input-group-text {
        background: #2A3F54 !important;
        color: #F7F7F7 !important;
        border: 0 !important;
        border-radius: 0.25rem 0 0 0.25rem !important;
    }
    .input_user,
    .input_pass:focus {
        box-shadow: none !important;
        outline: 0px !important;
    }
    .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
        background-color: #2A3F54 !important;
    }
</style>
	<title>Register</title>
  <link rel="icon" href="{{ asset('images/logoku.png') }}" type="image/x-icon">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>
<!--Coded with love by Mutiullah Samim-->
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="{{ asset('images/login.png') }}" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form method="POST" action="{{ route('register') }}">
                        @csrf
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="name" class="form-control input_user @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="{{ __('Full Name') }}">
                            
                            @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
						</div>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user-lock"></i></span>
							</div>
							<input type="text" name="username" required class="form-control input_user noSpace @error('username') is-invalid @enderror" value="{{ old('username') }}" placeholder="{{ __('Username') }}">
                            
                            @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
						</div>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-at"></i></span>
							</div>
							<input type="email" name="email" class="form-control input_user @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="{{ __('Email') }}">
                            
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
						</div>
                        <div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control input_pass @error('password') is-invalid @enderror" value="" placeholder="{{ __('Password') }}">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-globe-asia"></i></span>
							</div>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" required placeholder="Tempat Lahir">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
							</div>
                            <input type="text" id="tanggal_lahir" autocomplete="off" name="tanggal_lahir" class="form-control date disabled" required placeholder="Tanggal Lahir">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
							</div>
                            <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" required>
                                <option value="" selected disabled>Jenis Kelamin</option>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="submit" name="button" class="btn login_btn">Register</button>
				   </div>
					</form>
				</div>
		
				<div class="mt-4">
                    @if (Route::has('register'))
					<div class="d-flex justify-content-center links">
						Already have an account? <a href="{{ url('/login') }}" class="ml-2">Sign In</a>
					</div>
                    @endif
                    @if (Route::has('password.request'))
					<div class="d-flex justify-content-center links">
						<a href="{{ route('password.request') }}">Forgot your password?</a>
					</div>
                    @endif
				</div>
			</div>
		</div>
	</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('.date').datepicker({});
            $('.disabled').keypress(function(e) {
                return false
            });

            $('.noSpace').keydown(function(event) {
                if (event.keyCode == '32') {
                    event.preventDefault();
                }
            });
        })
    </script>
</body>
</html>
