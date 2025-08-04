@extends('admin/admin_master_view')

@section('file_content')

<div class="container">
    <div class="row">
        <div class="col-12 my-5 mb-4 px-4">
            <h2 class="fw-bold">PROFILE</h2>
        </div>

        <div class="d-flex justify-content-center">
            <div class="col-lg-8 col-md-12 px-4 mb-5 px-5">
                <div class="card mb-4 border-0 shadow rounded-3">
                    <div class="card-body">
                        <form action="admin_changed_profile" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="card-body col-lg-4">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('img/sliders/Default-Avatar.jpg') }}" class="img-fluid rounded-circle" style="height: 270px; width: 40%;">
                                    </div>
                                    <h5 class="text-center mt-2" style="color:#767676">Kanjariya Kirit</h5>
                                    <h6 class="text-center mb-3" style="color:#a8a8a8">kkanjariya630@rku.ac.in</h6>
                                </div>

                                <h5 class="mb-3 fw-bold">Basic Information</h5>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="name">Full Name : </label>
                                    <input type="text" class="form-control shadow-none" id="name" name="name" data-validation="required alpha min" data-min="2" placeholder="Kanjariya kirit">
                                    <div class="error" id="nameError"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="phone">Phone number : </label>
                                    <input type="number" name="phone" id="phone" data-validation="required numeric min max" data-min="10" data-max="10" class="form-control shadow-none" placeholder="9723035284">
                                    <div class="error" id="phoneError"></div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label for="address" class="form-label fw-semibold">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" data-validation="required" placeholder="Enter address">
                                    <div class="error" id="addressError"></div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label for="pic" class="form-label">Profile Picture : </label>
                                    <input type="file" name="edit_pic" class="form-control shadow-none" id="edit_pic" data-validation="required file">
                                    <div class="error" id="edit_picError"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-success w-100 text-white shadow-none" name="edit_btn">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <div class="col-lg-8 col-md-12 px-4 mb-5 px-5">
                <div class="card mb-4 border-0 shadow rounded-3 p-2">
                    <div class="card-body">
                        <h5 class="mb-3 fw-bold">Change Password</h5>
                        <form action="admin_changed_password" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="oldpass" class="form-label">Old Password:</label>
                                    <input type="password" id="oldpass" name="oldpass" class="form-control shadow-none" data-validation="required strongPassword" placeholder="Enter old Password:">
                                    <div class="error" id="oldpassError"></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="newpass" class="form-label">New Password:</label>
                                    <input type="password" id="newpass" name="newpass" class="form-control shadow-none mb-3" data-validation="required strongPassword" placeholder="Enter new Password:">
                                    <div class="error" id="newpassError"></div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="C_newpass" class="form-label">Confirm Password:</label>
                                    <input type="password" id="C_newpass" name="C_newpass" class="form-control shadow-none" data-validation="required confirmPassword" data-password-id="newpass" placeholder="Enter Confirm Password:">
                                    <div class="error" id="C_newpassError"></div>
                                </div>
                            </div>
                            <button type="submit" name="pass_btn" class="btn btn-success text-white shadow-none w-100">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection