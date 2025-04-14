@extends('layouts.Myapp')
@section('content')
    @include('sweetalert::alert')

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"></h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">FAQ Page</li>
                            </ol>
                        </div>
                    </div>
                    <div class="card rounded-0 bg-soft-success mx-n4 mt-n4 border-top">
                        <div class="px-4">
                            <div class="row">
                                <div class="col-xxl-5 align-self-center">
                                    <div class="py-4">
                                        <h4 class="display-6 coming-soon-text-custom">Frequently asked questions</h4>
                                        <p class="text-success fs-15 mt-3">Quick Help: FAQs</p>
                                        <div class="hstack flex-wrap gap-2">
                                            <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                                id="create-btn" data-bs-target="#showModal"><i
                                                    class="ri-add-line align-bottom me-1"></i> Add</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 ms-auto">
                                    <div class="mb-n5 pb-1 faq-img d-none d-xxl-block">
                                        <img src="assets/images/faq-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light p-3">
                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                        id="close-modal"></button>
                                </div>
                                <form class="tablelist-form" id="addquestion" action="{{ route('Add_FAQ') }}"
                                    enctype="multipart/form-data" method="POST" autocomplete="off">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="question-field" class="form-label">Question</label>
                                            <textarea class="form-control " name="question" id="exampleFormControlTextarea7" rows="3">{{ old('question') }}</textarea>
                                            <div class="invalid-feedback">Your Question.</div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="answere-field" class="form-label">Answer</label>
                                            <textarea class="form-control " name="answer" id="exampleFormControlTextarea7" rows="3">{{ old('answer') }}</textarea>
                                            <div class="invalid-feedback">Your Answer.</div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="col-xxl-12 col-md-12" id="collections">
                                                <label for="customername-field" class="form-label"><b>Select Question
                                                        Category </b>
                                                </label>
                                                <select class="form-control" id="choices-multiple-remove-button"
                                                    name="category" data-placeholder="Select Question Category" required>
                                                    <option value="">Select Question Category</option>
                                                    <option value="General">General</option>
                                                    <option value="Account">Account</option>
                                                    <option value="Services">Services</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" value="submit" class="btn btn-success" id="add-btn">Add
                                                Question</button>
                                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-evenly">
                        <div class="col-lg-4">
                            <div class="mt-3">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0 me-1">
                                        <i class="ri-question-line fs-24 align-middle text-success me-1"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="fs-16 mb-0 fw-semibold">General Questions</h5>
                                    </div>
                                </div>

                                <div class="accordion accordion-border-box" id="genques-accordion">
                                    @foreach ($Generaldata as $item => $general)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header d-flex align-items-center justify-content-between"
                                                id="genques-heading{{ $item }}">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#genques-collapse{{ $item }}"
                                                    aria-expanded="true" aria-controls="genques-collapseOne">
                                                    {!! $general->question !!}
                                                </button>
                                                <a class="btn btn-sm dropdown" href="{{ route('delete_FAQ', ['id' => $general->id]) }}" title="delete">
                                                    <i class=" ri-delete-bin-2-line"></i>
                                                </a>
                                            </h2>
                                            <div id="genques-collapse{{ $item }}"
                                                class="accordion-collapse collapse"
                                                aria-labelledby="genques-heading{{ $item }}"
                                                data-bs-parent="#genques-accordion">
                                                <div class="accordion-body">

                                                    {!! $general->answer !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!--end accordion-->
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mt-3">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0 me-1">
                                        <i class="ri-user-settings-line fs-24 align-middle text-success me-1"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="fs-16 mb-0 fw-semibold">Account Questions</h5>
                                    </div>
                                </div>

                                <div class="accordion accordion-border-box" id="manageaccount-accordion">
                                    @foreach ($Accountdata as $item => $account)
                                        <div class="accordion-item">
                                                <h2 class="accordion-header d-flex align-items-center justify-content-between"
                                                id="manageaccount-heading{{ $item }}">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#manageaccount-collapse{{ $item }}"
                                                    aria-expanded="false"
                                                    aria-controls="manageaccount-collapse{{ $item }}">
                                                    {!! $account->question !!}
                                                </button>
                                                <a class="btn btn-sm dropdown" href="{{ route('delete_FAQ', ['id' => $account->id]) }}" title="delete">
                                                    <i class=" ri-delete-bin-2-line"></i>
                                                </a>
                                            </h2>
                                            <div id="manageaccount-collapse{{ $item }}"
                                                class="accordion-collapse collapse"
                                                aria-labelledby="manageaccount-heading{{ $item }}"
                                                data-bs-parent="#manageaccount-accordion">
                                                <div class="accordion-body">
                                                    {!! $account->answer !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <!--end accordion-->
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="mt-3">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0 me-1">
                                        <i class="ri-customer-service-fill fs-24 align-middle text-success me-1"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="fs-16 mb-0 fw-semibold">Services Questions</h5>
                                    </div>
                                </div>

                                <div class="accordion accordion-border-box" id="privacy-accordion">
                                    @foreach ($Servicesdata as $item => $Services)
                                        <div class="accordion-item">
                                                <h2 class="accordion-header d-flex align-items-center justify-content-between"
                                                id="privacy-heading{{ $item }}">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#privacy-collapse{{ $item }}"
                                                    aria-expanded="true"
                                                    aria-controls="privacy-collapse{{ $item }}">
                                                    {!! $Services->question !!}
                                                </button>
                                                <a class="btn btn-sm dropdown" href="{{ route('delete_FAQ', ['id' => $Services->id]) }}" title="delete">
                                                    <i class=" ri-delete-bin-2-line"></i>
                                                </a>
                                            </h2>
                                            <div id="privacy-collapse{{ $item }}"
                                                class="accordion-collapse collapse "
                                                aria-labelledby="privacy-heading{{ $item }}"
                                                data-bs-parent="#privacy-accordion">
                                                <div class="accordion-body">
                                                    {!! $Services->answer !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!--end accordion-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->.
            </div>
            <!--end row-->

        </div>
        <!-- container-fluid -->
    </div>
    <script>
        $("#addquestion").validate({
            rules: {
                question: 'required',
                answer: 'required',
                category: 'required'
            },
            messages: {
                question: 'This field is required',
                answer: 'This field is required',
                category: 'This field is required',
            }
        });
    </script>
    <script>
        // Select the delete button
        document.querySelector('.delete-btn').addEventListener('click', function(event) {
            // Show the confirmation pop-up
            const confirmDelete = confirm("Are you sure you want to delete this item?");

            // If the user clicks 'Cancel', prevent the link from being followed
            if (!confirmDelete) {
                event.preventDefault();
            }
        });
    </script>
@endsection
