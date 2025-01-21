@extends('dashboard.layout')

@section('tab-title', 'Add New Event')
@section('events_activation', 'active')

@section('content')


<div class="pagetitle">
    <h1>Add New Event</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item">Events</li>
            <li class="breadcrumb-item active">Add Event</li>
        </ol>
    </nav>
</div>



<div class="row">
    <div class="col-sm-12 col-lg-8">

        <div class="card">
            <div class="card-body py-3">

                @session('eventAddedSuccessfully')
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('eventAddedSuccessfully') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endsession

                <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="my-2">
                        <label class="form-label fw-semibold">Event Title</label>
                        <input type="text" class="form-control" value="{{ old('title') }}" name="title">
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label class="form-label fw-semibold">Image</label>
                        <input type="file" class="form-control" value="{{ old('image') }}" name="image">
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row my-2">
                        <div class="col-sm-12 col-lg-6">
                            <label class="form-label fw-semibold">Starting Date</label>
                            <input type="datetime-local" class="form-control" value="{{ old('start_date_time') }}"
                                name="start_date_time">
                            @error('start_date_time')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <label class="form-label fw-semibold">Ending Date</label>
                            <input type="datetime-local" class="form-control" value="{{ old('end_date_time') }}"
                                name="end_date_time">
                            @error('end_date_time')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="my-2">
                        <label class="form-label fw-semibold">Location</label>
                        <input type="text" class="form-control" value="{{ old('location') }}" name="location">
                        @error('location')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label class="form-label fw-semibold">Google Maps Location Link</label>
                        <input type="text" class="form-control" value="{{ old('location_link') }}" name="location_link">
                        @error('location_link')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label class="form-label fw-semibold">Short Description</label>
                        <textarea class="form-control" name="short_description" style="height: 7rem" cols="30"
                            rows="10">{{ old('short_description') }}</textarea>
                        @error('short_description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label class="form-label fw-semibold">Long Description</label>
                        <textarea class="form-control" name="long_description" style="height: 9rem" cols="30"
                            rows="10">{{ old('long_description') }}</textarea>
                        @error('long_description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="my-5 d-grid gap-2">
                        <input type="submit" value="Add" class="btn btn-orange-main">
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


@endsection