@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Newsletter Subscribers</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addNewsletterModal">+ Add Subscriber</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Agreed Terms</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($newsletters as $key => $newsletter)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $newsletter->email }}</td>
                    <td>
                        <span class="badge {{ $newsletter->agree_terms ? 'bg-success' : 'bg-danger' }}">
                            {{ $newsletter->agree_terms ? 'Yes' : 'No' }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary editBtn"
                            data-id="{{ $newsletter->id }}"
                            data-email="{{ $newsletter->email }}"
                            data-agree_terms="{{ $newsletter->agree_terms }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editNewsletterModal">
                            Edit
                        </button>

                        <form action="{{ route('admin.newsletters.destroy', $newsletter->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this subscriber?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add Newsletter Modal -->
<div class="modal fade" id="addNewsletterModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.newsletters.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Subscriber</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="agree_terms" value="1" required>
                        <label class="form-check-label">I agree to receive newsletters & blog updates</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Newsletter Modal -->
<div class="modal fade" id="editNewsletterModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="editNewsletterForm" method="POST">
            @csrf
            @method('POST')
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Subscriber</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Email</label>
                    <input type="email" name="email" id="edit-email" class="form-control" required>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="agree_terms" id="edit-agree_terms" value="1">
                        <label class="form-check-label">I agree to receive newsletters & blog updates</label>
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

<!-- JS to populate Edit Modal -->
<script>
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const form = document.getElementById('editNewsletterForm');
            form.action = `/admin/newsletters/${id}`;

            document.getElementById('edit-email').value = this.dataset.email;
            document.getElementById('edit-agree_terms').checked = this.dataset.agree_terms == 1;
        });
    });
</script>
@endsection
