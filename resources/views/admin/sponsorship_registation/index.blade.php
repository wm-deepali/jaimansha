@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Sponsorship Registrations</h4>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSponsorshipRegModal">
        + Add New
    </button>
</div>


    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Company</th>
                <th>Address</th>
                <th>Country</th>
                <th>State</th>
                <th>City</th>
                <th>Pin Code</th>
                <th>Type</th>
                <th>Details</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $item->full_name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->mobile }}</td>
                <td>{{ $item->company_name ?? '-' }}</td>
                <td>{{ $item->address }}</td>
                <td>{{ $item->country }}</td>
                <td>{{ $item->state }}</td>
                <td>{{ $item->city }}</td>
                <td>{{ $item->pincode }}</td>
                <td>{{ ucfirst($item->sponsorship_type) }}</td>
                <td>{{ Str::limit($item->detail, 50) }}</td>
                <td>
                    <button class="btn btn-sm btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#editSponsorshipRegModal"
                            onclick='setEditData(@json($item))'>
                        Edit
                    </button>

                    <form action="{{ route('admin.sponsorship_registation.destroy', $item->id) }}"
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
<div class="modal fade" id="addSponsorshipRegModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.sponsorship_registation.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Sponsorship Registration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row">
                    @foreach([
                        'full_name' => 'Full Name',
                        'email' => 'Email',
                        'mobile' => 'Mobile Number',
                        'company_name' => 'Company / Institution',
                        'address' => 'Address',
                        'country' => 'Country',
                        'state' => 'State',
                        'city' => 'City',
                        'pincode' => 'Pin Code',
                        'detail' => 'Detail'
                    ] as $field => $label)
                        <div class="col-md-{{ in_array($field, ['address','detail']) ? '12' : '6' }} mb-3">
                            <label>{{ $label }}</label>
                            @if(in_array($field, ['address','detail']))
                                <textarea name="{{ $field }}" class="form-control" rows="2" required></textarea>
                            @else
                                <input type="text" name="{{ $field }}" class="form-control" required>
                            @endif
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
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="editSponsorshipRegModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="editSponsorshipRegForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Sponsorship Registration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row">
                    <input type="hidden" name="id" id="edit_id">

                    @foreach([
                        'full_name' => 'Full Name',
                        'email' => 'Email',
                        'mobile' => 'Mobile Number',
                        'company_name' => 'Company / Institution',
                        'address' => 'Address',
                        'country' => 'Country',
                        'state' => 'State',
                        'city' => 'City',
                        'pincode' => 'Pin Code',
                        'detail' => 'Detail'
                    ] as $field => $label)
                        <div class="col-md-{{ in_array($field, ['address','detail']) ? '12' : '6' }} mb-3">
                            <label>{{ $label }}</label>
                            @if(in_array($field, ['address','detail']))
                                <textarea name="{{ $field }}" id="edit_{{ $field }}" class="form-control" rows="2"></textarea>
                            @else
                                <input type="text" name="{{ $field }}" id="edit_{{ $field }}" class="form-control">
                            @endif
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

        const fields = [
            'full_name', 'email', 'mobile', 'company_name',
            'address', 'country', 'state', 'city', 'pincode',
            'detail', 'sponsorship_type'
        ];

        fields.forEach(field => {
            let input = document.getElementById('edit_' + field);
            if (input) input.value = item[field] ?? '';
        });

        const form = document.getElementById('editSponsorshipRegForm');
        form.action = `/admin/sponsorship_registation/update/${item.id}`;
    }
</script>
@endsection
