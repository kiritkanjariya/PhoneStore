@extends('master_view')

@section('files')
<div class="container my-5">

    <div class="section-heading-v2">
        <h2>My <span class="highlight-green">Profile</span></h2>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
            <div class="profile-card-v2">
                <div class="profile-header">
                    <div class="profile-picture-wrapper">
                        <img src="{{ asset('uploads/profile/' . $user->profile)}}"
                            alt="User Profile Picture" width="120" height="120" class="rounded-circle">
                    </div>
                    <h5 class="profile-name">{{ $user->name }}</h5>
                    <p class="profile-email text-muted">{{ $user->email }}</p>
                </div>

                <hr>

                <div class="profile-body">
                    <h4 class="section-title">Basic Information</h4>
                    <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" value="{{ $user->name }}" name="fullname" data-validation="required alpha">
                                <div class="error" id="fullnameError"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" data-validation="required numeric min max" data-min="10" data-max="10">
                                <div class="error" id="phoneError"></div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" rows="3" name="address" data-validation="required">{{ $user->address }}</textarea>
                                <div class="error" id="addressError"></div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Profile Picture</label>
                                <input type="file" class="form-control" name="profile_pic" data-validation="file file1">
                                <div class="error" id="profile_picError"></div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-profile-save mt-2">Save Changes</button>
                    </form>
                </div>

                <hr>

                <div class="profile-body">
                    <h4 class="section-title">Change Password</h4>
                    <form action="{{ route('changed_password',$user->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Old Password</label>
                            <input type="password" class="form-control" name="oldpass" placeholder="Enter old password" data-validation="required strongPassword">
                            <div class="error" id="oldpassError"></div>
                        </div>

                        <div class="mb-3">
                            <label for="newpass" class="form-label">New Password</label>
                            <input type="password" id="newpass" name="newpass" class="form-control shadow-none" data-validation="required strongPassword" placeholder="Enter new password">
                            <div class="error" id="newpassError"></div>
                        </div>

                        <div class="mb-3">
                            <label for="C_newpass" class="form-label">Confirm New Password</label>
                            <input type="password" id="C_newpass" name="C_newpass" class="form-control shadow-none" data-validation="required confirmPassword" data-password-id="newpass" placeholder="Confirm new password">
                            <div class="error" id="C_newpassError"></div>
                        </div>

                        <button type="submit" class="btn btn-profile-save mt-2">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .profile-card-v2 {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
        border: 1px solid #e9ecef;
        overflow: hidden;
    }

    .profile-header {
        padding: 30px;
        text-align: center;
    }

    .profile-picture-wrapper {
        width: 130px;
        height: 130px;
        margin: 0 auto 15px;
        border-radius: 50%;
        overflow: hidden;
        border: 4px solid var(--primary-green, #3A5A40);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .profile-picture-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-name {
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 5px;
    }

    .profile-email {
        margin-bottom: 15px;
    }

    .profile-body {
        padding: 30px;
    }

    .profile-body .section-title {
        font-weight: 600;
        font-size: 1.3rem;
        margin-bottom: 20px;
    }

    .profile-body .form-label {
        font-weight: 500;
    }

    .profile-body .form-control {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        padding: 10px 15px;
        border-radius: 8px;
    }

    .profile-body .form-control:focus {
        background-color: #fff;
        border-color: var(--primary-green, #3A5A40);
        box-shadow: 0 0 0 0.2rem rgba(58, 90, 64, 0.15);
    }

    .btn-profile-save {
        background-color: var(--primary-green, #3A5A40);
        color: white;
        border: none;
        padding: 10px 25px;
        font-weight: 600;
        font-size: 1rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-profile-save:hover {
        background-color: #2c4431;
        color: white;
        transform: translateY(-2px);
    }

    .section-heading-v2 {
        display: flex;
        align-items: center;
        margin: 0rem 1rem 2rem 1rem;
    }

    .section-heading-v2::before {
        content: '';
        display: block;
        width: 50px;
        height: 4px;
        background-color: var(--primary-green, #3A5A40);
        border-radius: 2px;
        margin-right: 15px;
    }

    .section-heading-v2 h2 {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--dark-text, #333);
        margin: 0;
    }

    .section-heading-v2 .highlight-green {
        color: var(--primary-green, #3A5A40);
    }
</style>
@endsection