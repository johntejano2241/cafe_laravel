@extends('/layout.admin_layout')


@section('title')
 <title>TRIVIA</title>
@endsection

@section('content')
    <!--app-content open-->

    <div class="main-container container-fluid">
        <div class="main-content app-content mt-0">


            <div class="page-header">
                <h1 class="page-title">Trivia</h1>

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




                <!-- Modal Add Trivia-->
                <div class="modal fade" id="showModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">


                        <div class="modal-content">
                            <div class="modal-header">

                                <h5 id="tModal" class="modal-title">Add Trivia</h5>
                                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="card">
                                    <div class="card-body" style="background-color: #f0f2f5;">



                                        {{-- Add Trivia --}}
                                        <div class="">
                                            <form action="{{ route('create.trivia') }}" method="POST">
                                                @csrf



                                                <span class="text-danger">
                                                    @error('reportId')
                                                        {{ $message }}
                                                    @enderror
                                                </span>

                                                {{-- Year --}}
                                                <div class="form-group">



                                                    <input type="hidden" class="form-control" id="id"
                                                      name="id">


                                                    <span class="text-danger">
                                                        @error('labelForm')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>



                                                {{-- Details --}}
                                                <div class="form-group">

                                                    <label for="triviaForm" class="form-label"><b>Trivia</b></label>

                                                    <div class="col-lg">
                                                        <textarea class="form-control mb-4" placeholder="Details" id="triviaForm" name="triviaForm" rows="4"
                                                            value="{{ old('triviaForm') }}" maxlength="255" required></textarea>
                                                    </div>


                                                    <span class="text-danger">
                                                        @error('triviaForm')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>

                                                </div>




                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
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


            <br>



            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-body">

                            <div style="margin-bottom: 1em;">

                                <button id="addButton" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#showModal">Add
                                    Trivia</button>

                            </div>



                            <div class="table-responsive">
                                <table id="table" class="table table-bordered border text-nowrap mb-0">

                                    <thead>
                                        <tr>

                                            <th style="width:50%">Trivia</th>
                                            <th style="width:40%">Date Created</th>

                                            <th style="width:10%" class="datatable-nosort"></th>

                                        </tr>
                                    </thead>

                                    <tbody>


                                        @foreach ($allTrivias as $allTrivia)
                                            <tr>

                                                <td>{{ Str::limit($allTrivia->trivia, 25) }}</td>

                                                <td>{{ $allTrivia->date_created }}</td>
                                                <td>

                                                    <button class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                                        data-bs-original-title="Edit">

                                                        <span id="editButton_{{ $allTrivia->id }}"
                                                            class="fe fe-edit fs-14 editButton" data-bs-toggle="modal"
                                                            data-bs-target="#showModal"
                                                            data-id="{{ $allTrivia->id }}"
                                                            data-trivia="{{ $allTrivia->trivia }}"
                                                       ></span>

                                                    </button>



                                                    <button class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                                        data-bs-original-title="Delete">

                                                        <span id="deleteButton_{{ $allTrivia->id }}"
                                                            data-did="{{ $allTrivia->id }}"
                                                            class="fe fe-trash-2 fs-14 deleteButton"
                                                            data-bs-toggle="modal" data-bs-target="#deleteModal"></span>
                                                    </button>

                                                </td>

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
