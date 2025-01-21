@extends("dashboard.layout")

@section("tab-title", "List of Admins")
@section("admins_activation", "active")

@section("content")


  <div class="pagetitle">
    <h1>All Admins</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">Admins</li>
      </ol>
    </nav>
  </div>



  <div class="card">
    <div class="card-body">
        <div class="row card-title px-2">
          <div class="col col-sm-6 col-lg-10">
            <h5>All Admins</h5>
          </div>
          <div class="col col-sm-6 col-lg-2 d-flex flex-row-reverse">
            <div>
              <a href="{{ route('admin.create') }}" class="btn btn-orange-main">Add New Admin</a>
            </div>
          </div>
        </div>

      <div class="table-responsive">
        <table class="table table-striped datatable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Full Name</th>
              <th scope="col">Email</th>
              <th scope="col">Role</th>
              <th scope="col">Status</th>
              <th scope="col">Register at</th>
              <th scope="col">Action</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($admins as $admin)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $admin->full_name }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->role }}</td>
                <td>
                  @if ($admin->status == "active")
                    <span class="badge text-bg-success">{{ $admin->status }}</span>
                  @else
                    <span class="badge text-bg-danger">{{ $admin->status }}</span>
                  @endif
                </td>
                <td>{{ $admin->created_at }}</td>
                <td><a href="{{ route('admin.show', $admin) }}" class="btn btn-orange-main">Show</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>



@endsection