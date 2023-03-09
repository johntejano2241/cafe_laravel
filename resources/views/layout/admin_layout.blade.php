<!doctype html>
<html lang="en" dir="ltr">


<head>


    @yield('title')

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="OURSAFE">
    <meta name="author" content="OURSAFE">
    <meta name="keywords" content="OURSAFE">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="/images/brand/favicon.ico" />

    {{-- Jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <!-- BOOTSTRAP CSS -->
    <link id="style" href="/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="/css/style.css" rel="stylesheet" />
    <link href="/css/dark-style.css" rel="stylesheet" />
    <link href="/css/transparent-style.css" rel="stylesheet">
    <link href="/css/skin-modes.css" rel="stylesheet" />



    <!--- FONT-ICONS CSS -->
    <link href="/css/icons.css" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="/colors/color1.css" />

    <style>
        .form-control {
            color: black;
            accent-color: black;
        }

        input[type=search] {
            border: 1px solid gray;
        }


        .table {
            overflow-x: scroll;
            padding: 2em;
            word-break: break-all;

        }
    </style>

</head>

<body class="app sidebar-mini ltr light-mode">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="/images/loader.svg" class="loader-img" alt="Loader">
    </div>


    <!-- PAGE -->
    <div class="page">
        <div class="page-main">


            <!-- app-Header -->
            <div class="app-header header sticky">
                <div class="container-fluid main-container">
                    <div class="d-flex">
                        <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar"
                            href="javascript:void(0)"></a>
                        <!-- sidebar-toggle-->


                        {{--  <a class="logo-horizontal " href="index.html">
                <img src="/images/brand/logo-white.png" class="header-brand-img desktop-logo" alt="logo">
                <img src="/images/brand/logo-white.png" class="header-brand-img light-logo1"
                    alt="logo" style="width: 4em; height: 4em;">
            </a>  --}}


                        <!-- LOGO -->

                        <div class="d-flex order-lg-2 ms-auto header-right-icons">
                            <div class="dropdown d-none">
                                <a href="javascript:void(0)" class="nav-link icon" data-bs-toggle="dropdown">
                                    <i class="fe fe-search"></i>
                                </a>
                                <div class="dropdown-menu header-search dropdown-menu-start">
                                    <div class="input-group w-100 p-2">
                                        <input type="text" class="form-control" placeholder="Search....">
                                        <div class="input-group-text btn btn-primary">
                                            <i class="fe fe-search" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- SEARCH -->
                            <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button"
                                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                                aria-controls="navbarSupportedContent-4" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon fe fe-more-vertical"></span>
                            </button>
                            <div class="navbar navbar-collapse responsive-navbar p-0">
                                <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                                    <div class="d-flex order-lg-2">
                                        <div class="dropdown d-lg-none d-flex">
                                            <a href="javascript:void(0)" class="nav-link icon"
                                                data-bs-toggle="dropdown">
                                                <i class="fe fe-search"></i>
                                            </a>
                                            <div class="dropdown-menu header-search dropdown-menu-start">
                                                <div class="input-group w-100 p-2">
                                                    <input type="text" class="form-control" placeholder="Search....">
                                                    <div class="input-group-text btn btn-primary">
                                                        <i class="fa fa-search" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- SEARCH -->


                                        <!-- SIDE-MENU -->
                                        <div class="dropdown d-flex profile-1">
                                            <a href="javascript:void(0)" data-bs-toggle="dropdown"
                                                class="nav-link leading-none d-flex">
                                                <img src="/images/users/profile.png" alt="profile-user"
                                                    class="avatar  profile-user brround cover-image">
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                <div class="drop-heading">
                                                    <div class="text-center">
                                                        <h5 class="text-dark mb-0 fs-14 fw-semibold">


                                                        @if(session()->has('auth_token'))
                                                            ADMIN
                                                        @endif



                                                        </h5>


                                                    </div>
                                                </div>


                                                <a class="dropdown-item" href="{{ route('admin.logout') }}" style="text-align: center;">
                                                    <i class="dropdown-icon fe fe-alert-circle"></i> Log Out
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /app-Header -->

            <!--APP-SIDEBAR-->
            <div class="sticky">
                <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
                <div class="app-sidebar">
                    <div class="side-header">
                        <a class="header-brand1" href="/admin/dashboard" >

                            <img src="/images/brand/logo.png" class="header-brand-img desktop-logo" alt="logo">
                            <img src="/images/brand/logo.png" class="header-brand-img toggle-logo" alt="logo">
                            <img src="/images/brand/logo.png" class="header-brand-img light-logo" alt="logo">
                            <br>
                            <h1 src="/images/brand/logo.png" class="header-brand-img light-logo1" > <b> OURSAFE </b>  </h1>
                        </a>
                        <!-- LOGO -->
                    </div>


                    <div class="main-sidemenu">
                        <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
                                fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                            </svg></div>
                        <ul class="side-menu">
                            <li class="sub-category">
                                <h3>MAIN</h3>
                            </li>

                            {{--  <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="/admin/dashboard"><i
                                        class="side-menu__icon fe fe-home"></i><span
                                        class="side-menu__label">Dashboard</span></a>
                            </li>  --}}


                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="/admin/trivia"><i
                                        class="side-menu__icon fe fe-package"></i><span
                                        class="side-menu__label">Trivia</span></a>
                            </li>


                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="/admin/quiz"><i
                                        class="side-menu__icon fe fe-printer"></i><span
                                        class="side-menu__label">Quiz</span></a>
                            </li>


                            <li class="sub-category">
                                <h3>Accounts</h3>
                            </li>



                            <li class="slide disabled">
                                <a class="side-menu__item" data-bs-toggle="slide" href="/admin/view-accounts"><i
                                        class="side-menu__icon fe fe-user"></i><span class="side-menu__label">View Players</span></a>
                            </li>

                            <li class="slide disabled">
                                <a class="side-menu__item" data-bs-toggle="slide" href="/admin/setting"><i
                                        class="side-menu__icon fe fe-cpu"></i><span class="side-menu__label">Account
                                        Settings</span></a>
                            </li>


                        </ul>
                        <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg"
                                fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                            </svg></div>
                    </div>
                </div>
                <!--/APP-SIDEBAR-->
            </div>


            @yield('content')



            <!-- FOOTER -->
            <footer class="footer">
                <div class="container">
                    <div class="row align-items-center flex-row-reverse">
                        <div class="col-md-12 col-sm-12 text-center">
                            Copyright © 2022 <a href="javascript:void(0)">OURSAFE</a> All rights reserved.
                        </div>
                    </div>
                </div>
            </footer>
            <!-- FOOTER END -->

        </div>

        <!-- BACK-TO-TOP -->
        <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

        <!-- JQUERY JS -->
        <script src="/js/jquery.min.js"></script>

        <!-- BOOTSTRAP JS -->
        <script src="/plugins/bootstrap/js/popper.min.js"></script>
        <script src="/plugins/bootstrap/js/bootstrap.min.js"></script>

        <!-- SPARKLINE JS-->
        <script src="/js/jquery.sparkline.min.js"></script>

        <!-- Sticky js -->
        <script src="/js/sticky.js"></script>

        <!-- CHART-CIRCLE JS-->
        <script src="/js/circle-progress.min.js"></script>

        <!-- PIETY CHART JS-->
        <script src="/plugins/peitychart/jquery.peity.min.js"></script>
        <script src="/plugins/peitychart/peitychart.init.js"></script>

        <!-- SIDEBAR JS -->
        <script src="/plugins/sidebar/sidebar.js"></script>

        <!-- Perfect SCROLLBAR JS-->
        <script src="/plugins/p-scroll/perfect-scrollbar.js"></script>
        <script src="/plugins/p-scroll/pscroll.js"></script>
        <script src="/plugins/p-scroll/pscroll-1.js"></script>

        <!-- INTERNAL CHARTJS CHART JS-->
        <script src="/plugins/chart/Chart.bundle.js"></script>
        <script src="/plugins/chart/rounded-barchart.js"></script>
        <script src="/plugins/chart/utils.js"></script>

        <!-- INTERNAL SELECT2 JS -->
        <script src="/plugins/select2/select2.full.min.js"></script>

        <!-- INTERNAL Data tables js-->
        <script src="/plugins/datatable/js/jquery.dataTables.min.js"></script>
        <script src="/plugins/datatable/js/dataTables.bootstrap5.js"></script>
        <script src="/plugins/datatable/dataTables.responsive.min.js"></script>



        <!-- INTERNAL APEXCHART JS -->
        <script src="/js/apexcharts.js"></script>
        <script src="/plugins/apexchart/irregular-data-series.js"></script>

        <!-- C3 CHART JS -->
        <script src="/plugins/charts-c3/d3.v5.min.js"></script>
        <script src="/plugins/charts-c3/c3-chart.js"></script>

        <!-- CHART-DONUT JS -->
        <script src="/js/charts.js"></script>

        <!-- INTERNAL Flot JS -->
        {{-- <script src="/plugins/flot/jquery.flot.js"></script>
    <script src="/plugins/flot/jquery.flot.fillbetween.js"></script>
    <script src="/plugins/flot/chart.flot.sampledata.js"></script>
    <script src="/plugins/flot/dashboard.sampledata.js"></script> --}}

        <!-- INTERNAL Vector js -->
        <script src="/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

        <!-- SIDE-MENU JS-->
        <script src="/plugins/sidemenu/sidemenu.js"></script>

        <!-- INTERNAL INDEX JS -->
        {{-- <script src="/js/index1.js"></script> --}}

        <!-- Color Theme js -->
        <script src="/js/themeColors.js"></script>






        <!-- FORM WIZARD JS-->
        <script src="/plugins/formwizard/jquery.smartWizard.js"></script>
        <script src="/plugins/formwizard/fromwizard.js"></script>

        <!-- INTERNAl Jquery.steps js -->
        <script src="/plugins/jquery-steps/jquery.steps.min.js"></script>
        {{-- <script src="/plugins/parsleyjs/parsley.min.js"></script> --}}



        <!-- INTERNAL Accordion-Wizard-Form js-->
        <script src="/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js"></script>
        <script src="/js/form-wizard.js"></script>

        <!-- FILE UPLOADES JS -->
        <script src="/plugins/fileuploads/js/fileupload.js"></script>
        <script src="/plugins/fileuploads/js/file-upload.js"></script>

        <!-- INTERNAL File-Uploads Js-->
        <script src="/plugins/fancyuploder/jquery.ui.widget.js"></script>
        <script src="/plugins/fancyuploder/jquery.fileupload.js"></script>
        <script src="/plugins/fancyuploder/jquery.iframe-transport.js"></script>
        <script src="/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>
        <script src="/plugins/fancyuploder/fancy-uploader.js"></script>


        <!-- Data Table JS -->
        {{-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
 --}}

        <!-- DATA TABLE JS-->
        <script src="/plugins/datatable/js/jquery.dataTables.min.js"></script>
        <script src="/plugins/datatable/js/dataTables.bootstrap5.js"></script>
        <script src="/plugins/datatable/js/dataTables.buttons.min.js"></script>
        <script src="/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
        {{-- <script src="/plugins/datatable/js/jszip.min.js"></script>
    <script src="/plugins/datatable/pdfmake/pdfmake.min.js"></script>
    <script src="/plugins/datatable/pdfmake/vfs_fonts.js"></script>
    <script src="/plugins/datatable/js/buttons.html5.min.js"></script>
    <script src="/plugins/datatable/js/buttons.print.min.js"></script>
    <script src="/plugins/datatable/js/buttons.colVis.min.js"></script> --}}
        {{-- <script src="/plugins/datatable/dataTables.responsive.min.js"></script> --}}
        <script src="/plugins/datatable/responsive.bootstrap5.min.js"></script>
        <script src="/js/table-data.js"></script>



        <!-- CUSTOM JS -->
        <script src="/js/custom.js"></script>


        <!-- CUSTOM JS -->
        <script src="/js/custom.js"></script>


        <script>
            $('form').submit(function() {
                $(this).find("button[type='submit']").prop('disabled', true);
            });

            $("table").DataTable({
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false
                }]
            });

        </script>



</body>

</html>
