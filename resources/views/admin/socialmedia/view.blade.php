@extends('admin.layouts.app')

@section('content')
<div class="container py-4">
    <h3>Social Media Links</h3>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Social Media Links Form --}}
    <form action="{{ route('admin.socialmedia.update') }}" method="POST">
        @csrf

        @foreach(['facebook', 'twitter', 'linkedin', 'youtube', 'pintreset', 'gplus', 'instagram'] as $platform)
            <div class="mb-3">
                <label for="{{ $platform }}" class="form-label">{{ ucfirst($platform) }} Link</label>
                <input type="text" class="form-control" name="{{ $platform }}"
                    id="{{ $platform }}"
                    value="{{ old($platform, $social->{$platform} ?? '') }}">
            </div>
        @endforeach

        <button type="submit" class="btn btn-success">Save Links</button>
    </form>

    {{-- Divider --}}
    <hr class="my-4">

    {{-- Table showing current saved social links --}}
    <h5>Current Saved Links</h5>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Platform</th>
                    <th>Link</th>
                </tr>
            </thead>
            <tbody>
                @foreach(['facebook', 'twitter', 'linkedin', 'youtube', 'pintreset', 'gplus', 'instagram'] as $platform)
                    @php
                        $link = $social->{$platform} ?? '';
                    @endphp
                    <tr>
                        <td>{{ ucfirst($platform) }}</td>
                        <td>
                            @if($link)
                                <a href="{{ $link }}" target="_blank">{{ $link }}</a>
                            @else
                                <em>No link added</em>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
