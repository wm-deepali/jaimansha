@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">🧑 Admin Profile Settings</h4>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Profile Data Table --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">📋 Profile Information</div>
        <div class="card-body p-0">
            <table class="table table-bordered m-0">
                <tbody>
                    <tr>
                        <th style="width: 20%">Full Name</th>
                        <td>{{ $profiles->full_name ?? 'N/A' }}</td>
                    </tr>
                     <tr>
                        <th style="width: 20%">UserName</th>
                        <td>{{ $profiles->username ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Email ID</th>
                        <td>{{ $profiles->email_id ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Contact Number</th>
                        <td>{{ $profiles->contact_number ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $profiles->address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                      <tr>
    <th>Profile Picture</th>
    <td>
        @if(!empty($profiles->profile_picture))
            <img src="{{ asset('storage/' . $profiles->profile_picture) }}" width="80">
        @else
            Not Uploaded
        @endif
    </td>
</tr>
<tr>
    <th>Header Logo</th>
    <td>
        @if(!empty($profiles->logo_header))
            <img src="{{ asset('storage/' . $profiles->logo_header) }}" width="80">
        @else
            Not Uploaded
        @endif
    </td>
</tr>
<tr>
    <th>Login Logo</th>
    <td>
        @if(!empty($profiles->logo_login))
            <img src="{{ asset('storage/' . $profiles->logo_login) }}" width="80">
        @else
            Not Uploaded
        @endif
    </td>
</tr>

                </tbody>
            </table>
        </div>
        <div class="card-footer text-end">
            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editProfileModal">✏️ Edit</button>
        </div>
    </div>

    {{-- Change Password Section --}}
    <div class="card mb-4">
        <div class="card-header bg-warning text-white">🔑 Change Password</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.settings.profile.changePassword', $profiles->id) }}">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Current Password</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>New Password</label>
                        <input type="password" name="new_password" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-warning">Change Password</button>
            </form>
        </div>
    </div>
</div>

<!-- 🛠️ Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="POST" action="{{ route('admin.settings.profile.update', $profiles->id ?? 1) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Admin Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
               <div class="row mb-3">
    <div class="col-md-4">
        <label>Full Name</label>
        <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $profiles->full_name ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="{{ old('username', $profiles->username ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label>Email ID</label>
        <input type="email" name="email_id" class="form-control" value="{{ old('email_id', $profiles->email_id ?? '') }}" required>
    </div>
</div>


                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Contact Number</label>
                        <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number', $profiles->contact_number ?? '') }}">
                    </div>
                    <div class="col-md-6">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address', $profiles->address ?? '') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Profile Picture</label>
                        <input type="file" name="profile_picture" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>Header Logo</label>
                        <input type="file" name="logo_header" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>Login Logo</label>
                        <input type="file" name="logo_login" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save Changes</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </form>
  </div>
</div>
@endsection
