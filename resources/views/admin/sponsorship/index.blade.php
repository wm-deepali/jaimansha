@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Sponsorship List</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSponsorshipModal">
            + Add Sponsorship
        </button>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Title1</th>
                <th>Title2</th>
                <th>Title3</th>
                <th>Title4</th>
                <th>Short Desc 1</th>
                <th>Short Desc 2</th>
                <th>Short Desc 3</th>
                <th>Type</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $item->title1 }}</td>
                <td>{{ $item->title2 }}</td>
                <td>{{ $item->title3 }}</td>
                <td>{{ $item->title4 }}</td>
            <td>{!! \Illuminate\Support\Str::limit(strip_tags($item->short_description1), 20) !!}</td>
<td>{!! \Illuminate\Support\Str::limit(strip_tags($item->short_description2), 20) !!}</td>
<td>{!! \Illuminate\Support\Str::limit(strip_tags($item->short_description3), 20) !!}</td>

                <td>{{ ucfirst($item->sponsorship_type) }}</td>
                <td>{{ $item->status ? 'Active' : 'Inactive' }}</td>
                <td>
                    <button class="btn btn-sm btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#editSponsorshipModal"
                            onclick='setEditData(@json($item))'>
                        Edit
                    </button>

                    <form action="{{ route('admin.sponsorship.destroy', $item->id) }}"
                          method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addSponsorshipModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.sponsorship.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Sponsorship</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row">
                    @foreach(['title1', 'title2', 'title3', 'title4'] as $t)
                        <div class="col-md-6 mb-3">
                            <label>{{ ucfirst($t) }}</label>
                            <input type="text" name="{{ $t }}" class="form-control" {{ $t === 'title1' ? 'required' : '' }}>
                        </div>
                    @endforeach

                    @foreach(['short_description1', 'short_description2', 'short_description3'] as $d)
                        <div class="col-md-12 mb-3">
                            <label>{{ ucfirst(str_replace('_', ' ', $d)) }}</label>
                            <textarea name="{{ $d }}" class="form-control rich-editor"></textarea>
                        </div>
                    @endforeach

                    <div class="col-md-6 mb-3">
                        <label>Sponsorship Type</label>
                        <select name="sponsorship_type" class="form-control" required>
                            <option value="">-- Select Type --</option>
                            <option value="event">Event</option>
                            <option value="scholarship">Scholarship</option>
                            <option value="education">Education</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editSponsorshipModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="editSponsorshipForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Sponsorship</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row">
                    <input type="hidden" name="id" id="edit_id">

                    @foreach(['title1', 'title2', 'title3', 'title4'] as $t)
                        <div class="col-md-6 mb-3">
                            <label>{{ ucfirst($t) }}</label>
                            <input type="text" name="{{ $t }}" id="edit_{{ $t }}" class="form-control">
                        </div>
                    @endforeach

                    @foreach(['short_description1', 'short_description2', 'short_description3'] as $d)
                        <div class="col-md-12 mb-3">
                            <label>{{ ucfirst(str_replace('_', ' ', $d)) }}</label>
                            <textarea name="{{ $d }}" id="edit_{{ $d }}" class="form-control rich-editor"></textarea>
                        </div>
                    @endforeach

                    <div class="col-md-6 mb-3">
                        <label>Sponsorship Type</label>
                        <select name="sponsorship_type" id="edit_sponsorship_type" class="form-control" required>
                            <option value="">-- Select Type --</option>
                            <option value="event">Event</option>
                            <option value="scholarship">Scholarship</option>
                            <option value="education">Education</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Status</label>
                        <select name="status" id="edit_status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
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

<script>
function setEditData(item) {
    document.getElementById('edit_id').value = item.id;

    // Normal input fields
    ['title1', 'title2', 'title3', 'title4', 'sponsorship_type', 'status']
        .forEach(field => {
            let input = document.getElementById('edit_' + field);
            if (input) input.value = item[field] ?? '';
        });

    // Summernote वाले fields
    ['short_description1', 'short_description2', 'short_description3']
        .forEach(field => {
            let editor = $('#edit_' + field);
            if (editor.length) {
                editor.summernote('code', item[field] ?? '');
            }
        });

    // Form action set करना
    const form = document.getElementById('editSponsorshipForm');
    form.action = `/admin/sponsorship/update/${item.id}`;
}
</script>

@endsection
