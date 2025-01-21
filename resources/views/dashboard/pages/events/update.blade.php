@extends("dashboard.layout")

@section("tab-title", "Update Event | xxxx")
@section("events_activation", "active")

@section("content")


  <div class="pagetitle">
    <h1>Update Event</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item">Events</li>
        <li class="breadcrumb-item active">Update Event</li>
      </ol>
    </nav>
  </div>



  <div class="row">
    <div class="col-sm-12 col-lg-8">

      <div class="card">
        <div class="card-body py-3">

          @session('eventUpdatedSuccessfully')
              <div class="alert alert-success alert-dismissible fade show">
                  {{ session('eventUpdatedSuccessfully') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          @endsession

          <form action="{{ route('event.update', $event) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="my-3">
              <label class="form-label fw-semibold">Event Title</label>
              <input type="text" class="form-control" name="title" value="{{ $event->title }}">
              @error('title')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="my-3">
              <label class="form-label fw-semibold">Image</label> <small>(If you want to keep image don't upload new one.)</small>
              <input type="file" class="form-control" name="image">
              @error('image')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>


            <div class="row my-2">
              <div class="col-sm-12 col-lg-6">
                <label class="form-label fw-semibold">Starting Date</label>
                <input type="datetime-local" class="form-control" name="start_date_time" value="{{ $event->start_date_time }}">
                @error('start_date_time')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-sm-12 col-lg-6">
                <label class="form-label fw-semibold">Ending date</label>
                <input type="datetime-local" class="form-control" name="end_date_time" value="{{ $event->end_date_time }}">
                @error('end_date_time')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="my-2">
              <label class="form-label fw-semibold">Google Maps Location Link</label>
              <input type="text" class="form-control" value="{{ $event->location_link }}" name="location_link">
              @error('location_link')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>

            <div class="my-3">
              <label class="form-label fw-semibold">Location</label>
              <input type="text" class="form-control" name="location"  value="{{ $event->location }}">
              @error('location')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="my-3">
              <label class="form-label fw-semibold">Short Description</label>
              <textarea  class="form-control" name="short_description" style="height: 7rem"
              cols="30" rows="10">{{ $event->short_description }}</textarea>
              @error('short_description')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>


            <div class="my-3">
              <label class="form-label fw-semibold">Long Description</label>
              <textarea  class="form-control" name="long_description" style="height: 9rem"
              cols="30" rows="10">{{ $event->long_description }}</textarea>
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