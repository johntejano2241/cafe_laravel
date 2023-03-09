@extends('/layout.admin_layout')





@section('title')
 <title>QUIZ</title>
@endsection


@section('content')
    <!--app-content open-->


    <div class="main-container container-fluid">
        <div class="main-content app-content mt-0">


            <div class="page-header">
                <h1 class="page-title">Quiz</h1>

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
                        <li class="breadcrumb-item active" aria-current="page">Quiz</li>
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

                            <form action="{{ route('delete.quiz') }}" method="POST">
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




                <!-- Modal Add Quiz-->
                <div class="modal fade" id="showModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">


                        <div class="modal-content">
                            <div class="modal-header">

                                <h5 id="tModal" class="modal-title">Add Quiz</h5>
                                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="card">
                                    <div class="card-body" style="background-color: #f0f2f5;">



                                        {{-- Add Quiz --}}
                                        <div class="">
                                            <form action="{{ route('create.quiz') }}" method="POST">
                                                @csrf



                                                <span class="text-danger">
                                                    @error('reportId')
                                                        {{ $message }}
                                                    @enderror
                                                </span>

                                                {{-- Id --}}
                                                <div class="form-group">



                                                    <input type="hidden" class="form-control" id="id"
                                                        name="id">


                                                    <span class="text-danger">
                                                        @error('labelForm')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>



                                                <div class="form-group">

                                                    <label for="category" class="form-label"><b>Category</b></label>

                                                    <div class="selection">
                                                        <select class="form-control form-select" name="category"
                                                            id="category">
                                                            <option value="EARTHQUAKE">EARTHQUAKE</option>
                                                            <option value="FIRE">FIRE</option>
                                                            <option value="FLOOD">FLOOD</option>
                                                            <option value="LANDSLIDE">LANDSLIDE</option>
                                                            <option value="TYPHOON">TYPHOON</option>
                                                            <option value="TSUNAMI">TSUNAMI</option>
                                                        </select>
                                                    </div>


                                                    <span class="text-danger">
                                                        @error('questionForm')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>

                                                </div>



                                                {{-- Question --}}
                                                <div class="form-group">

                                                    <label for="question" class="form-label"><b>Question</b></label>

                                                    <div class="col-lg">
                                                        <textarea class="form-control mb-4" placeholder="Enter Question" id="question" name="question" rows="4"
                                                            value="{{ old('question') }}" maxlength="255" required></textarea>
                                                    </div>


                                                    <span class="text-danger">
                                                        @error('question')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>

                                                </div>


                                                {{--  Choices 1 --}}
                                                <div class="form-group">

                                                    <label for="choice1" class="form-label"><b>Choice 1</b></label>

                                                    <div class="col-lg">
                                                        <input class="form-control mb-4" placeholder="Enter Choice1"
                                                            id="choice1" name="choice1" value="{{ old('choice1') }}"
                                                            maxlength="255" required></input>
                                                    </div>


                                                    <span class="text-danger">
                                                        @error('choice1')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>

                                                </div>



                                                <div class="form-group">

                                                    <label for="choice2" class="form-label"><b>Choice 2</b></label>

                                                    <div class="col-lg">
                                                        <input class="form-control mb-4" placeholder="Enter Choice2"
                                                            id="choice2" name="choice2" value="{{ old('choice2') }}"
                                                            maxlength="255" required></input>
                                                    </div>


                                                    <span class="text-danger">
                                                        @error('choice2')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>

                                                </div>


                                                <div class="form-group">

                                                    <label for="choice3" class="form-label"><b>Choice 3</b></label>

                                                    <div class="col-lg">
                                                        <input class="form-control mb-4" placeholder="Enter Choice3"
                                                            id="choice3" name="choice3" value="{{ old('choice3') }}"
                                                            maxlength="255" required></input>
                                                    </div>


                                                    <span class="text-danger">
                                                        @error('choice3')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>

                                                </div>

                                                <div class="form-group">

                                                    <label for="choice4" class="form-label"><b>Choice 4</b></label>

                                                    <div class="col-lg">
                                                        <input class="form-control mb-4" placeholder="Enter Choice4"
                                                            id="choice4" name="choice4" value="{{ old('choice4') }}"
                                                            maxlength="255" required></input>
                                                    </div>


                                                    <span class="text-danger">
                                                        @error('choice4')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>

                                                </div>


                                                <div class="form-group">

                                                    <label for="answer" class="form-label"><b>Answer</b></label>

                                                    <div class="selection">
                                                        <select class="form-control form-select" name="answer"
                                                            id="answer">

                                                            <option value="1">Choice 1</option>
                                                            <option value="2">Choice 2</option>
                                                            <option value="3">Choice 3</option>
                                                            <option value="4">Choice 4</option>

                                                        </select>
                                                    </div>



                                                    <span class="text-danger">
                                                        @error('answer')
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
                                    QUIZ</button>

                            </div>



                            <div class="table-responsive">
                                <table id="table" class="table table-bordered border text-nowrap mb-0">

                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Question</th>
                                            <th>Choice 1</th>
                                            <th>Choice 2</th>
                                            <th>Choice 3</th>
                                            <th>Choice 4</th>
                                            <th>Answer</th>


                                            <th style="width: 10%" class="datatable-nosort"></th>

                                        </tr>
                                    </thead>

                                    <tbody>

                                        @isset($allQuiz)
                                            @foreach ($allQuiz as $quiz)
                                                <tr>
                                                    <td>{{ Str::limit($quiz->category, 25) }}</td>

                                                    <td>{{ Str::limit($quiz->question, 25) }}</td>

                                                    <td>{{ Str::limit($quiz->choice1, 25) }}</td>

                                                    <td>{{ Str::limit($quiz->choice2, 25) }}</td>

                                                    <td>{{ Str::limit($quiz->choice3, 25) }}</td>

                                                    <td>{{ Str::limit($quiz->choice4, 25) }}</td>



                                                    <td>Choice {{ Str::limit($quiz->answer, 25) }}</td>


                                                    <td style="width: 5%;">

                                                        <button class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                                            data-bs-original-title="Edit">

                                                            <span id="editButton_{{ $quiz->id }}"
                                                                class="fe fe-edit fs-14 editButton" data-bs-toggle="modal"
                                                                data-bs-target="#showModal"
                                                                data-id="{{ $quiz->id }}"
                                                                data-category="{{ $quiz->category }}"
                                                                data-question="{{ $quiz->question }}"
                                                                data-choice1="{{ $quiz->choice1 }}"
                                                                data-choice2="{{ $quiz->choice2 }}"
                                                                data-choice3="{{ $quiz->choice3 }}"
                                                                data-choice4="{{ $quiz->choice4 }}"
                                                                data-answer="{{ $quiz->answer }}"
                                                                ></span>

                                                        </button>



                                                        <button class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                                            data-bs-original-title="Delete">

                                                            <span id="deleteButton_{{ $quiz->id }}"
                                                                data-did="{{ $quiz->id }}"
                                                                class="fe fe-trash-2 fs-14 deleteButton"
                                                                data-bs-toggle="modal" data-bs-target="#deleteModal"></span>
                                                        </button>

                                                    </td>

                                                </tr>
                                            @endforeach
                                        @endisset




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
                $(".modal-header #tModal").text("Add Quiz");

                $('#id').val(null);
                $('#category').val(null);
                $('#question').val(null);

                $('#category1').val(null);
                $('#category2').val(null);
                $('#category3').val(null);
                $('#category4').val(null);
                $('#answer').val(null);

            });





            // Edit Button
            $("#table tbody").on("click", ".editButton", function() {

                var id = $(this).data('id');

                $(".modal-header #tModal").text("Update Quiz");

                if (id != null) {

                    $(".modal-header #tModal").text("Update Quiz");

                    var category = $(this).data('category');
                    var question = $(this).data('question');
                    var choice1 = $(this).data('choice1');
                    var choice2 = $(this).data('choice2');
                    var choice3 = $(this).data('choice3');
                    var choice4 = $(this).data('choice4');
                    var answer = $(this).data('answer');


                    $('#id').val(id);
                    $('#category').val(category);
                    $('#question').val(question);
                    $('#choice1').val(choice1);
                    $('#choice2').val(choice2);
                    $('#choice3').val(choice3);
                    $('#choice4').val(choice4);
                    $('#answer').val(answer);

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
