@extends('/layout.admin_layout')

@section('content')




@section('content')

<style type="text/css">
	togglePassword:hover, togglePassword2:hover{
       cursor: pointer;
	}
</style>

    <!--app-content open-->

    <div class="main-container container-fluid">
        <div class="main-content app-content mt-0">


            <div class="page-header">
                <h1 class="page-title">Dashboard</h1>

                @if (Session::get('successs'))

                <div class"alert alert-success">
                   {{ Session::get('success') }}
                 </div>

               @endif

               @if (Session::get('fail'))

                 <div class-"alert alert-danger">
                   {{ Session::get('fail') }}
                 </div>

               @endif

                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/office/dashboard">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Account Settings</li>
                    </ol>
                </div>
            </div>


            <div class="row" style="margin: auto; padding: auto;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="mt-2">
                                            <h6 class="">Total Users</h6>
                                            <h2 class="mb-0 number-font">{{ $userAccounts or 0 }}</h2>
                                        </div>
                                        <div class="ms-auto">
                                            <div class="chart-wrapper mt-1">
                                                <canvas id="saleschart"
                                                    class="h-8 w-9 chart-dropshadow"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="mt-2">
                                            <h6 class="">Total Profit</h6>
                                            <h2 class="mb-0 number-font">67,987</h2>
                                        </div>
                                        <div class="ms-auto">
                                            <div class="chart-wrapper mt-1">
                                                <canvas id="leadschart"
                                                    class="h-8 w-9 chart-dropshadow"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-muted fs-12"><span class="text-pink"><i
                                                class="fe fe-arrow-down-circle text-pink"></i> 0.75%</span>
                                        Last 6 days</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="mt-2">
                                            <h6 class="">Total Expenses</h6>
                                            <h2 class="mb-0 number-font">$76,965</h2>
                                        </div>
                                        <div class="ms-auto">
                                            <div class="chart-wrapper mt-1">
                                                <canvas id="profitchart"
                                                    class="h-8 w-9 chart-dropshadow"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-muted fs-12"><span class="text-green"><i
                                                class="fe fe-arrow-up-circle text-green"></i> 0.9%</span>
                                        Last 9 days</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>




            <div class="row" >
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-body">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">

                                        <h3>Recent Registered Accounts</h3>

                                        <div class="card-body">

                                            <div >
                                                <table class="table table-bordered border text-nowrap mb-0">

                                                    <thead>
                                                        <tr>

                                                            <th style="width: 15%">ID</th>
                                                            <th style="width: 15%">FIRST NAME</th>
                                                            <th style="width: 15%">LAST NAME</th>
                                                            <th style="width: 15%">GENDER</th>
                                                            <th style="width: 15%">BIRTHDATE</th>

                                                            {{--  <th style="width:10%" class="datatable-nosort"></th>  --}}

                                                        </tr>
                                                    </thead>

                                                    <tbody>


                                                        @foreach ($userAccounts as $userAccount)
                                                            <tr>

                                                                <td>{{ Str::limit($userAccount->account_id, 25) }}</td>

                                                                <td>{{ $userAccount->first_name }}</td>

                                                                <td>{{ $userAccount->last_name }}</td>

                                                                <td>{{ $userAccount->gender }}</td>

                                                                <td>{{ $userAccount->birthdate }}</td>



                                                            </tr>
                                                        @endforeach



                                                    </tbody>

                                                </table>



                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>

                    </div>



                    <script>
                        const togglePassword = document.querySelector("#togglePassword");
                        const password = document.querySelector("#password");


                        const togglePassword2 = document.querySelector("#togglePassword2");
                        const password2 = document.querySelector("#passwordnew");

                        togglePassword.addEventListener("click", function () {
                            // toggle the type attribute
                            const type = password.getAttribute("type") === "password" ? "text" : "password";
                            password.setAttribute("type", type);

                            // toggle the icon
                            this.classList.toggle("bi-eye");
                        });

                        togglePassword2.addEventListener("click", function () {
                            // toggle the type attribute
                            const type2 = password2.getAttribute("type") === "password" ? "text" : "password";
                            password2.setAttribute("type", type2);

                            // toggle the icon
                            this.classList.toggle("bi-eye");
                        });


                    </script>






                        </form>

                </div>


            </div>



        </div>






    </div>


@endsection



