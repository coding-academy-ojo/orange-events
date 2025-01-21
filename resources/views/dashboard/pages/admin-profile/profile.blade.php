@extends("dashboard.layout")

@section("tab-title", "Dashboard")
@section("admins_activation", "active")

@section("content")


  <div class="pagetitle">
    <h1>Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item active">Profile</li>
      </ol>
    </nav>
  </div>

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="{{ asset('storage') }}/{{Auth::guard('admin')->user()->image_path}}/{{Auth::guard('admin')->user()->image}}"
            alt="Profile" class="rounded-circle">
            <h2>{{Auth::guard('admin')->user()->full_name}}</h2>
            <h3>{{Auth::guard('admin')->user()->role}}</h3>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        @session('status')
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endsession

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Full Name</div>
                  <div class="col-lg-9 col-md-8">{{Auth::guard('admin')->user()->full_name}}</div>
                </div>
                
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">{{Auth::guard('admin')->user()->email}}</div>
                </div>
                
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">ٌRole</div>
                  <div class="col-lg-9 col-md-8">{{ Str::ucfirst(Str::replaceFirst('_', ' ', Auth::guard('admin')->user()->role)) }}</div>
                </div>
                
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Join</div>
                  <div class="col-lg-9 col-md-8">
                    {{ Carbon\Carbon::parse(Auth::guard('admin')->user()->created_at)->format('d-M-Y') }}
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">No. of events updated by you</div>
                  <div class="col-lg-9 col-md-8">
                    {{ Auth::guard('admin')->user()->events->count() }}
                  </div>
                </div>

              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('patch')

                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                      <div class="pt-2">
                        <div class="mb-3">
                          <small>(If you want to keep image don't upload a new one.)</small>
                          <input class="form-control" type="file" name="image">
                          @error('image')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="full_name" type="text" class="form-control" id="fullName" value="{{ Auth::guard('admin')->user()->full_name }}">
                      @error('full_name')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email" class="form-control" id="Email" value="{{ Auth::guard('admin')->user()->email }}">
                      @error('email')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>


                  <div class="text-center">
                    <button type="submit" class="btn btn-orange-main">Save Changes</button>
                  </div>
                </form>
              </div>

              <div class="tab-pane fade pt-3" id="profile-change-password">
                <form action="{{ route('password.update') }}" method="POST">
                  @csrf
                  @method('put')

                  <div class="row mb-3">
                    <label for="current_password" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="current_password" type="password" class="form-control" id="current_password">
                      @error('current_password')
                        <span class="text-danger">
                          {{ $message }}
                        </span>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password" type="password" class="form-control" id="password">
                      @error('password')
                        <span class="text-danger">
                          {{ $message }}
                        </span>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="password_confirmation" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password_confirmation" type="password" class="form-control" id="password_confirmation">
                      @error('password_confirmation')
                        <span class="text-danger">
                          {{ $message }}
                        </span>
                      @enderror
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-orange-main">Change Password</button>
                  </div>
                </form><!-- End Change Password Form -->

              </div>

            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

@endsection