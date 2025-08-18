@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Manage Events</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEventModal">
            Add New Event
        </button>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
   <table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Event Name</th>
            <th>Venue</th>
            <th>Event Date</th>
            <th>Event Time</th>
            <th>Mobile Number</th>
            <th>Short Detail</th>
            <th>Description</th>
            <th>Event Details</th>
            <th>Event Points</th>
            <th>Last Heading</th>
            <th>Last Para</th>
            <th>Thumbnail</th>
            <th>Banner</th>
            <th>PDF</th>
            <th>Slug</th>
            <th>Meta Title</th>
            <th>Meta Keywords</th>
            <th>Meta Description</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($events as $item)
        <tr>
            <td>{{ $item->event_name }}</td>
            <td>{{ $item->event_venue }}</td>
            <td>{{ \Carbon\Carbon::parse($item->event_date)->format('d M, Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($item->event_time)->format('h:i A') }}</td>
            <td>{{ $item->mobile_number }}</td>
<td>{!! \Illuminate\Support\Str::limit(strip_tags($item->short_detail), 20) !!}</td>
<td>{!! \Illuminate\Support\Str::limit(strip_tags($item->description), 20) !!}</td>
<td>{!! \Illuminate\Support\Str::limit(strip_tags($item->event_details), 20) !!}</td>
<td>{!! \Illuminate\Support\Str::limit(strip_tags($item->events_point_para), 20) !!}</td>
<td>{{ \Illuminate\Support\Str::limit(strip_tags($item->event_last_heading), 20) }}</td>
<td>{!! \Illuminate\Support\Str::limit(strip_tags($item->event_last_para), 20) !!}</td>

            <td>
                @if($item->thumb_image)
                    <img src="{{ asset('public/' . $item->thumb_image) }}" alt="Thumb" width="60" height="60">
                @else
                    N/A
                @endif
            </td>
            <td>
                @if($item->banner_image)
                    <img src="{{ asset('public/' . $item->banner_image) }}" alt="Banner" width="60" height="60">
                @else
                    N/A
                @endif
            </td>
            <td>
                @if($item->pdf_file)
                    <a href="{{ asset('public/uploads/events/' . $item->pdf_file) }}" target="_blank">View PDF</a>
                @else
                    N/A
                @endif
            </td>
<td>{{ \Illuminate\Support\Str::limit($item->slug, 10) }}</td>
<td>{{ \Illuminate\Support\Str::limit($item->meta_title, 10) }}</td>
<td>{{ \Illuminate\Support\Str::limit($item->meta_keywords, 10) }}</td>
<td>{!! \Illuminate\Support\Str::limit(strip_tags($item->meta_description), 10) !!}</td>

            <td>
                <span class="badge {{ $item->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                    {{ ucfirst($item->status) }}
                </span>
            </td>
            <td>
                <button class="btn btn-sm btn-primary editBtn"
                    data-id="{{ $item->id }}"
                    data-name="{{ $item->event_name }}"
                    data-venue="{{ $item->event_venue }}"
                    data-date="{{ $item->event_date }}"
                    data-time="{{ $item->event_time }}"
                    data-mobile_number="{{ $item->mobile_number }}"
                    data-short_detail="{{ $item->short_detail }}"
                    data-description="{{ $item->description }}"
                    data-event_details="{{ $item->event_details }}"
                    data-events_point_para="{{ $item->events_point_para }}"
                    data-event_last_heading="{{ $item->event_last_heading }}"
                    data-event_last_para="{{ $item->event_last_para }}"
                    data-pdf_file="{{ $item->pdf_file }}"
                    data-status="{{ $item->status }}"
                    data-thumbnail="{{ $item->thumb_image }}"
                    data-banner="{{ $item->banner_image }}"
                    data-slug="{{ $item->slug }}"
                    data-meta_title="{{ $item->meta_title }}"
                    data-meta_keywords="{{ $item->meta_keywords }}"
                    data-meta_description="{{ $item->meta_description }}"
                    data-bs-toggle="modal"
                    data-bs-target="#editEventModal">
                    Edit
                </button>

                <form action="{{ route('admin.events.event.destroy', $item->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this event?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

    </div>

    {{-- Add Event Modal --}}
    <div class="modal fade" id="addEventModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{ route('admin.events.event.store') }}" enctype="multipart/form-data" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label>Event Name</label>
                        <input type="text" name="event_name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Venue</label>
                        <input type="text" name="event_venue" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Event Date</label>
                        <input type="date" name="event_date" class="form-control" required>
                    </div>
                    
                    <div class="col-md-6">
    <label>Mobile Number</label>
    <input type="text" name="mobile_number" class="form-control">
</div>

<div class="col-md-12">
    <label>Event Details</label>
    <textarea name="event_details" class="form-control rich-editor" rows="3"></textarea>
</div>

<div class="col-md-12">
    <label>Event Point Paragraph</label>
    <textarea name="events_point_para" class="form-control rich-editor" rows="3"></textarea>
</div>

<div class="col-md-6">
    <label>Event Last Heading</label>
    <input type="text" name="event_last_heading" class="form-control">
</div>

<div class="col-md-12">
    <label>Event Last Paragraph</label>
    <textarea name="event_last_para" class="form-control rich-editor" rows="3"></textarea>
</div>

<div class="col-md-12">
    <label>Upload PDF</label>
    <input type="file" name="pdf_file" class="form-control">
</div>

                    <div class="col-md-6">
                        <label>Event Time</label>
                        <input type="time" name="event_time" class="form-control" required>
                    </div>
                    <div class="col-md-12">
                        <label>Short Detail</label>
                        <input type="text" name="short_detail" class="form-control" required>
                    </div>
                    <div class="col-md-12">
                        <label>Description</label>
                        <textarea name="description" class="form-control rich-editor" rows="4"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label>Thumb Image</label>
                        <input type="file" name="thumb_image" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Banner Image</label>
                        <input type="file" name="banner_image" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label>Upload PDF (optional)</label>
                        <input type="file" name="pdf" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Slug</label>
                        <input type="text" name="slug" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Meta Title</label>
                        <input type="text" name="meta_title" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label>Meta Keywords</label>
                        <input type="text" name="meta_keywords" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label>Meta Description</label>
                        <textarea name="meta_description" class="form-control " rows="2"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="status" class="form-select" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-success" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Event Modal --}}
    <div class="modal fade" id="editEventModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form id="editEventForm" method="POST" action="" enctype="multipart/form-data" class="modal-content">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body row g-3">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="col-md-6">
                        <label>Event Name</label>
                        <input type="text" name="event_name" id="edit-name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Venue</label>
                        <input type="text" name="event_venue" id="edit-venue" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Event Date</label>
                        <input type="date" name="event_date" id="edit-date" class="form-control" required>
                    </div>
                    <div class="col-md-6">
    <label>Mobile Number</label>
    <input type="text" name="mobile_number" id="edit-mobile-number" class="form-control">
</div>

<div class="col-md-12">
    <label>Event Details</label>
    <textarea name="event_details" id="edit-event-details" class="form-control rich-editor" rows="3"></textarea>
</div>

<div class="col-md-12">
    <label>Event Point Paragraph</label>
    <textarea name="events_point_para" id="edit-events-point-para" class="form-control rich-editor" rows="3"></textarea>
</div>

<div class="col-md-6">
    <label>Event Last Heading</label>
    <input type="text" name="event_last_heading" id="edit-event-last-heading" class="form-control">
</div>

<div class="col-md-12">
    <label>Event Last Paragraph</label>
    <textarea name="event_last_para" id="edit-event-last-para" class="form-control rich-editor" rows="3"></textarea>
</div>

<div class="col-md-12">
    <label>Upload PDF</label>
    <input type="file" name="pdf_file" class="form-control">
    <!-- Optional: existing PDF link -->
    <div id="existing-pdf-link" class="mt-2"></div>
</div>


                    <div class="col-md-6">
                        <label>Event Time</label>
                        <input type="time" name="event_time" id="edit-time" class="form-control" required>
                    </div>
                    <div class="col-md-12">
                        <label>Short Detail</label>
                        <input type="text" name="short_detail" id="edit-short-detail" class="form-control" required>
                    </div>
                    <div class="col-md-12">
                        <label>Description</label>
                        <textarea name="description" id="edit-description" class="form-control rich-editor" rows="4"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label>Thumb Image</label>
                        <input type="file" name="thumb_image" class="form-control">
                        <img id="preview-thumb" src="" alt="Thumb Image" class="img-thumbnail mt-2" width="100" />
                    </div>
                    <div class="col-md-6">
                        <label>Banner Image</label>
                        <input type="file" name="banner_image" class="form-control">
                        <img id="preview-banner" src="" alt="Banner Image" class="img-thumbnail mt-2" width="100" />
                    </div>

                    <div class="col-md-6">
                        <label>Slug</label>
                        <input type="text" name="slug" id="edit-slug" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Meta Title</label>
                        <input type="text" name="meta_title" id="edit-meta-title" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label>Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="edit-meta-keywords" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label>Meta Description</label>
                        <textarea name="meta_description" id="edit-meta-description" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="col-md-12">
                        <label>Status</label>
                        <select name="status" id="edit-status" class="form-select" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Update</button>
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- JS --}}
<script>
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const venue = this.dataset.venue;
            const date = this.dataset.date;
            const mobile_number = this.dataset.mobile_number;
const event_details = this.dataset.event_details;
const events_point_para = this.dataset.events_point_para;
const event_last_heading = this.dataset.event_last_heading;
const event_last_para = this.dataset.event_last_para;
const pdf_file = this.dataset.pdf_file;
            const time = this.dataset.time;
            const short_detail = this.dataset.short_detail;
            const description = this.dataset.description;
            const status = this.dataset.status;
            const thumb_image = this.dataset.thumbnail;
            const banner_image = this.dataset.banner;
            const slug = this.dataset.slug;
            const meta_title = this.dataset.meta_title;
            const meta_keywords = this.dataset.meta_keywords;
            const meta_description = this.dataset.meta_description;
            
         
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-venue').value = venue;
            document.getElementById('edit-date').value = date;
            document.getElementById('edit-mobile-number').value = mobile_number || '';
$('#edit-event-details').summernote('code', event_details || '');
$('#edit-events-point-para').summernote('code', events_point_para || '');
$('#edit-event-last-heading').val(event_last_heading || '');
$('#edit-event-last-para').summernote('code', event_last_para || '');


if (pdf_file) {
    document.getElementById('existing-pdf-link').innerHTML =
        `<a href="/uploads/events/${pdf_file}" target="_blank">View Existing PDF</a>`;
} else {
    document.getElementById('existing-pdf-link').innerHTML = '';
}
            document.getElementById('edit-time').value = time;
            document.getElementById('edit-short-detail').value = short_detail;
            $('#edit-description').summernote('code', description || '');

            document.getElementById('edit-status').value = status;
            document.getElementById('preview-thumb').src = thumb_image ? `/uploads/events/${thumb_image}` : '';
            document.getElementById('preview-banner').src = banner_image ? `/uploads/events/${banner_image}` : '';

            document.getElementById('edit-slug').value = slug;
            document.getElementById('edit-meta-title').value = meta_title;
            document.getElementById('edit-meta-keywords').value = meta_keywords;
            document.getElementById('edit-meta-description').value = meta_description;

            document.getElementById('editEventForm').action = `/admin/event/${id}`;
        });
    });
</script>
@endsection
