@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>News Management</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewsModal">
            Add News
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>News Title</th>
                    <th>News Type</th>
                    <th>Content/File/Link</th>
                    <th>Meta Title</th>
                    <th>Meta Keywords</th>
                    <th>Meta Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($news as $item)
                <tr>
                    <td>
                        @if($item->news_type == 'pdf' && $item->pdf_file)
                            <a href="{{ asset('public/uploads/news_pdf/'.$item->pdf_file) }}" target="_blank">{{ $item->news_title }}</a>
                        @elseif($item->news_type == 'link' && $item->link)
                            <a href="{{ $item->link }}" target="_blank">{{ $item->news_title }}</a>
                        @elseif($item->news_type == 'detail')
                            <a href="{{ route('admin.news.index', $item->slug) }}">{{ $item->news_title }}</a>
                        @else
                            {{ $item->news_title }}
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-info">{{ ucfirst($item->news_type ?? 'N/A') }}</span>
                    </td>
                    <td>
                        @if($item->news_type == 'pdf' && $item->pdf_file)
                            <div class="d-flex align-items-center">
                                <i class="fas fa-file-pdf text-danger me-2"></i>
                                         <a href="{{ asset('public/uploads/news_pdfs/' . $item->pdf_file) }}" target="_blank">
                                       {!! $item->news_title !!}
                            </div>
                        @elseif($item->news_type == 'link' && $item->link_url)
                            <div class="d-flex align-items-center">
                                <i class="fas fa-external-link-alt text-primary me-2"></i>
                                <a href="{{ $item->link_url }}" target="_blank" class="text-decoration-none text-truncate" style="max-width: 200px;">
                                    {!! $item->link_url !!}
                                </a>
                            </div>
                        @elseif($item->news_type == 'detail' && $item->detail_content)
                            <div class="d-flex align-items-center">
                                <i class="fas fa-align-left text-success me-2"></i>
                                <span class="text-truncate" style="max-width: 200px;" title="{{ strip_tags($item->detail_content) }}">
                                    {!! $item->detail_content !!}
                                </span>
                            </div>
                        @else
                            <span class="text-muted">No content</span>
                        @endif
                    </td>
                    <td>{{ $item->meta_title }}</td>
                    <td>{{ $item->meta_keywords }}</td>
                    <td>{{ Str::limit($item->meta_desc, 50) }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary editBtn"
                            data-id="{{ $item->id }}"
                            data-news_title="{{ $item->news_title }}"
                            data-news_type="{{ $item->news_type }}"
                            data-detail_content="{{ $item->detail_content }}"
                            data-pdf_file="{{ $item->pdf_file }}"
                            data-link_url="{{ $item->link_url }}"
                            data-slug="{{ $item->slug }}"
                            data-meta_title="{{ $item->meta_title }}"
                            data-meta_keywords="{{ $item->meta_keywords }}"
                            data-meta_description="{{ $item->meta_description }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editNewsModal">
                            <i class="fas fa-edit"></i> Edit
                        </button>

                        <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure to delete this news?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Add Modal --}}
    <div class="modal fade" id="addNewsModal" tabindex="-1" aria-labelledby="addNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data" id="addNewsForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add News</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">News Title</label>
                            <input type="text" name="news_title" id="add_news_title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">News Type</label>
                            <select name="news_type" id="add_news_type" class="form-control" required>
                                <option value="">-- Select News Type --</option>
                                <option value="detail">Detail Content</option>
                                <option value="pdf">PDF</option>
                                <option value="link">Link</option>
                            </select>
                        </div>

                        {{-- Conditional fields --}}
                        <div id="add_detail_content_div" style="display:none;">
                            <div class="mb-3">
                                <label class="form-label">Detail Content</label>
                                <textarea name="detail_content" class="form-control rich-editor" rows="6" placeholder="Enter detailed content here..."></textarea>
                            </div>
                        </div>

                        <div id="add_pdf_file_div" style="display:none;">
                            <div class="mb-3">
                                <label class="form-label">Upload PDF</label>
                                <input type="file" name="pdf_file" accept="application/pdf" class="form-control">
                                <small class="text-muted">Only PDF files are allowed</small>
                            </div>
                        </div>

                        <div id="add_link_div" style="display:none;">
                            <div class="mb-3">
                                <label class="form-label">URL Link</label>
                                <input type="url" name="link_url" class="form-control" placeholder="https://example.com">
                                <small class="text-muted">Enter a valid URL</small>
                            </div>
                        </div>

                        <hr>
                        <h6>SEO Meta Information</h6>

                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" id="add_meta_title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta Keywords</label>
                            <input type="text" name="meta_keywords" id="add_meta_keywords" class="form-control" placeholder="keyword1, keyword2, keyword3">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description" id="add_meta_description" class="form-control" rows="3" placeholder="Brief description for search engines"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save News</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editNewsModal" tabindex="-1" aria-labelledby="editNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="" enctype="multipart/form-data" id="editNewsForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit News</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">News Title</label>
                            <input type="text" name="news_title" id="edit_news_title" class="form-control" required>
                        </div>

                        {{-- Show current news type as readonly --}}
                        <div class="mb-3">
                            <label class="form-label">Current News Type</label>
                            <input type="text" id="current_news_type_display" class="form-control" readonly>
                            <input type="hidden" name="news_type" id="edit_news_type">
                            <small class="text-muted">News type cannot be changed during editing</small>
                        </div>

                        {{-- Conditional fields for editing (only show current type) --}}
                        <div id="edit_detail_content_div" style="display:none;">
                            <div class="mb-3">
                                <label class="form-label">Detail Content</label>
                                <textarea name="detail_content" id="edit_detail_content" class="form-control rich-editor" rows="6"></textarea>
                            </div>
                        </div>

                        <div id="edit_pdf_file_div" style="display:none;">
                            <div class="mb-3">
                                <label class="form-label">Upload New PDF (Leave blank to keep existing)</label>
                                <input type="file" name="pdf_file" accept="application/pdf" class="form-control">
                                <div id="current_pdf_link" class="mt-2"></div>
                                <small class="text-muted">Only PDF files are allowed</small>
                            </div>
                        </div>

                        <div id="edit_link_div" style="display:none;">
                            <div class="mb-3">
                                <label class="form-label">URL Link</label>
                                <input type="url" name="link_url" id="edit_link" class="form-control">
                            </div>
                        </div>

                        <hr>
                        <h6>SEO Meta Information</h6>

                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" id="edit_meta_title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta Keywords</label>
                            <input type="text" name="meta_keywords" id="edit_meta_keywords" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description" id="edit_meta_description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update News</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Scripts for showing/hiding fields based on news type --}}
<script>
    function toggleFields(type, prefix) {
        const detailDiv = document.getElementById(prefix + '_detail_content_div');
        const pdfDiv = document.getElementById(prefix + '_pdf_file_div');
        const linkDiv = document.getElementById(prefix + '_link_div');

        // Hide all fields first
        detailDiv.style.display = 'none';
        pdfDiv.style.display = 'none';
        linkDiv.style.display = 'none';

        // Show relevant field based on type
        if(type === 'detail') {
            detailDiv.style.display = 'block';
        } else if(type === 'pdf') {
            pdfDiv.style.display = 'block';
        } else if(type === 'link') {
            linkDiv.style.display = 'block';
        }
    }

    // Add Modal - News type change handler
    document.getElementById('add_news_type').addEventListener('change', function() {
        toggleFields(this.value, 'add');
    });

    // Edit Modal setup on button click
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const data = this.dataset;

            // Set basic fields
            document.getElementById('edit_id').value = data.id;
            document.getElementById('edit_news_title').value = data.news_title;
            document.getElementById('edit_news_type').value = data.news_type;

            // Show current news type as readonly
            document.getElementById('current_news_type_display').value = data.news_type ? data.news_type.charAt(0).toUpperCase() + data.news_type.slice(1) : 'Not Set';

            // Set content based on type
            document.getElementById('edit_detail_content').value = data.detail_content || '';
            document.getElementById('edit_link').value = data.link || '';

            // Set meta fields
            document.getElementById('edit_meta_title').value = data.meta_title || '';
            document.getElementById('edit_meta_keywords').value = data.meta_keywords || '';
            document.getElementById('edit_meta_description').value = data.meta_description || '';

            // Show only the relevant field for current news type
            toggleFields(data.news_type, 'edit');

            // Handle PDF display
            const pdfLinkDiv = document.getElementById('current_pdf_link');
            if(data.news_type === 'pdf' && data.pdf_file) {
                pdfLinkDiv.innerHTML = `
                    <div class="alert alert-info p-2">
                        <i class="fas fa-file-pdf text-danger"></i>
                        <strong>Current PDF:</strong>
                        <a href="/uploads/news_pdf/${data.pdf_file}" target="_blank" class="text-decoration-none">
                            ${data.pdf_file}
                        </a>
                    </div>
                `;
            } else {
                pdfLinkDiv.innerHTML = '';
            }

            // Set form action
            document.getElementById('editNewsForm').action = `/admin/news/update/${data.id}`;
        });
    });

    // Auto-fill meta fields from news title in Add modal
    document.getElementById('add_news_title').addEventListener('input', function() {
        const val = this.value;
        document.getElementById('add_meta_title').value = val;
        document.getElementById('add_meta_keywords').value = val;
        document.getElementById('add_meta_description').value = val;
    });

    // Reset Add modal when it's closed
    document.getElementById('addNewsModal').addEventListener('hidden.bs.modal', function () {
        document.getElementById('addNewsForm').reset();
        toggleFields('', 'add'); // Hide all conditional fields
    });

    // Form validation before submit
    document.getElementById('addNewsForm').addEventListener('submit', function(e) {
        const newsType = document.getElementById('add_news_type').value;

        if (!newsType) {
            e.preventDefault();
            alert('Please select a news type');
            return false;
        }

        // Check if required field for selected type is filled
        if (newsType === 'detail') {
            const content = document.querySelector('#add_detail_content_div textarea').value.trim();
            if (!content) {
                e.preventDefault();
                alert('Please enter detail content');
                return false;
            }
        } else if (newsType === 'pdf') {
            const file = document.querySelector('#add_pdf_file_div input[type="file"]').files[0];
            if (!file) {
                e.preventDefault();
                alert('Please select a PDF file');
                return false;
            }
        } else if (newsType === 'link') {
            const link = document.querySelector('#add_link_div input[type="url"]').value.trim();
            if (!link) {
                e.preventDefault();
                alert('Please enter a valid URL');
                return false;
            }
        }
    });
</script>

<style>
/* Custom styling for better UI */
.table th {
    background-color: #495057 !important;
    color: white !important;
    font-weight: 600;
}

.badge {
    font-size: 0.8em;
}

.text-truncate {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.modal-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.form-label {
    font-weight: 600;
    color: #495057;
}

.alert-info {
    background-color: #e3f2fd;
    border-color: #bbdefb;
    color: #1976d2;
}

.btn-sm {
    margin-right: 5px;
}

/* Responsive improvements */
@media (max-width: 768px) {
    .table-responsive {
        font-size: 0.9em;
    }

    .modal-dialog {
        margin: 10px;
    }
}
</style>

@endsection
