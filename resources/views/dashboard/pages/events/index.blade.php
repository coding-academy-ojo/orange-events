@extends("dashboard.layout")

@section("tab-title", "List of Events")
@section("events_activation", "active")

@section("content")


  <div class="pagetitle">
    <h1>All Events</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">Events</li>
      </ol>
    </nav>
  </div>



  <div class="card">
    <div class="card-body">
        <div class="row card-title px-2">
          <div class="col col-sm-6 col-lg-10">
            <h5>All Events</h5>
          </div>
          <div class="col col-sm-6 col-lg-2 d-flex flex-row-reverse">
            <div>
              <a href="{{ route('event.create') }}" class="btn btn-orange-main">Add New Event</a>
            </div>
          </div>
        </div>

      <div class="table-responsive">
        <table class="table table-striped datatable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Event Title</th>
              <th scope="col">Stating Date</th>
              <th scope="col">Ending Date</th>
              <th scope="col">Status</th>
              <th scope="col">Updated By</th>
              <th scope="col">Action</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($events as $event)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $event->title }}</td>
                <td>{{ $event->start_date_time }}</td>
                <td>{{ $event->end_date_time }}</td>
                <td>
                  @if ($event->status == "active")
                    <span class="badge text-bg-success">{{ $event->status }}</span>
                  @else
                    <span class="badge text-bg-danger">{{ $event->status }}</span>
                  @endif
                </td>
                <td>{{ $event->admin->full_name }}</td>
                <td><a href="{{ route('event.show', $event) }}" class="btn btn-orange-main">Show</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>


@endsection