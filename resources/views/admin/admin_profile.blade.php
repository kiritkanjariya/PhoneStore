@extends('admin/admin_master_view')

@section('file_content')

<style>
    body {
        background-color: #f0f2f5;
    }

    .profile-card {
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border: none;
        overflow: hidden;
    }

    .profile-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        text-align: center;
    }

    .profile-avatar-1 {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid white;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        margin-top: 20px;
        background-color: white;
    }

    .profile-avatar-1-wrapper {
        margin-bottom: 1rem;
    }

    .nav-tabs .nav-link {
        border: none;
        border-bottom: 3px solid transparent;
        color: #6c757d;
        font-weight: 500;
        padding: 1rem 1.5rem;
    }

    .nav-tabs .nav-link.active,
    .nav-tabs .nav-item.show .nav-link {
        color: #764ba2;
        background-color: transparent;
        border-color: #764ba2;
    }

    .form-control:focus {
        border-color: #764ba2;
        box-shadow: 0 0 0 0.25rem rgba(118, 75, 162, 0.25);
    }

    .btn-save {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 50px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease-in-out;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
    }

    .form-label {
        font-weight: 600;
        color: #495057;
    }
</style>

<div class="container my-5">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-10 col-lg-12">

            <div class="card profile-card">
                <div class="profile-header">
                    <h2 class="fw-bold mb-0">ACCOUNT SETTINGS</h2>
                    <p class="mb-0">Manage your profile and password</p>
                </div>

                <div class="d-flex justify-content-center profile-avatar-1-wrapper">
                    <img src="{{ asset('img/sliders/Default-Avatar.jpg') }}" class="profile-avatar-1" alt="Profile Picture">
                </div>
                <div class="text-center mb-4">
                    <h4 class="fw-bold mb-0">Kanjariya Kirit</h4>
                    <span class="text-muted">kkanjariya630@rku.ac.in</span>
                </div>

                <ul class="nav nav-tabs nav-fill px-4" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="true">
                            <i class="fas fa-user-edit me-2"></i>Edit Profile
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password-tab-pane" type="button" role="tab" aria-controls="password-tab-pane" aria-selected="false">
                            <i class="fas fa-key me-2"></i>Change Password
                        </button>
                    </li>
                </ul>

                <div class="card-body p-4">
                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                            <form action="admin_changed_profile" method="post" enctype="multipart/form-data" class="mt-3">
                                @csrf
                                <h5 class="mb-4 fw-bold">Basic Information</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="name">Full Name</label>
                                        <input type="text" class="form-control shadow-none" id="name" name="name" data-validation="required alpha min" data-min="2" placeholder="Kanjariya kirit">
                                        <div class="error" id="nameError"></div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="phone">Phone Number</label>
                                        <input type="text" name="phone" id="phone" data-validation="required numeric min max" data-min="10" data-max="10" class="form-control shadow-none" placeholder="9723035284">
                                        <div class="error" id="phoneError"></div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control shadow-none" id="address" name="address" data-validation="required" placeholder="Enter your full address" rows="3"></textarea>
                                        <div class="error" id="addressError"></div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <label for="edit_pic" class="form-label">Update Profile Picture</label>
                                        <input type="file" name="edit_pic" class="form-control shadow-none" id="edit_pic" data-validation="required file">
                                        <div class="error" id="edit_picError"></div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-save text-white shadow-none" name="edit_btn">Save Changes</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="password-tab-pane" role="tabpanel" aria-labelledby="password-tab" tabindex="0">
                            <form action="admin_changed_password" method="post" class="mt-3">
                                @csrf
                                <h5 class="mb-4 fw-bold">Change Your Password</h5>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="oldpass" class="form-label">Old Password</label>
                                        <input type="password" id="oldpass" name="oldpass" class="form-control shadow-none" data-validation="required strongPassword" placeholder="Enter old password">
                                        <div class="error" id="oldpassError"></div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="newpass" class="form-label">New Password</label>
                                        <input type="password" id="newpass" name="newpass" class="form-control shadow-none" data-validation="required strongPassword" placeholder="Enter new password">
                                        <div class="error" id="newpassError"></div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="C_newpass" class="form-label">Confirm New Password</label>
                                        <input type="password" id="C_newpass" name="C_newpass" class="form-control shadow-none" data-validation="required confirmPassword" data-password-id="newpass" placeholder="Confirm new password">
                                        <div class="error" id="C_newpassError"></div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" name="pass_btn" class="btn btn-save text-white shadow-none">Update Password</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection