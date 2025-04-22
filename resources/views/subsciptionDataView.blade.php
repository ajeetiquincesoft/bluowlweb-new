@extends('layouts.Myapp')
@section('content')
    @include('sweetalert::alert')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Subscription</h4>
                    </div>
                </div>
            </div>


            <!-- end page title -->
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="card-body">
                        <div class="listjs-table" id="customerList">
                            <div class="row g-4 mb-3">
                                <div class="col-sm-auto">
                                    <div>
                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                            id="create-btn" data-bs-target="#showModal"><i
                                                class="ri-add-line align-bottom me-1"></i> Add Subscription</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @forelse($subscriptions as $subscription)
                            <div class="col-lg-6">
                                <div class="card pricing-box">
                                    <div class="card-body p-4 m-2">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1 fw-semibold">{{ $subscription->name }}</h5>
                                                <p class="text-muted mb-0">{!! $subscription->description !!}</p>
                                            </div>
                                            <div class="avatar-sm">
                                                <div class="avatar-title bg-light rounded-circle text-primary">
                                                    <i class="ri-book-mark-line fs-20"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pt-4">
                                            <h2>
                                                <sup><small>$</small></sup>{{ $subscription->price }}
                                                <span class="fs-13 text-muted">
                                                    /
                                                    @if ($subscription->duration == 30)
                                                        Month
                                                    @elseif ($subscription->duration == 365)
                                                        Year
                                                    @else
                                                        {{ $subscription->duration }} Days
                                                    @endif
                                                </span>
                                            </h2>
                                        </div>
                                        <hr class="my-4 text-muted">
                                        <div>
                                            <ul class="list-unstyled text-muted vstack gap-3">
                                                @foreach (json_decode($subscription->features) as $feature)
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                {{ $feature }}
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="mt-4">
                                                <button type="button" class="btn btn-success add-btn w-100"
                                                    data-bs-toggle="modal" id="create-btn"
                                                    data-bs-target="#editShowModel{{ $subscription->id }}"><i
                                                        class="ri-edit-box-fill align-bottom me-1"></i> Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <div class="noresult" >
                                    <div class="text-center">
                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                        <h5 class="mt-2">Sorry! No Result Found</h5>
                                        <p class="text-muted mb-0"> Currently, there are no subscription plans available in the system.</p>
                                        <p class="text-muted mb-0"> you can create a new subscription plan by clicking the "Add Subscription" button above. </p>
                                    </div>
                                </div>
                            </tr>
                          @endforelse
                    </div>
                    @foreach ($subscriptions as $subscription)
                    <div class="modal fade" id="editShowModel{{ $subscription->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light p-3">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Plan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                        id="close-modal"></button>
                                </div>

                                <form class="tablelist-form" method="POST" action="{{ route('editSubscription', ['id' => Crypt::encrypt($subscription->id)])  }}" autocomplete="off">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $subscription->id }}">
                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label for="name" class="form-label">Subscription Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ $subscription->name }}"
                                                placeholder="e.g. Premium Plan">
                                        </div>

                                        <div class="mb-3">
                                            <label for="price" class="form-label">Price ($)</label>
                                            <input type="number" name="price" class="form-control" value="{{ $subscription->price }}"
                                                placeholder="e.g. 29.99">
                                        </div>

                                        <div class="mb-3">
                                            <label for="duration" class="form-label">Duration</label>
                                            <select class="form-select" name="duration">
                                                <option value="30" {{ $subscription->duration == 30 ? 'selected' : '' }}>1 Month</option>
                                                <option value="365" {{ $subscription->duration == 365 ? 'selected' : '' }}>1 Year</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Features</label>
                                            <div id="features-wrapper-{{ $subscription->id }}">
                                                @if($subscription->features)
                                                    @foreach(json_decode($subscription->features) as $feature)
                                                        <div class="input-group mb-2">
                                                            <input type="text" name="features[]" class="form-control"
                                                                value="{{ $feature }}" placeholder="Feature name">
                                                            <button type="button" class="btn btn-danger remove-feature">Remove</button>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <button type="button" class="btn btn-secondary add-feature-btn"
                                                data-id="{{ $subscription->id }}">+ Add Feature</button>
                                        </div>

                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control summernote" name="description" rows="3"
                                                placeholder="Write a short plan description...">{{ $subscription->description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="modal-footer" style="display: block;">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Update Plan</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light p-3">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Plan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                        id="close-modal"></button>
                                </div>
                                <form class="tablelist-form" method="POST" action="{{ route('addSubscription') }}"
                                    autocomplete="off">
                                    @csrf
                                    <div class="modal-body">
                                        <div class=" mb-3">
                                            <label for="name" class="form-label">Subscription Name</label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="e.g. Premium Plan">
                                        </div>

                                        <div class=" mb-3">
                                            <label for="price" class="form-label">Price ($)</label>
                                            <input type="number" name="price" class="form-control" id="price"
                                                placeholder="e.g. 29.99">
                                        </div>

                                        <div class="mb-3">
                                            <label for="duration" class="form-label">Duration</label>
                                            <select class="form-select" name="duration" id="duration">
                                                <option value="30">1 Month</option>
                                                <option value="365">1 Year</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Features</label>
                                            <div id="features-wrapper">
                                                <div class="input-group mb-2">
                                                    <input type="text" name="features[]" class="form-control"
                                                        placeholder="Feature name">
                                                    <button type="button"
                                                        class="btn btn-danger remove-feature">Remove</button>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-secondary" id="add-feature">+ Add
                                                Feature</button>
                                        </div>

                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control summernote" name="description" id="description" rows="3"
                                                placeholder="Write a short plan description..."></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer" style="display: block;">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" id="add-btn">Add
                                                Plan</button>
                                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
                <!--end col-->
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <script>
        document.getElementById('add-feature').addEventListener('click', function() {
            const wrapper = document.getElementById('features-wrapper');
            const div = document.createElement('div');
            div.classList.add('input-group', 'mb-2');
            div.innerHTML = `
            <input type="text" name="features[]" class="form-control" placeholder="Feature name">
            <button type="button" class="btn btn-danger remove-feature">Remove</button>
          `;
            wrapper.appendChild(div);
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-feature')) {
                e.target.parentElement.remove();
            }
        });
    </script>
    <script>
        document.querySelectorAll('.add-feature-btn').forEach(button => {
            button.addEventListener('click', function () {
                let id = this.getAttribute('data-id');
                let wrapper = document.getElementById(`features-wrapper-${id}`);
                let inputGroup = document.createElement('div');
                inputGroup.className = 'input-group mb-2';
                inputGroup.innerHTML = `
                    <input type="text" name="features[]" class="form-control" placeholder="Feature name">
                    <button type="button" class="btn btn-danger remove-feature">Remove</button>
                `;
                wrapper.appendChild(inputGroup);
            });
        });

        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-feature')) {
                e.target.closest('.input-group').remove();
            }
        });
    </script>
@endsection
