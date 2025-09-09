@extends('admin/admin_master_view')

@section('file_content')

<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <div class="card container mt-5 p-4 border-2 mb-4">
            <div class="card-header fs-3 fw-bold d-flex align-items-center justify-content-between"> Contact Us
            </div>
            <div class="table-responsive-lg table-responsive-lg" style="z-index: 1;">
                <div class="container mt-3">
                    @if (isset($contactInfo))
                    @foreach ($contactInfo as $contact)

                    <form action="{{ route('contact_updated') }}" method="POST" class="p-2">
                        @csrf
                        <div class="mb-4">
                            <label for="address" class="form-label fw-semibold">Address</label>
                            <input type="text" class="form-control" id="address" name="address" data-validation="required" value="{{ $contact->location }}" placeholder="Enter address">
                            <div class="error" id="addressError"></div>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control" id="email" name="email" data-validation="required email" value="{{ $contact->email }}" placeholder="Enter email">
                            <div class="error" id="emailError"></div>
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="form-label fw-semibold">Phone No.</label>
                            <input type="text" class="form-control" id="phone" name="phone" data-validation="required numeric min max" data-max="10" data-min="10" value="{{ $contact->phone }}" placeholder="Enter 10-digit phone number">
                            <div class="error" id="phoneError"></div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success px-4">Update Address</button>
                        </div>
                    </form>
                    @endforeach

                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3"></div>
</div>


<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <div class="card container mt-5 p-2 border-2 mb-4">
            <div class="card-header fs-3 fw-bold d-flex align-items-center justify-content-between"> About Us
            </div>
            <div class="table-responsive-lg table-responsive-lg" style="z-index: 1;">
                <div class="container mt-3">
                    @if (isset($abouts))
                    @foreach ($abouts as $about)
                    <form action="{{ route('about_updated') }}" method="POST" enctype="multipart/form-data" class="p-2">
                        @csrf
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('img/sliders/'. $about->image) }}"
                                class="img-fluid rounded-circle" style="height: 250px; width: 40%;">
                        </div>

                        <div class="mb-4">
                            <label for="about_image" class="form-label fw-semibold">About Image</label>
                            <input type="file" class="form-control" id="about_image" name="about_image" data-validation="file file1">
                            <div class="error" id="about_imageError"></div>
                        </div>
                        <div class="mb-4">
                            <label for="about_text" class="form-label fw-semibold">About Us Text</label>
                            <textarea class="form-control" id="about_text" name="about_text" rows="8" data-validation="required" placeholder="Enter about us text">{{ $about->about_description }}</textarea>
                            <div class="error" id="about_textError"></div>
                        </div>
                        <div class="mb-4">
                            <label for="mission" class="form-label fw-semibold">Our Mission</label>
                            <textarea class="form-control" id="mission" name="mission" rows="4" data-validation="required" placeholder="Enter Our Mission">{{ $about->mission }}</textarea>
                            <div class="error" id="missionError"></div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-success px-4">Update About Us</button>
                        </div>
                    </form>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3"></div>
</div>

<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Drawback
        <div>
            <a href="{{ route('add_drawback') }}" class="btn btn-success shadow-none">
                <i class="bi bi-plus-lg"></i> Add
            </a>
        </div>
    </div>
    <div class="table-responsive-lg table-responsive-lg" style="z-index: 1;">
        <div class="container mt-3">
            <table class="table table-striped table-bordered">
                <thead class="sticky-top">
                    <tr class="text-center">
                        <th scope="col" width="5%" class="bg-dark text-white">Sr no.</th>
                        <th scope="col" width="20%" class="bg-dark text-white">Name</th>
                        <th scope="col" width="20%" class="bg-dark text-white">Icon</th>
                        <th scope="col" width="40%" class="bg-dark text-white">Description</th>
                        <th scope="col" width="15%" class="bg-dark text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($drawbacks))
                    @foreach ($drawbacks as $drawback)
                    <tr class="align-middle text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $drawback->drawback }}</td>
                        <td><i class="{{ $drawback->drawback_icon }}"></i></td>
                        <td>{{ $drawback->description }}</td>
                        <td>
                            <a href="{{ route('edit_drawback', $drawback->id) }}" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                            <a href="#" class="btn btn-danger shadow">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection