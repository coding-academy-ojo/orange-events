@extends("dashboard.layout")

@section("tab-title", "Add New Attendee")
@section("events_activation", "active")

@section("content")


  <div class="pagetitle">
    <h1>Add New Attendee</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item">Events</li>
        <li class="breadcrumb-item active">Add Attendee</li>
      </ol>
    </nav>
  </div>



  <div class="row">
    <div class="col-sm-12 col-lg-8">

      <div class="card">
        <div class="card-body py-3">


          @session('addedSuccessfully')
              <div class="alert alert-success alert-dismissible fade show">
                  {{ session('addedSuccessfully') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          @endsession

          <form action="{{ route('attendee.store') }}" method="POST">
            @csrf

            <input type="hidden" name="event_id" value="{{ $event_id }}">

            <div class="my-2">
              <label class="form-label fw-semibold">Name</label>
              <input type="text" class="form-control" value="{{ old('name') }}" name="name">
              @error('name')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>


            <div class="my-2">
              <label class="form-label fw-semibold">Email</label>
              <input type="email" class="form-control" value="{{ old('email') }}" name="email">
              @error('email')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="my-2">
              <label class="form-label fw-semibold">Phone</label>
              <input type="tel" class="form-control" value="{{ old('phone') }}" name="phone">
              @error('phone')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="my-2">
              <label class="form-label fw-semibold">Entity</label>
              <input type="text" class="form-control" value="{{ old('entity') }}" name="entity">
              @error('entity')
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
