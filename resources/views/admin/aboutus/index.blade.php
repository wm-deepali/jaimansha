@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>About Us Management</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#aboutModal" onclick="resetForm()">
            + Add About Info
        </button>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Heading 1</th>
                <th>Heading 2</th>
                <!--<th>Description</th>-->
                <th>Image 1</th>
                <th>Image 2</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $item->heading_1 }}</td>
                <td>{{ $item->heading_2 }}</td>
                <!--<td style="white-space: pre-wrap;">{!! $item->Description !!}</td>-->
           <td>
    @if($item->image_1)
        <img src="{{ asset($item->image_1) }}" width="60" alt="Image 1">
    @endif
</td>
<td>
    @if($item->image_2)
        <img src="{{ asset($item->image_2) }}" width="60" alt="Image 2">
    @endif
</td>

                <td>
                    <button
                        class="btn btn-sm btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#aboutModal"
                        onclick='setEditData(@json($item))'>
                        Edit
                    </button>

                    <form action="{{ route('admin.aboutus.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add/Edit Modal -->
<div class="modal fade" id="aboutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="aboutForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.aboutus.store') }}">
            @csrf
            <input type="hidden" name="id" id="edit_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add/Edit About Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label>Heading 1</label>
                        <input type="text" name="heading_1" id="heading_1" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Heading 2</label>
                        <input type="text" name="heading_2" id="heading_2" class="form-control">
                    </div>

                   <div class="mb-3">
    <label>Description</label>
    <textarea name="Description" id="DescriptionEditor" class="form-control" rows="3"></textarea>
</div>


                    <div class="mb-3">
                        <label>Image 1</label><br>
                        <img id="edit_img1_preview" src="" width="50" class="mb-2 d-none" alt="Image 1 Preview">
                        <input type="file" name="image_1" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Image 2</label><br>
                        <img id="edit_img2_preview" src="" width="50" class="mb-2 d-none" alt="Image 2 Preview">
                        <input type="file" name="image_2" class="form-control">
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

<!-- CKEditor CDN -->
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<script>
    // Replace the Description textarea with CKEditor
    CKEDITOR.replace('DescriptionEditor');

    // Ensure Description value is synced when editing
    function setEditData(item) {
        document.getElementById('edit_id').value = item.id;
        document.getElementById('heading_1').value = item.heading_1;
        document.getElementById('heading_2').value = item.heading_2;

        if (CKEDITOR.instances.DescriptionEditor) {
            CKEDITOR.instances.DescriptionEditor.setData(item.Description);
        }

        const img1 = document.getElementById('edit_img1_preview');
        if(item.image_1) {
            img1.src = '/' + item.image_1;
            img1.classList.remove('d-none');
        } else {
            img1.src = '';
            img1.classList.add('d-none');
        }

        const img2 = document.getElementById('edit_img2_preview');
        if(item.image_2) {
            img2.src = '/' + item.image_2;
            img2.classList.remove('d-none');
        } else {
            img2.src = '';
            img2.classList.add('d-none');
        }

        const form = document.getElementById('aboutForm');
        form.action = `{{ url('admin/aboutus/update') }}/${item.id}`;
    }

    function resetForm() {
        document.getElementById('edit_id').value = '';
        document.getElementById('heading_1').value = '';
        document.getElementById('heading_2').value = '';

        if (CKEDITOR.instances.DescriptionEditor) {
            CKEDITOR.instances.DescriptionEditor.setData('');
        }

        const img1 = document.getElementById('edit_img1_preview');
        img1.src = '';
        img1.classList.add('d-none');

        const img2 = document.getElementById('edit_img2_preview');
        img2.src = '';
        img2.classList.add('d-none');

        document.getElementById('aboutForm').action = '{{ route("admin.aboutus.store") }}';
    }
</script>

@endsection
