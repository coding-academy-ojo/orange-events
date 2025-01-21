@extends("dashboard.layout")

@section("tab-title", "Admin Profile Details")
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

            @if ($admin->image_path)
              <img src="{{ asset('storage') }}/{{$admin->image_path}}/{{$admin->image}}"
              alt="Profile" class="rounded-circle">
            @else
              <img src="{{ asset("dashboard/assets/img/default-profile.jpg") }}"
              alt="Profile" class="rounded-circle">
            @endif

            <h2>{{ $admin->full_name }}</h2>
            <h3>{{ $admin->role }}</h3>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Full Name</div>
                  <div class="col-lg-9 col-md-8">{{ $admin->full_name }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Role</div>
                  <div class="col-lg-9 col-md-8">{{ $admin->role }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Status</div>
                  <div class="col-lg-9 col-md-8">
                    @if ($admin->status == "active")
                      <span class="badge text-bg-success">{{ $admin->status }}</span>
                    @else
                      <span class="badge text-bg-danger">{{ $admin->status }}</span>
                    @endif
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">{{ $admin->email }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">No. of events updated by admin</div>
                  <div class="col-lg-9 col-md-8">
                    {{ $admin->events->count() }}
                  </div>
                </div>

              </div>

              <div class="tab-pane fade pt-3" id="profile-settings">

                @if (Auth::guard('admin')->user()->id == $admin->id)
                  <button class="btn" style="color: #000; background: #aaaaaa;">
                    Deactive
                  </button>
                  
                  <p>You cann't deactive your self.</p>
                @else
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#admin">
                    Deactive
                  </button>
                  
                  <div class="modal fade" id="admin" tabindex="-1" aria-labelledby="adminLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="adminLabel">Remove Admin</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          Are Yoy sure to remove this admin?
                        </div>
                        <div class="modal-footer">
                          <form action="{{ route('admin.destroy', $admin) }}" method="post">
                            @csrf
                            @method('delete')
                  
                            <input type="submit" value="Remove" class="btn btn-danger">
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif

              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

@endsection