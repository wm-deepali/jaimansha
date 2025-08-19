@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <h4>Career Inquiry Details</h4>
        <div class="card p-4">
            <p><strong>Date & Time:</strong> {{ $applied_job->created_at->format('d M Y, h:i A') }}</p>
            <p><strong>Post Applied:</strong> {{ $applied_job->applied_post }}</p>
            <p><strong>Full Name:</strong> {{ $applied_job->name }}</p>
            <p><strong>Email Id:</strong> {{ $applied_job->email }}</p>
            <p><strong>Mobile Number:</strong> {{ $applied_job->mobile }}</p>
            <p><strong>Status:</strong> {{ $applied_job->status ?? 'Active' }}</p>
            <p><strong>Message:</strong></p>
            <p>{{ $applied_job->message ?? 'No message provided' }}</p>

            <p><strong>Resume:</strong>
                @if($applied_job->resume_path)
                    <a href="{{ asset('public/uploads/resumes/' . $applied_job->resume_path) }}" target="_blank">Download</a>
                @else
                    Not Provided
                @endif
            </p>

            {{-- Add more fields here as needed, e.g., resume download, cover letter, etc. --}}
            <a href="{{ route('admin.career_inquiries.index') }}" class="btn btn-secondary mt-3">Back to List</a>
        </div>
    </div>
@endsection