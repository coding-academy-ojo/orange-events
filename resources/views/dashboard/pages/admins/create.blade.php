@extends("dashboard.layout")

@section("tab-title", "Add New Admin")
@section("admins_activation", "active")

@section("content")


  <div class="pagetitle">
    <h1>Add New Admin</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item">Admins</li>
        <li class="breadcrumb-item active">Add Admin</li>
      </ol>
    </nav>
  </div>



  <div class="row">
    <div class="col-sm-12 col-lg-8">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Add Admin</h5>

          @session('addingSuccessfully')
              <div class="alert alert-success alert-dismissible fade show">
                  {{ session('addingSuccessfully') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          @endsession

          <form action="{{ route('admin.store') }}" method="POST">
            @csrf

            <div class="my-2">
              <label class="form-label">Full Name</label>
              <input type="text" class="form-control" value="{{ old('full_name') }}" name="full_name">
              @error('full_name')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>



            <div class="my-2">
              <label class="form-label">Email</label>
              <input type="text" class="form-control" value="{{ old('email') }}" name="email">
              @error('email')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="my-4">
              <select class="form-select" name="role">
                <option selected>Select</option>
                <option value="admin">Admin</option>
                <option value="super_admin">Super Admin</option>
              </select>
              @error('role')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            {{-- <div class="row my-2">
              <div class="col-sm-12 col-lg-6">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
                @error('password')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="col-sm-12 col-lg-6">
                <label class="form-label">Password Confirmation</label>
                <input type="password" class="form-control" name="password_confirmation">
                @error('password_confirmation')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div> --}}


            <div class="my-5 d-grid gap-2">
              <input type="submit" value="Add" class="btn btn-orange-main">
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>


@endsection