<!doctype html>
<html lang="en" dir="ltr">



<head>


    <style type="text/css">
        #togglePassword:hover,
        #togglePassword2:hover {
            cursor: pointer;
        }
    </style>

    <script>
        if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_BACK_FORWARD) {
            history.go(-1);
        }
    </script>


    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="DENR MCD">
    <meta name="author" content="El Kyzer">
    <meta name="keywords" content="DENR MCD">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="/images/brand/favicon.ico" />

    <!-- TITLE -->
    <title>OURSAFE Login</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- STYLE CSS -->
    <link href="/css/style.css" rel="stylesheet" />
    <link href="/css/dark-style.css" rel="stylesheet" />
    <link href="/css/transparent-style.css" rel="stylesheet">
    <link href="/css/skin-modes.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="/css/icons.css" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="/colors/color1.css" />

    <div id="global-loader">
        <img src="/images/loader.svg" class="loader-img" alt="Loader">
    </div>


    <style>
        .mybg1 {
            background-image: url('/images/media/bg-img1.jpg');
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
        }


        #g-recaptcha-response {
            display: block !important;
            position: absolute;
            margin: -78px 0 0 0 !important;
            width: 302px !important;
            height: 76px !important;
            z-index: -999999;
            opacity: 0;
        }
    </style>

</head>


<body class="app sidebar-mini ltr">



    <!-- BACKGROUND-IMAGE -->
    <div class="mybg1">

        <!-- GLOABAL LOADER -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">

                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto mt-7">
                    <div class="text-center">
                        <h1 style="color:white;"> <b>OURSAFE</b> </h1>
                    </div>
                </div>

                <div class="container-login100">

                    <form action="{{ route('admin.login') }}" method="POST">
                        @csrf

                        <div class="wrap-login100 p-6">
                            <form class="login100-form validate-form">
                                <span class="login100-form-title pb-5">
                                    Login
                                </span>


                                <div class="panel panel-primary">
                                    <div class="tab-menu-heading">

                                    </div>
                                    <div class="panel-body tabs-menu-body p-0 pt-5">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab5">



                                                @if (session('fail'))
                                                    <div class="alert alert-danger">
                                                        {{ session('fail') }}
                                                    </div>

                                                    @endif



                                                @if (isset($message))
                                                    <div class="alert alert-danger">

                                                        @error('password')
                                                            {{ $message }}
                                                        @enderror
                                                        @error('email')
                                                            {{ $message }}
                                                        @enderror


                                                    </div>
                                                @endif


                                                <div class="wrap-input100 validate-input input-group"
                                                    data-bs-validate="Valid username is required: sample">
                                                    <a class="input-group-text bg-white text-muted">
                                                        <i class="zmdi zmdi-account text-muted" aria-hidden="true"></i>
                                                    </a>
                                                    <input class="input100 border-start-0 form-control ms-0"
                                                        type="text" placeholder="Username" name="username"
                                                        value="{{ old('username') }}" required>
                                                    <br>
                                                </div>

                                                <div class="wrap-input100 validate-input input-group">
                                                    <a class="input-group-text bg-white text-muted">
                                                        <i class="zmdi zmdi-key text-muted" aria-hidden="true"
                                                            disabled></i>
                                                    </a>

                                                    <input class="input100 border-start-0 form-control ms-0"
                                                        id="password" type="password" placeholder="Password"
                                                        name="password" value="{{ old('password') }}" required>

                                                    <i class="bi bi-eye-slash" id="togglePassword"
                                                        style="right:15px;
                                                position:absolute; bottom: 12px; color: black;"></i>
                                                    <br>



                                                </div>
                                                {{--  6LcPDkoiAAAAADDCN6euBftKBntuePSdY0Y6so7m  --}}
                                                <div class="g-recaptcha" data-sitekey=""></div>

                                                <div class="container-login100-form-btn">


                                                        <button type="submit" class="login100-form-btn btn-dark">
                                                            Login
                                                        </button>
                                                        </div>

                            </form>


                        </div>

                </div>

            </div>
        </div>
    </div>

    </form>
    </div>
    </div>
    <!-- CONTAINER CLOSED -->
    </div>
    </div>
    <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="/plugins/bootstrap/js/popper.min.js"></script>
    <script src="/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- SHOW PASSWORD JS -->
    <script src="/js/show-password.min.js"></script>


    <!-- Color Theme js -->
    <script src="/js/themeColors.js"></script>

    <!-- CUSTOM JS -->
    <script src="/js/custom.js"></script>

    <script>

                window.onload = function() {
                    var $recaptcha = document.querySelector('#g-recaptcha-response');

                    if ($recaptcha) {
                        $recaptcha.setAttribute("required", "required");
                    }
                };


                var onloadCallback = function() {

                };

        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");


        togglePassword.addEventListener("click", function() {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            // toggle the icon
            this.classList.toggle("bi-eye");

        });
    </script>


</body>

</html>
