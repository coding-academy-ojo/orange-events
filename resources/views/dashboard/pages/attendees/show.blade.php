@extends('dashboard.layout')

@section('tab-title', 'Admin Profile Details')
@section('attendees_activation', 'active')

@section('content')


<div class="pagetitle">
    <h1>Profile</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item">Attendees</li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </nav>
</div>

<section class="section profile">
    <div class="row">
        {{-- <div class="col-xl-4">

            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    <img src="{{ asset('dashboard/assets/img/attendees/attendee.jpg') }}" alt="Profile"
                        class="rounded-circle">
                    <h2>{{ $attendee->name }}</h2>
                    <h3>{{ $attendee->phone }}</h3>
                </div>
            </div>

        </div> --}}

        <div class="col-xl-12">

            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab"
                                data-bs-target="#profile-overview">Overview</button>
                        </li>

                        {{-- <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab"
                                data-bs-target="#profile-settings">Settings</button>
                        </li> --}}

                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">Profile Details</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                <div class="col-lg-9 col-md-8">{{ $attendee->name }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8">{{ $attendee->email }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Phone</div>
                                <div class="col-lg-9 col-md-8">{{ $attendee->phone }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Entity</div>
                                <div class="col-lg-9 col-md-8">{{ $attendee->entity }}</div>
                            </div>

                            {{-- <div class="row">
                                <div class="col-lg-3 col-md-4 label">Confiramtion</div>
                                <div class="col-lg-9 col-md-8">
                                    @if ($attendee->confirmation == 'confirmed')
                                        <span class="badge text-bg-success">{{ $attendee->confirmation }}</span>
                                    @elseif ($attendee->confirmation == 'declined')
                                        <span class="badge text-bg-danger">{{ $attendee->confirmation }}</span>
                                    @else
                                        <span class="badge text-bg-primary">{{ $attendee->confirmation }}</span>
                                    @endif
                                </div>
                            </div> --}}

                            @if ($attendee->reason)
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Reason For</div>
                                    <div class="col-lg-9 col-md-8">{{ $attendee->reason }}</div>
                                </div>
                            @endif

                        </div>

                        <div class="tab-pane fade pt-3" id="profile-settings">

                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#admin">
                                Deactive
                            </button>

                            <div class="modal fade" id="admin" tabindex="-1" aria-labelledby="adminLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="adminLabel">Remove Admin</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are Yoy sure to remove this admin?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="" method="post">
                                                @csrf
                                                @method('delete')

                                                <input type="submit" value="Remove" class="btn btn-danger">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>




<section class="section">
    <div class="card">
        <div class="card-body py-4">
            <div class="table-responsive">
                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Event Title</th>
                            <th scope="col">Stating Date</th>
                            <th scope="col">Ending Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Confirmation</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($events as $event)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $event->event->title }}</td>
                            <td>{{ $event->event->start_date_time }}</td>
                            <td>{{ $event->event->end_date_time }}</td>
                            <td>
                                @if ($event->event->status == 'active')
                                <span class="badge text-bg-success">{{ $event->event->status }}</span>
                                @else
                                <span class="badge text-bg-danger">{{ $event->event->status }}</span>
                                @endif
                            </td>
                            <span style="display: none">
                                {{
                                    $data = DB::table('attendee_event')
                                    ->select('confirmation','reason')
                                    ->where('event_id', $event->event->id)
                                    ->where('attendee_id', $attendee->id)
                                    ->orderBy('created_at', 'desc')
                                    ->limit(1)
                                    ->get()
                                }}
                            </span>
                            <td>{{ ($data)? @$data[0]->confirmation : null }}</td>
                            <td>{{ ($data)? @$data[0]->reason : null }}</td>
                            <td><a href="{{ route('event.show', $event->event->id) }}" class="btn btn-orange-main">Show</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</section>

@endsection