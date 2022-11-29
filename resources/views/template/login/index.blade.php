<!doctype html>
<html lang="en">
  <head>
  	<title>Login 01</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="{{ asset('template/login/css/style.css') }}">

	</head>
	<body>
        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center mb-5">
                        {{-- <h2 class="heading-section">Login #01</h2> --}}
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-7 col-lg-5">
                        <div class="login-wrap p-4 p-md-5">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-user-o"></span>
                    </div>
                    <h3 class="text-center mb-4">KlinikU</h3>
                    <form action="/login" method="POST" class="login-form">
                        @csrf
                        @if (Session::has('error'))
                        <div id="notif">
                            <div class="alert alert-danger mt-4" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <input type="text" class="form-control rounded-left @error('username') is-invalid @enderror" placeholder="Username" autofocus value="{{ old('username') }}" name="username">
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control rounded-left @error('password') is-invalid @enderror" placeholder="Password" name="password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary rounded submit px-3">Login</button>
                        </div>
                        <div class="form-group d-md-flex">
                            <div class="w-50">
                                {{-- <label class="checkbox-wrap checkbox-primary">Remember Me --}}
                                    {{-- <input type="checkbox" checked> --}}
                                    {{-- <span class="checkmark"></span> --}}
                                {{-- </label> --}}
                            </div>
                            <div class="w-50 text-md-right">
                                <a href="#">Forgot Password</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <script src="{{ asset('template/login/js/jquery.min.js')}}"></script>
        <script src="{{ asset('template/login/js/popper.js')}}"></script>
        <script src="{{ asset('template/login/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('template/login/js/main.js')}}"></script>

	</body>
</html>