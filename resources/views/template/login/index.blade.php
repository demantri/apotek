<!doctype html>
<html lang="en">
  <head>
  	<title>Login | Apotek</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="{{ asset('template/login/css/style.css') }}">

    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>


	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			{{-- <div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Login #04</h2>
				</div>
			</div> --}}
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="img">
                            <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_u1vbg6qk.json" background="transparent" speed="1" style="width: 100%; height: 100%;"  loop autoplay></lottie-player>    
			            </div>
						<div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100 justify-content-center">
                                    <h3 class="mb-4">Aplikasi SIM Apotek</h3>
                                </div>
			      	        </div>

                            @if (Session::has('error'))
                                <div id="notif">
                                    <div class="alert alert-danger mt-4" role="alert">
                                        {{ Session::get('error') }}
                                    </div>
                                </div>
                            @endif
							<form action="{{ url('/login') }}" id="form" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Username</label>
                                    <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
                                </div>
                                {{-- <div class="form-group d-md-flex">
                                    <div class="w-50 text-left">
                                        <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="w-50 text-md-right">
                                        <a href="#">Forgot Password</a>
                                    </div>
                                </div> --}}
		                    </form>
		                    {{-- <p class="text-center">Not a member? <a data-toggle="tab" href="#signup">Sign Up</a></p> --}}
		                </div>
		            </div>
				</div>
			</div>
		</div>
	</section>

	<script src="{{ asset('template/login/js/jquery.min.js') }}"></script>
    <script src="{{ asset('template/login/js/popper.js') }}"></script>
    <script src="{{ asset('template/login/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/login/js/main.js') }}"></script>

	</body>
</html>

