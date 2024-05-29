@extends('layouts.admin_panel')

@section('title')
    Add Announcement Form
@endsection

@section('content')
<div class="container">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('announcements.index') }}">Announcements</a></li>
            <li class="breadcrumb-item">Create Announcement</li>
        </ol>
    </div>
    <div class="card">
        <div class="card-header">Add Announcement Form</div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }} You may go back and see <a href="{{ route('announcements.index') }}" class="alert-link">all the announcements</a>.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('announcements.store') }}" method="POST">
                @csrf
                <!-- Title -->
                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                    <div class="col-md-6">
                        <input id="title" class="form-control input-lg" type="text" name="title">
                    </div>
                </div>
                <!-- Description -->
                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                    <div class="col-md-6">
                        <textarea id="description" class="form-control input-lg" name="description" rows="12"></textarea>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <input class="btn btn-primary" type="submit" name="submit" value="Add Announcement">
                    </div>
                </div>
            </form>

            @if ($errors->any())
                <div class="mt-4 alert alert-danger" role="alert">
                    <p>Add Announcement Errors</p>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
