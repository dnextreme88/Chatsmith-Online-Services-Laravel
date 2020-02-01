@extends('layouts.app')

@section('title')
Edit User Settings - Upload User Profile Image
@endsection

@section('content')
<div class="container">
    <h3 align="center">Update Profile Image</h3>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <p>Upload Validation Errors</p>
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ session('success') }}
        </div>
        <!-- Display successfully uploaded image -->
        <p>New profile image:</p>
        <img src="/images/{{ Session::get('path') }}" class="img-thumbnail img-responsive mx-auto d-block avatar-thumbnail-medium" />
    @endif
            @if (session('success')) <!-- Get old image when new image has uploaded -->
                <p>Old profile image:</p>
                <img src="/{{ Session::get('old_profile_image') }}" class="img-thumbnail img-responsive avatar-thumbnail-small" />
            @elseif ($user->profile_image == '') <!-- Display a text when user doesn't have any profile image. -->
                <p>You currently do not have a profile image. Upload one now. Please follow the guidelines:</p>
                <ol>
                    <li>File to be uploaded must be an image.</li>
                    <li>Image file size must not exceed more than 2 MB.</li>
                    <li>Supported image extensions: <strong>.jpeg, .png, .jpg, .gif</strong></li>
                </ol>
            @else <!-- Get current image when the view is loaded -->
                <p>Current profile image:</p>
                <img src="{{ asset(auth()->user()->image) }}" class="img-thumbnail img-responsive avatar-thumbnail-small" />
            @endif
        <form method="post" action="/user/uploadfile/{{ $user->id }}" enctype="multipart/form-data">
            @csrf
            <!-- User ID (readonly) -->
            <div class="form-group row">
                <label for="user_id" class="col-md-4 col-form-label text-md-right">User ID</label>

                <div class="col-md-6">
                    <input id="user_id" readonly class="form-control-plaintext input-lg" type="text" placeholder="{{ $user->id }}">
                </div>
            </div>
            <!-- Upload file -->
            <div class="form-group row">
                <label for="select_file" class="col-md-4 col-form-label text-md-right">Select file to upload</label>

                <div class="col-md-6">
                    <input type="file" class="form-control input-lg" id="select_file" name="select_file" />
                    <small class="form-text text-muted">Accepted extensions: .jpeg, .png, .jpg, .gif</small>
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-4 offset-md-2">
                    <a class="btn btn-danger" href="/profile/">Back to Profile</a>
                </div>
                <div class="col-md-4 offset-md-2">
                    <input type="submit" name="upload" class="btn btn-primary" value="Upload">
                </div>
            </div>
        </form>
</div>
@endsection
