@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Become Volunteers</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVolunteerModal">
            Add Volunteer
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Skills</th>
                    <th>Availability</th>
                    <th>Motivation</th>
                    <th>Resume</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($volunteers as $volunteer)
                <tr>
                    <td>{{ $volunteer->full_name }}</td>
                    <td>{{ $volunteer->email }}</td>
                    <td>{{ $volunteer->mobile_number }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($volunteer->skills, 50) }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($volunteer->availability, 50) }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($volunteer->motivation, 70) }}</td>
                    <td>
                        @if($volunteer->resume_file)
                            <a href="{{ asset('public/uploads/resumes/' . $volunteer->resume_file) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                        @else
                            <span class="text-muted">No Resume</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary editBtn"
                            data-id="{{ $volunteer->id }}"
                            data-full_name="{{ $volunteer->full_name }}"
                            data-email="{{ $volunteer->email }}"
                            data-mobile_number="{{ $volunteer->mobile_number }}"
                            data-address="{{ $volunteer->address }}"
                            data-date_of_birth="{{ $volunteer->date_of_birth }}"
                            data-gender="{{ $volunteer->gender }}"
                            data-skills="{{ $volunteer->skills }}"
                            data-availability="{{ $volunteer->availability }}"
                            data-motivation="{{ $volunteer->motivation }}"
                            data-experience="{{ $volunteer->experience }}"
                            data-emergency_contact="{{ $volunteer->emergency_contact }}"
                            data-emergency_mobile="{{ $volunteer->emergency_mobile }}"
                            data-resume_file="{{ $volunteer->resume_file }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editVolunteerModal">
                            Edit
                        </button>

                        <form action="{{ route('admin.become_volunteers.destroy', $volunteer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this volunteer?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Add Modal --}}
    <div class="modal fade" id="addVolunteerModal" tabindex="-1" aria-labelledby="addVolunteerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{ route('admin.become_volunteers.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Volunteer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label>Full Name</label>
                            <input type="text" name="full_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Mobile Number</label>
                            <input type="text" name="mobile_number" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Date of Birth</label>
                            <input type="date" name="date_of_birth" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                <option value="" selected>Choose...</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Skills / Interests</label>
                            <input type="text" name="skills" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Availability</label>
                            <input type="text" name="availability" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Motivation</label>
                            <textarea name="motivation" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label>Experience</label>
                            <textarea name="experience" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label>Emergency Contact Name</label>
                            <input type="text" name="emergency_contact" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Emergency Contact Mobile</label>
                            <input type="text" name="emergency_mobile" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Resume Upload</label>
                            <input type="file" name="resume_file" class="form-control" accept=".pdf,.doc,.docx">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-success" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editVolunteerModal" tabindex="-1" aria-labelledby="editVolunteerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="editVolunteerForm" method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit-id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Volunteer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label>Full Name</label>
                            <input type="text" name="full_name" id="edit-full_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" id="edit-email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Mobile Number</label>
                            <input type="text" name="mobile_number" id="edit-mobile_number" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Address</label>
                            <input type="text" name="address" id="edit-address" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Date of Birth</label>
                            <input type="date" name="date_of_birth" id="edit-date_of_birth" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Gender</label>
                            <select name="gender" id="edit-gender" class="form-control">
                                <option value="" selected>Choose...</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Skills / Interests</label>
                            <input type="text" name="skills" id="edit-skills" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Availability</label>
                            <input type="text" name="availability" id="edit-availability" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Motivation</label>
                            <textarea name="motivation" id="edit-motivation" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label>Experience</label>
                            <textarea name="experience" id="edit-experience" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label>Emergency Contact Name</label>
                            <input type="text" name="emergency_contact" id="edit-emergency_contact" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Emergency Contact Mobile</label>
                            <input type="text" name="emergency_mobile" id="edit-emergency_mobile" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Resume Upload (Leave blank to keep current)</label>
                            <input type="file" name="resume_file" class="form-control" accept=".pdf,.doc,.docx">
                            <div class="mt-2">
                                <a href="#" target="_blank" id="current-resume-link">Current Resume</a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Update</button>
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- JS for Edit button --}}
<script>
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const data = this.dataset;

            document.getElementById('edit-id').value = data.id;
            document.getElementById('edit-full_name').value = data.full_name;
            document.getElementById('edit-email').value = data.email;
            document.getElementById('edit-mobile_number').value = data.mobile_number;
            document.getElementById('edit-address').value = data.address;
            document.getElementById('edit-date_of_birth').value = data.date_of_birth;
            document.getElementById('edit-gender').value = data.gender;
            document.getElementById('edit-skills').value = data.skills;
            document.getElementById('edit-availability').value = data.availability;
            document.getElementById('edit-motivation').value = data.motivation;
            document.getElementById('edit-experience').value = data.experience;
            document.getElementById('edit-emergency_contact').value = data.emergency_contact;
            document.getElementById('edit-emergency_mobile').value = data.emergency_mobile;

            if(data.resume_file){
                document.getElementById('current-resume-link').href = `/uploads/resumes/${data.resume_file}`;
                document.getElementById('current-resume-link').style.display = 'inline';
            } else {
                document.getElementById('current-resume-link').style.display = 'none';
            }

            document.getElementById('editVolunteerForm').action = `/admin/become_volunteers/update/${data.id}`;
        });
    });
</script>

@endsection
