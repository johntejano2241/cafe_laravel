@extends('/layout.admin_layout')



@section('title')
    <title>VIEW ACCOUNTS</title>
@endsection


@section('content')
    <!--app-content open-->

    <div class="main-container container-fluid">
        <div class="main-content app-content mt-0">





            <div class="page-header">
                <h1 class="page-title">View Players</h1>

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
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Trivia</li>
                    </ol>

                </div>
            </div>



            <div class="row" style="display: flex; justify-content: center; align-items: center;">

                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="mt-2">
                                    <h6 class="">Total Users</h6>
                                    <h2 class="mb-0 number-font">{{ $totalUsers }}</h2>
                                </div>
                                <div class="ms-auto">
                                    <div class="chart-wrapper mt-1">
                                        <img src="/images/png/people-icon.png" width="50" height="50" alt="People">
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
                                    <h6 class="">Male Users</h6>
                                    <h2 class="mb-0 number-font">{{ $totalMale }}</h2>
                                </div>
                                <div class="ms-auto">
                                    <div class="chart-wrapper mt-1">
                                        <img src="/images/png/male-icon.png" width="50" height="50" alt="Male">
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
                                    <h6 class="">Female Users</h6>
                                    <h2 class="mb-0 number-font">{{ $totalFemale }}</h2>
                                </div>
                                <div class="ms-auto">
                                    <div class="chart-wrapper mt-1">
                                        <img src="/images/png/female-icon.png" width="45" height="45" alt="Female">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>


            <div class="col-md-12 col-xl-6">

                {{-- Delete --}}

                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 id="tModal" class="modal-title">Delete</h5>
                                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>

                            <form action="{{ route('delete.trivia') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <p>Do you want really to delete?</p>
                                    <input type="text" id="deleteId" name="deleteId" hidden>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger center">Confirm to Delete</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>


                <br>






            </div>






            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-body">

                            <div class="table-responsive">
                                <table id="table" class="table table-bordered border text-nowrap mb-0">

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

        <script>
            $("#addButton").click(function() {
                $(".modal-header #tModal").text("Add Trivia");
                $('#id').val(null);
                $('#triviaForm').val(null);


            });





            // Edit Button
            $("#table tbody").on("click", ".editButton", function() {
                var id = $(this).data('id');
                $(".modal-header #tModal").text("Update Trivia");

                if (id != null) {

                    $(".modal-header #tModal").text("Update Trivia");

                    var trivia = $(this).data('trivia');

                    $('#id').val(id);
                    $('#triviaForm').val(trivia);



                }


            });

            // Delete Button
            $("#table tbody").on("click", ".deleteButton", function() {

                var deleteRowId = $(this).data('did');


                if (deleteRowId != null) {
                    $('#deleteId').val(deleteRowId);
                    console.log(deleteRowId);
                }

            });



            // onclick function edit button
        </script>
    </div>


    <!-- Country-selector modal-->
@endsection
