@extends('/layout.admin_layout')




@section('title')
 <title>SETTING</title>
@endsection


@section('content')



    <style type="text/css">
        #togglePassword:hover,
        #togglePassword2:hover {
            cursor: pointer;
        }
    </style>

    <!--app-content open-->

    <div class="main-container container-fluid">
        <div class="main-content app-content mt-0">


            <div class="page-header">
                <h1 class="page-title">Account Settings - ADMIN</h1>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('fail'))
                    <div class="alert alert-danger">
                        {{ $errors }}
                    </div>
                @endif

                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/office/dashboard">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Account Settings</li>
                    </ol>
                </div>
            </div>




            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-body">
                            <form autocomplete="off" action="{{ route('admin.update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col">

                                        <label for="username" class="form-label"><b>Current Username</b></label>

                                        <input type="text" class="form-control" id="email" placeholder="Ex. Admin"
                                            name="username" value="" required>
                                        <span class="text-danger">
                                            @error('username')
                                                {{ $message }}
                                            @enderror
                                        </span>

                                    </div>

                                    <div class="col">


                                        <label for="password" class="form-label"><b>Current Password</b></label>
                                        <div class="input-group">

                                            <input type="password" class="form-control" id="password" placeholder=""
                                                name="password" value="" required>

                                            <i class="bi bi-eye-slash" id="togglePassword"
                                                style="right:20px;
                                    position:absolute; bottom: 7px;"></i>
                                            <span class="text-danger">
                                                @error('password')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>

                                    </div>

                                </div>

                                <br>

                                <div class="row">
                                    <div class="col">

                                        <label for="newUsername" class="form-label"><b>New Username</b></label>

                                        <input type="text" class="form-control" id="newUsername" placeholder="Ex. Admin"
                                            name="newUsername" value="" required>
                                        <span class="text-danger">
                                            @error('newUsername')
                                                {{ $message }}
                                            @enderror
                                        </span>



                                    </div>


                                    <div class="col">

                                        <label for="newPassword" class="form-label"><b>New Password</b></label>

                                        <div class="input-group">
                                            <input type="password" class="form-control" id="newPassword" placeholder=""
                                                name="newPassword" value="" required>
                                            <i class="bi bi-eye-slash" id="togglePassword2"
                                                style="right:20px;
                                    position:absolute; bottom: 7px;"></i>

                                            <span class="text-danger">
                                                @error('newPassword')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="text-center">
                                    <button id="saveButton" type="submit" class="btn btn-success">Save Information</button>
                                </div>
                            </form>
                        </div>

                    </div>



                    <script>
                        const togglePassword = document.querySelector("#togglePassword");
                        const password = document.querySelector("#password");


                        const togglePassword2 = document.querySelector("#togglePassword2");
                        const password2 = document.querySelector("#passwordnew");

                        togglePassword.addEventListener("click", function() {
                            // toggle the type attribute
                            const type = password.getAttribute("type") === "password" ? "text" : "password";
                            password.setAttribute("type", type);

                            // toggle the icon
                            this.classList.toggle("bi-eye");
                        });

                        togglePassword2.addEventListener("click", function() {
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
