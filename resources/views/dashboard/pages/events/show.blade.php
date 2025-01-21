@extends("dashboard.layout")

@section("tab-title", "Event Details")
@section("events_activation", "active")

@section("content")

<div class="row">
    <div class="col-sm-12 col-lg-8">

        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h1>{{ $event->title }}</h1>
                </div>

                <div class="card-img">
                    <img src="{{ asset('storage') }}/{{ @$event->event_image->path }}/{{ @$event->event_image->image }}"
                        alt="Event Image" class="img-fluid" height="60%">
                </div>


                <div class="py-3 px-2">
                    <div class="date pb-2 fw-bold" id="date">
                        <div class="d-inline rounded px-2" style="background-color: #EAEFF8">
                            <span class="ps-">{{ Carbon\Carbon::parse($event->start_date_time)->format('d-M-Y l') }}</span>
                        </div>
                    </div>

                    <div class="">
                        <div><span class="fw-medium fs-4 py-1">Event Description</span></div>
                        <div>
                            {{ $event->long_description }}
                        </div>
                    </div>

                    <div class="d-flex btns pt-5 pb-2">
                        <a href="{{ route('event.edit', $event) }}" class="btn btn-success mx-1">Update</a>

                        <div>
                            <!-- Button trigger modal -->
                            <a href="#" class="btn btn-danger mx-1"  data-bs-toggle="modal" data-bs-target="#delete_event">Remove</a>

                            <!-- Modal -->
                            <div class="modal fade" id="delete_event" tabindex="-1" aria-labelledby="delete_event" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 fw-bold">{{ $event->title }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body fw-bold">
                                        Are you sure to delete this event ?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('event.destroy', $event) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Delete" class="btn btn-danger">
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('event.preview', $event) }}" class="btn btn-orange-main mx-1">Preview</a>
                    </div>
                </div>

            </div>
        </div>

    </div>


    <div class="col-sm-12 col-lg-4">

        <div class="card info-card w-75">
            <div class="card-body py-0">
                <h5 class="card-title my-0">
                    <a href="{{ route('attendee.index', $event) }}">
                        <i class="bi bi-people fs-4 px-2"></i>
                        List of Attendees
                    </a>
                </h5>
            </div>
        </div>

        <div class="card info-card w-75">
            <div class="card-body">
                <h5 class="card-title">Attendees</h5>

                <div class="d-flex align-items-center">
                    <div class="card-icon event-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                        <h6 class="card-value">{{ $event->attendees->count() }}</h6>
                    </div>
                </div>

            </div>
        </div>

        <div class="card info-card w-75">
            <div class="card-body">
                <h5 class="card-title">Confirmed Attendees</h5>

                <div class="d-flex align-items-center">
                    <div
                        class="card-icon event-check-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-check-lg"></i>
                    </div>
                    <div class="ps-3">
                        <h6 class="card-value">{{ $confirmed }}</h6>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection