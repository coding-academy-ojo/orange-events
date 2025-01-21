@extends("dashboard.layout")

@section("tab-title", "List of Events")
@section("events_activation", "active")

@section("content")


  <div class="pagetitle">
    <h1>List of Attendees</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item">Events</li>
        <li class="breadcrumb-item">event_title</li>
        <li class="breadcrumb-item active">List of Attendees</li>
      </ol>
    </nav>
  </div>

  {{-- <div class="card">
    <div class="card-body py-0">
      <div class="row card-title px-2">
        <div class="col col-sm-6 col-lg-10">
          <h5>Upload List of Attendees</h5>
          <form action="{{ route('attendee.upload') }}" method="post" class="row" enctype="multipart/form-data">
            @csrf

            <div class="col-lg-4 my-1">
              <input type="file" name="attendee" class="form-control" accept="xlsx">
              <small style="font-size: 14px">(Upload excel sheet)</small>
              @error('attendee')
                <span class="text-danger d-block">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-lg-3 my-1">
              <input type="submit" class="btn btn-orange-main" value="Upload">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div> --}}

  <div class="card">
    <div class="card-body p-0">
        {{-- <div class="row card-title me-1">
          <div class="col-sm-12 col-lg-10">
          </div>
          <div class="col-sm-12 col-lg-2 d-flex flex-row-reverse">
            <div>
              <a href="" class="btn btn-orange-main">Add Attendee</a>
            </div>
          </div>
        </div> --}}

      <form action="{{ route('attendee.upload_list') }}" method="post">
        @csrf

        <div class="m-3 d-flex flex-row-reverse">
          <input type="submit" value="Approve" class="btn btn-orange-main">
          <input type="hidden" value="{{ $event_id }}" name="event_id">
        </div>
        <div class="table-responsive">
          <table class="table table-striped datatabl list">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Entity</th>
              </tr>
            </thead>

            <tbody>

              @foreach ($attendees[0] as $attendee)
                @if ($loop->iteration == 1)
                  @continue
                @endif
                
                <tr>
                  <th>{{ $loop->index }}</th>
                  <td><input type="text" name="name{{ $loop->index }}" value="{{ $attendee[0] }}" class="form-control"></td>
                  <td><input type="email" name="email{{ $loop->index }}" value="{{ $attendee[1] }}" class="form-control"></td>
                  <td><input type="tel" name="phone{{ $loop->index }}" value="{{ $attendee[2] }}" class="form-control"></td>
                  <td><input type="text" name="entity{{ $loop->index }}" value="{{ $attendee[3] }}" class="form-control"></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </form>

    </div>
  </div>


@endsection