@extends('dashboard.pages.guest.layout')

@section('tab-title', 'Forgot Password')


@section('content')


@session('status')
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('status') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endsession

<div class="card mb-3">

    <div class="card-body">

        <div class="pt-4 pb-2 mb-3">
            <h5 class="card-title text-center pb-0 fs-4">Forgot Password</h5>
        </div>

        <form action="{{ route('password.email') }}" method="POST" class="row g-3 needs-validation">
            @csrf

            {{-- Email --}}
            <div class="col-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-12">
                <button class="btn btn-orange-main w-100" type="submit">Email Password Rest Link</button>
                <a href="{{ route('login') }}" class="btn back-to-home w-100 mt-2 border border-0"><i
                        class="bi bi-caret-left-fill"></i> Back To Login</a>
            </div>
        </form>

    </div>
</div>
@endsection