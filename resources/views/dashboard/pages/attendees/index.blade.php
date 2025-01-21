@extends("dashboard.layout")

@section("tab-title", "List of Attendees")
@section("events_activation", "active")

@section("content")


  <div class="pagetitle">
    <h1>List of Attendees</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item">Events</li>
        <li class="breadcrumb-item text-truncate" style="width: 150px;">{{ $event->title }}sfsdfsdfsdfsd efsdfsdf </li>
        <li class="breadcrumb-item active">List of Attendees</li>
      </ol>
    </nav>
  </div>

  <div class="card">
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

            <input type="hidden" name="event_id" value="{{ $event->id }}">

            <div class="col-lg-3 my-1">
              <input type="submit" class="btn btn-orange-main" value="Upload">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
        <div class="row card-title me-1">
          <div class="col-sm-12 col-lg-6 my-1">
            <a href="{{ route('attendee.export', $event->id) }}" class="btn btn-success">Export Attendees</a>
          </div>
          <div class="col-sm-12 col-lg-6 my-1">

            <div class="d-flex flex-md-row-reverse">
              <a href="{{ route("attendee.create", $event) }}" class="btn btn-orange-main">Add Attendee</a>
            </div>
          </div>

        </div>

      <div class="table-responsive">
        <table class="table table-striped datatable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Phone</th>
              <th scope="col">Entity</th>
              <th scope="col">Confirmation</th>
              <th scope="col">Action</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($attendees as $attendee)
              <tr>
                <th>{{ $loop->iteration }}</th>
                <td>{{ $attendee->name }}</td>
                <td>{{ $attendee->email }}</td>
                <td>{{ $attendee->phone }}</td>
                <td>{{ $attendee->entity }}</td>
                <td>
                  @if ($attendee->confirmation == 'confirmed')
                    <span class="badge text-bg-success">{{ $attendee->confirmation }}</span>
                  @elseif ($attendee->confirmation == 'declined')
                    <span class="badge text-bg-danger">{{ $attendee->confirmation }}</span>
                  @else
                    <span class="badge text-bg-primary">{{ $attendee->confirmation }}</span>
                  @endif
                </td>
                <td><a href="{{ route('attendee.show', $attendee->id) }}" class="btn btn-orange-main">Show</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>


@endsection