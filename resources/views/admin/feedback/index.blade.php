@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>User Feedbacks</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="fas fa-plus"></i> Add Feedback
        </button>
    </div>
    
    

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
     <div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Profile</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Rating</th>
                <th>Feedback</th>
                <th>Status</th> {{-- ✅ Status column header --}}
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($feedbacks as $feedback)
            <tr>
                <td>
                    @if($feedback->profile_picture)
                        <img src="{{ asset( 'public/' .$feedback->profile_picture) }}" alt="Profile" width="50" height="50" style="object-fit: cover;">
                    @else
                        N/A
                    @endif
                </td>
                <td>{{ $feedback->name }}</td>
                <td>{{ $feedback->email }}</td>
                <td>{{ $feedback->mobile }}</td>
                <td>
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $feedback->star_rating)
                            ★
                        @else
                            ☆
                        @endif
                    @endfor
                </td>
                <td>{!! $feedback->message !!}</td>
                <td>
                    @if($feedback->status == 'published')
                        <span class="badge bg-success">Published</span>
                    @else
                        <span class="badge bg-secondary">Unpublished</span>
                    @endif
                </td>
                <td>
                    <button class="btn btn-sm btn-primary editBtn"
                        data-id="{{ $feedback->id }}"
                        data-name="{{ $feedback->name }}"
                        data-email="{{ $feedback->email }}"
                        data-mobile="{{ $feedback->mobile }}"
                        data-rating="{{ $feedback->star_rating }}"
                        data-message="{{ $feedback->message }}"
                        data-status="{{ $feedback->status }}"
                        data-bs-toggle="modal"
                        data-bs-target="#editModal">
                        Edit
                    </button>

                    <form action="{{ route('admin.feedback.delete', $feedback->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this feedback?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

    </div>

    {{-- Add Modal --}}
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.feedback.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Feedback</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Mobile</label>
                            <input type="text" name="mobile" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Star Rating (1-5)</label>
                            <input type="number" name="star_rating" class="form-control" min="1" max="5" required>
                        </div>
                        <div class="mb-3">
                            <label>Your Feedback</label>
                            <textarea name="message" class="form-control rich-editor" rows="3" required></textarea>
                        </div>
                        
                        <div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control" required>
        <option value="published">Published</option>
        <option value="unpublished">Unpublished</option>
    </select>
</div>

                   
                        <div class="mb-3">
                            <label>Profile Picture (optional)</label>
                            <input type="file" name="profile_picture" class="form-control">
                        </div>
              
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Add Feedback</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <form id="editForm" method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Feedback</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Full Name</label>
                            <input type="text" name="name" id="editName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" id="editEmail" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Mobile</label>
                            <input type="text" name="mobile" id="editMobile" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Star Rating (1-5)</label>
                            <input type="number" name="star_rating" id="editRating" class="form-control" min="1" max="5" required>
                        </div>
                        
                        
                        <div class="mb-3">
                            <label>Your Feedback</label>
                            <textarea name="message" id="editMessage" class="form-control rich-editor" rows="3" required></textarea>
                        </div>
                   
                        <div class="mb-3">
                            <label>Profile Picture (optional)</label>
                            <input type="file" name="profile_picture" class="form-control">
                        </div>
                        
                        <div class="mb-3">
    <label>Status</label>
    <select name="status" id="editStatus" class="form-control" required>
        <option value="published">Published</option>
        <option value="unpublished">Unpublished</option>
    </select>
</div>



                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const updateUrlBase = "{{ route('admin.feedback.update', ':id') }}";

document.querySelectorAll('.editBtn').forEach(btn => {
    btn.addEventListener('click', function () {
        let actionUrl = updateUrlBase.replace(':id', this.dataset.id);
        document.getElementById('editForm').action = actionUrl;
        document.getElementById('editName').value = this.dataset.name;
        document.getElementById('editEmail').value = this.dataset.email;
        document.getElementById('editMobile').value = this.dataset.mobile;
        document.getElementById('editRating').value = this.dataset.rating;
        document.getElementById('editMessage').value = this.dataset.message;
        document.getElementById('editStatus').value = this.dataset.status; // ✅ Status set
    });
});

</script>


@endsection