@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <h4>Manage Popup</h4>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editPopupModal">
                Edit Popup Details
            </button>
        </div>

        <hr>

        {{-- Table listing current popup images --}}
        <h5>Existing Images</h5>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($popup->images as $image)
                    <tr>
                        <td>
                            <img src="{{ asset("public/$image->image_path") }}" alt="Popup Image" style="height:100px;">
                        </td>
                        <td>
                            <form action="{{ route('admin.popup.image.delete', $image->id) }}" method="POST"
                                onsubmit="return confirm('Delete this image?');" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">No images found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Edit Popup Modal --}}
    <div class="modal fade" id="editPopupModal" tabindex="-1" aria-labelledby="editPopupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{ route('admin.popup.update', $popup->id) }}" enctype="multipart/form-data"
                id="editPopupForm">
                @csrf
                @method('PUT')

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPopupModalLabel">Edit Popup Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Popup Title (optional)</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ old('title', $popup->title) }}">
                        </div>
                        <input type="hidden" name="id" value="{{ $popup->id }}">

                        <div class="mb-3 form-check">
                            <input type="hidden" name="active" value="0"> <!-- Ensures 0 sent if unchecked -->
                            <input type="checkbox" name="active" id="active" class="form-check-input" value="1" {{ $popup->active ? 'checked' : '' }}>
                            <label for="active" class="form-check-label">Active</label>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <label for="images" class="form-label">Add New Images (multiple allowed)</label>
                            <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Popup</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection