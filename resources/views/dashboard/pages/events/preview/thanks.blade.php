@extends('dashboard.pages.events.preview.layout')

@section('title', 'Invitation')

@section('content')




    <div class="flex-grow-1 d-flex flex-column justify-content-center align-items-center" style="min-height: 75vh">
        <!-- Circle with Checkmark -->
        <div class="d-flex justify-content-center align-items-center bg-primary rounded-circle mb-3"
            style="aspect-ratio: 1 / 1; width: 8vw; max-width: 100px; min-width: 60px; font-size: 3rem; font-weight: bold;">
            <i class="fa-solid fa-check"></i>
        </div>

        <!-- Thank You Text -->
        <div class="text-center">
            <h1 class="display-3 fw-bold text-primary">Thank You!</h1>
            <p class="fs-5 text-start">We appreciate your response. Your submission was successful.</p>
            <a href="{{ route('event.invitation', $token) }}" class="btn btn-primary btn-orange-main mt-3">Back to
                Invitation</a>
        </div>
    </div>

    
@endsection
