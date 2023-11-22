<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Janitorial Services | Clear Choice Janitorial</title>
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/assets/admin-plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin-css/auth.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin-css/responsive.css') }}">
    <script src="{{ asset('public/assets/admin-js/jquery-3.7.0.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/admin-plugins/bootstrap/js/bootstrap.bundle.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('public/assets/admin-js/function.js') }}" type="text/javascript"></script>
</head>

<body>
    <div class="auth-section auth-height">
        <div class="auth-bg-video">
            <video id="background-video" autoplay loop muted
                poster="{{ asset('assets/admin-images/Janitorial-Cleaning-Video-1.mp4') }}">
                <source src="{{ asset('public/assets/admin-images/Janitorial-Cleaning-Video-1.mp4') }}"
                    type="video/mp4">
            </video>
        </div>
        <div class="auth-content-card"> 
            <div class="container">
                <div class="auth-card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="auth-content">
                                <div class="auth-content-info">
                                    <h2>Secure Access Portal</h2>
                                    <p>Unlock The Power Of Seamless And Protected Interaction With Your Intuitive Admin
                                        Panel.</p>

                                    <div class="auth-illustration">
                                        <img src="{{ asset('public/assets/admin-images/Admin-amico.svg') }}"
                                            alt="" height="330">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 auth-form-info">
                            <div class="auth-form">
                                <div class="brand-logo">
                                    <img src="{{ asset('public/assets/admin-images/logo.webp') }}" alt="logo">
                                </div>
                                <h2>Admin Login</h2>
                                <p>To Get Into Clear Choice Janitorial Control Panal</p>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control  @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autocomplete="email"
                                            autofocus placeholder="Email Address">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password" placeholder="Password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button class="auth-form-btn">Login</button>
                                    </div>

                                    <div class="mt-1 forgotpsw-text">
                                        <a href="javascript:void(0);">I forgot my password</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
