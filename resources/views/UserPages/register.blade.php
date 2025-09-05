@extends('layouts.app')

@section('content')
    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-xxl-6">
                    <h5 class="mb-3 text-center fs-3">Register</h5>
                    <div class="card">
                        <div class="card-body">
                            <p class="text-muted">Use <code>nav-border-top nav-justified</code> class to create nav tabs with
                                border at top with justified tabs position.</p>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-justified nav-border-top nav-border-top-success mb-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#nav-border-justified-home"
                                        role="tab" aria-selected="false">
                                        <i class="ri-user-line align-middle me-1"></i> Customer
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#nav-border-justified-profile"
                                        role="tab" aria-selected="false">
                                        <i class="ri-user-line me-1 align-middle"></i> Vendor
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content text-muted">
                                <div class="tab-pane active" id="nav-border-justified-home" role="tabpanel">
                                    <h6>Give your text a good structure</h6>
                                    <p class="mb-0">
                                        Contrary to popular belief, you don’t have to work endless nights and hours to
                                        create a <a href="javascript:void(0);"
                                            class="text-decoration-underline"><b>Fantastic Design</b></a> by using
                                        complicated 3D elements. Flat design is your friend. Remember that. And the great
                                        thing about flat design is that it has become more and more popular over the years,
                                        which is excellent news to the beginner and advanced designer.
                                    </p>
                                </div>
                                <div class="tab-pane" id="nav-border-justified-profile" role="tabpanel">
                                    <h6>Use a color palette</h6>
                                    <p class="mb-0">
                                        Opposites attract, and that’s a fact. It’s in our nature to be interested in the
                                        unusual, and that’s why using contrasting colors in <a href="javascript:void(0);"
                                            class="text-decoration-underline"><b>Graphic Design</b></a> is a must. It’s
                                        eye-catching, it makes a statement, it’s impressive graphic design. Increase or
                                        decrease the letter spacing depending on the situation and try, try again until it
                                        looks right, and each letter has the perfect spot of its own.
                                    </p>
                                </div>
                            </div>
                        </div><!-- end card-body -->
                    </div>
                </div>
                <!--end col-->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
@endsection
