@extends('dashboard.pages.events.preview.layout')

@section('title', 'Invitation')

@section('content')
    <div class="flex">
        <div class="container-fluid bg-dark m-0 px-0 top-width hero-padding">
            <div class=" border border-1 border-dark p-0 m-0 img-wrapper">
                <div class="bg-image w-100 image-container image-shadow">
                    @if (isset($token))
                        <img src="{{ asset('storage') }}/{{ $token->event->event_image->path }}/{{ $token->event->event_image->image }}"
                            alt="" style="height: 100%;" class="w-100">
                    @else
                        <img src="{{ asset('storage') }}/{{ $event->event_image->path }}/{{ $event->event_image->image }}"
                            alt="" style="height: 100%;" class="w-100">
                    @endif

                    <div class="overlay-text w-50 d-lg-block d-none">
                        <h1 class="text-primary">{{ $token->event->title ?? $event->title }}</h1>
                        <p class="text-white">{{ $token->event->short_description ?? $event->short_description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid px-5 mt-20 main-width">
        <!-- Event details -->
        <div class="container-fluid mt-20">
            <div class="row align-items-center">
                <!-- Date Circle -->
                <div class="col-auto">
                    <div class="d-flex flex-column align-items-center justify-content-center bg-primary text-white rounded-circle"
                        style="
                aspect-ratio: 1 / 1;
                width: 8vw;
                max-width: 100px;
                min-width: 60px;
              ">
                        @php
                            $startDateTime = \Carbon\Carbon::parse(
                                $token->event->start_date_time ?? $event->start_date_time,
                            );
                            $endDateTime = \Carbon\Carbon::parse($token->event->end_date_time ?? $event->end_date_time);
                        @endphp
                        <span class="m-0 pb-1 fs-5">{{ $startDateTime->format('M') }}</span>
                        <span class="h3 m-0">{{ $startDateTime->format('d') }}</span>
                    </div>
                </div>

                <!-- Event Details -->
                <div class="col">
                    <h2 class="mb-0">{{ $token->event->title ?? $event->title }}</h2>
                    <br />
                    <!-- Location and Time -->
                    <div class="d-flex align-items-center">
                        <i
                            class="fa-solid fa-location-dot me-2"></i><span>{{ $token->event->location ?? $event->location }}</span>
                        <span class="mx-2">|</span>
                        <i class="fa-solid fa-clock me-2"></i>
                        <span> {{ $startDateTime->format('H:i') }} - {{ $endDateTime->format('H:i') }} </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-20">
            <div class="text-start">
                <h2>About the event</h2>
                <div class="hr-under"></div>
            </div>
            <div class="mt-4 text-wrap">
                <p class="text-break">
                    {{ $token->event->long_description ?? $event->long_description }}
                </p>
            </div>
        </div>

        <div class="container-fluid mt-20">
            <div class="text-start">
                <h2>Event Location</h2>
                <div class="hr-under"></div>
            </div>
            <div class="mt-4 text-wrap"></div>
        </div>
    </div>

    <div>
        <iframe style="width: 100%;"
            @if (isset($token)) src="{{ $token->event->location_link }}"
            @else
                src="{{ $event->location_link }}" @endif
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>

    <div class="container-fluid px-5 mt-20 main-width">
        <div class="container-fluid mt-20">
            <div class="text-start">
                <h2>Register Now</h2>
                <div class="hr-under"></div>
            </div>
            <div class="mt-4 text-wra">
                <form class="mt-4" action="{{ route('attendee.invtiation.store') }}" method="POST">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="token" value="{{ $token->token ?? null }}">
                    <div class="row">
                        <!-- First Line: 3 Form Fields -->
                        <div class="col-md-6 col-lg-4 mb-3">
                            <label for="name" class="form-label">Your name</label>
                            <input type="text" id="name" name="name" class="form-control rounded" placeholder=""
                                required value="{{ $token->attendee->name ?? null }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 col-lg-4 mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" id="email" name="email" class="form-control rounded" placeholder=""
                                required value="{{ $token->attendee->email ?? null }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 col-lg-4 mb-3">
                            <label for="mobile" class="form-label">Mobile no.</label>
                            <input type="tel" id="mobile" name="phone" class="form-control rounded" placeholder=""
                                required value="{{ $token->attendee->phone ?? null }}">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Second Line: 2 Form Fields -->
                        <div class="col-md-6 col-lg-4 mb-3">
                            <label for="entity" class="form-label">Entity</label>
                            <input type="text" id="entity" name="entity" class="form-control rounded" placeholder=""
                                value="{{ $token->attendee->entity ?? null }}">
                            @error('entity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 col-lg-4 mb-3">
                            <label for="attendance" class="form-label">Confirm your attendance</label>
                            <select id="attendance" name="confirmation" class="form-select rounded">
                                <option value="accept">Yes, I'll attend</option>
                                <option value="reject">No, I can't attend</option>
                            </select>
                            @error('confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Hidden Textarea -->
                        <div class="col-md-6 col-lg-4 mb-3" id="reason-container" style="visibility:hidden;">
                            <div style="display:none;" id="reason">
                                <label for="reason" class="form-label">Reason</label>
                                <input id="reason" type="text" name="reason" class="form-control rounded"
                                    placeholder="Please provide your reason" id="reason_field"></textarea>
                                @error('reason')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Third Line: Buttons -->
                        <div class="col-md-4 d-flex gap-2">
                            <button type="reset" class="col-1 btn btn-dark rounded w-50">Clear</button>
                            <!-- <input type="reset" value="Clear" class="btn btn-dark"> -->
                            <button type="submit" class="btn btn-primary rounded text-white w-50">Submit</button>
                        </div>

                    </div>
                </form>

                <script>
                    document.getElementById('attendance').addEventListener('change', function() {
                        const reasonContainer = document.getElementById('reason-container');
                        const reason = document.getElementById('reason');
                        if (this.value === 'reject') {
                            reasonContainer.style.visibility = "visible";
                            reason.style.display = 'block';
                        } else {
                            reason.style.display = 'none';
                            reasonContainer.style.visibility = "hidden";
                        }
                    });
                </script>
            </div>
        </div>
    </div>






    <div class="container-fluid px-5 mt-20 header-width">
        <div class="row align-items-center">
            <div class="col-sm-12 col-lg-3 border-right clickable">
                <a href="#" class="text-decoration-none">
                    <div class="d-flex align-items-center">
                        <div class="px-2">
                            <div class="icon-container">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                        </div>
                        <div class="px-2" id="contact">
                            <h3 class="m-0">For more info</h3>
                            <p class="m-0 fs-5">Always here for your support</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-12 col-lg-9 d-lg-block d-none">
                <p class="px-4">
                    Contact Corporate Communication & Sustainability Unit department for enquires <a
                        href="mailto:Orange.sponsorship@orange.com"><strong>Orange.sponsorship@orange.com
                        </strong></a>&nbsp;or call
                    <strong>0777801212</strong> or visit <strong>Amman - Abdali - The Boulevard - Black Iris St.</strong>
                </p>
            </div>
        </div>
    </div>

@endsection
