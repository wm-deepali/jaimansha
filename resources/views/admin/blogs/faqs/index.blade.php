@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>FAQs</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addFaqModal">+ Add FAQ</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faqs as $key => $faq)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $faq->question }}</td>
<td>{{ \Illuminate\Support\Str::limit($faq->answer, 50) }}</td>
                    <td>
                        <span class="badge {{ $faq->status == 'Active' ? 'bg-success' : 'bg-danger' }}">
                            {{ $faq->status }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary editBtn"
                            data-id="{{ $faq->id }}"
                            data-question="{{ $faq->question }}"
                            data-answer="{{ $faq->answer }}"
                            data-status="{{ $faq->status }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editFaqModal">
                            Edit
                        </button>

                        <form action="{{ route('admin.blogs.faqs.delete', $faq->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this FAQ?')">
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

<!-- Add FAQ Modal -->
<div class="modal fade" id="addFaqModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.blogs.faqs.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label>Question</label>
                        <input type="text" name="question" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Answer</label>
                        <input type="text" name="answer" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
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


<!-- Edit FAQ Modal -->
<div class="modal fade" id="editFaqModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="editFaqForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6"><label>Question</label><input type="text" name="question" id="edit-question" class="form-control"></div>
                    <div class="col-md-6"><label>Answer</label><input type="text" name="answer" id="edit-answer" class="form-control"></div>
                    <div class="col-md-6"><label>Status</label>
                        <select name="status" id="edit-status" class="form-control">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
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

<!-- JS for Edit Modal and Add More -->
<script>
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const form = document.getElementById('editFaqForm');
            form.action = `/admin/blogs/faqs/update/${id}`;

            document.getElementById('edit-question').value = this.dataset.question;
            document.getElementById('edit-answer').value = this.dataset.answer;
            document.getElementById('edit-status').value = this.dataset.status;
        });
    });

    // Add More FAQs
    document.getElementById('addMoreFaq').addEventListener('click', function () {
        const faqGroup = document.querySelector('.faq-group');
        const clone = faqGroup.cloneNode(true);
        clone.querySelectorAll('input').forEach(input => input.value = '');
        document.getElementById('faqRepeater').appendChild(clone);
    });

    // Remove FAQ block
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('removeFaq')) {
            const total = document.querySelectorAll('.faq-group').length;
            if (total > 1) {
                e.target.closest('.faq-group').remove();
            }
        }
    });
</script>
@endsection
