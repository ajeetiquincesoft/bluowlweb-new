@extends('layouts.Myapp')
@section('content')
    @include('sweetalert::alert')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Privacy  Policy</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="bg-soft-warning position-relative">
                            <div class="card-body p-5">
                                <div class="text-center">
                                    <h3>{{ isset($data) && $data->title ? $data->title : 'Title' }}</h3>
                                    <p class="mb-0 text-muted">Last update:{{ isset($data) && $data->updated_at ?date('d M,Y',strtotime($data->updated_at)) : 'Updated Date' }} </p>
                                </div>
                            </div>
                            <div class="shape">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"
                                    width="1440" height="60" preserveAspectRatio="none" viewBox="0 0 1440 60">
                                    <g mask="url(&quot;#SvgjsMask1001&quot;)" fill="none">
                                        <path d="M 0,4 C 144,13 432,48 720,49 C 1008,50 1296,17 1440,9L1440 60L0 60z"
                                            style="fill: var(--vz-card-bg-custom);"></path>
                                    </g>
                                    <defs>
                                        <mask id="SvgjsMask1001">
                                            <rect width="1440" height="60" fill="#ffffff"></rect>
                                        </mask>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div>
                                {!! isset($data) && $data->content ? $data->content : 'content' !!}
                            </div>


                            <div class="text-end">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#varyingcontentModal" data-bs-whatever="Mary">Edit</button>
                            </div>
                            <div class="modal fade" id="varyingcontentModal" tabindex="-1"
                                aria-labelledby="varyingcontentModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="varyingcontentModalLabel">New message</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('UpdatePrivacyPolicyData') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="customer-name" class="col-form-label">Page Title:</label>
                                                    <input type="text" class="form-control" name="title"  value="{{$data->title ??""}}"
                                                        id="customer-name">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="message-text" class="col-form-label ">Contant:</label>
                                                    <textarea class="form-control summernote" name="content" id="message-text" rows="4">{!! $data->content ?? '<p><em>No content available</em></p>' !!}</textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Back</button>
                                                    <button type="submit"
                                                        class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->

        </div>
        <!-- container-fluid -->
    </div>
@endsection
