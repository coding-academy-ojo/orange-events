@extends("dashboard.layout")

@section("tab-title", "List of Attendees")
@section("attendees_activation", "active")

@section("content")


  <div class="pagetitle">
    <h1>List of Attendees</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">List of Attendees</li>
      </ol>
    </nav>
  </div>



  <div class="card">
    <div class="card-body py-3">

      <div class="mb-2">
        <a href="{{ route('attendee.export') }}" class="btn btn-success">Export Attendees</a>
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
                <td><a href="{{ route('attendee.show', $attendee) }}" class="btn btn-orange-main">Show</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>


@endsection