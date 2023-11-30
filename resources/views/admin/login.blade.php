<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Login - Pos admin template</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('admin/assets/img/favicon.png') }}">

    <link rel="stylesheet" href="{{ URL::to('admin/assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ URL::to('admin/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('admin/assets/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ URL::to('admin/assets/css/style.css') }}">
</head>

<body class="account-page">

    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <div class="login-userset">
                        <div class="login-logo">
                            <img src="{{ URL::to('admin/assets/img/logo.png') }}" alt="img">
                        </div>
                        <div class="login-userheading">
                            <h3>Sign In</h3>
                            <h4>Please login to your account</h4>
                        </div>
                        <form action="{{ URL::to('submitLogin') }}" method="POST">
                            @csrf

                            @if (session()->has('message'))
                                <p class="alert alert-danger">{{ session('message') }}</p>
                            @endif

                            <div class="form-login">
                                <label>Email</label>
                                <div class="form-addons">
                                    <input type="text" name="email" value="{{ old('email') }}" placeholder="Enter your email address">
                                    <img src="{{ URL::to('admin/assets/img/icons/mail.svg') }}" alt="img">
                                    @if ($errors->has('email'))
                                    <div class="error text-danger">{{ $errors->first('email') }}</div>
                                @endif

                                </div>
                            </div>
                            <div class="form-login">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input type="password" name="password" class="pass-input"
                                        placeholder="Enter your password" value="{{ old('password') }}">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                                @if ($errors->has('password'))
                                <div class="error text-danger">{{ $errors->first('password') }}</div>
                            @endif
                            </div>
                            <div class="form-login">
                                <div class="alreadyuser">
                                    <h4><a href="forgetpassword.html" class="hover-a">Forgot Password?</a></h4>
                                </div>
                            </div>
                            <div class="form-login">
                                <button class="btn btn-login">Sign In</button>
                            </div>
                            <div class="signinform text-center">
                                <h4>Don’t have an account? <a href="#" class="hover-a">Sign Up</a></h4>
                            </div>
                            <div class="form-setlogin">
                                <h4>Or sign up with</h4>
                            </div>
                            <div class="form-sociallink">
                                <ul>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <img src="{{ URL::to('admin/assets/img/icons/google.png') }}"
                                                class="me-2" alt="google">
                                            Sign Up using Google
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <img src="{{ URL::to('admin/assets/img/icons/facebook.png') }}"
                                                class="me-2" alt="google">
                                            Sign Up using Facebook
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="login-img">
                    <img src="{{ URL::to('admin/assets/img/login.jpg') }}" alt="img">
                </div>
            </div>
        </div>
    </div>


    <script src="{{ URL::to('admin/assets/js/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ URL::to('admin/assets/js/feather.min.js') }}"></script>

    <script src="{{ URL::to('admin/assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ URL::to('admin/assets/js/script.js') }}"></script>
</body>

</html>
