@extends('dashboard.pages.guest.layout')

@section('tab-title', 'Reset Password')

@section('content')
<div class="card mb-3">

    <div class="card-body">

        <div class="pt-4 pb-2 mb-3">
            <h5 class="card-title text-center pb-0 fs-4">Reset Password</h5>
        </div>

        <form action="{{ route('password.store') }}" method="POST" class="row g-3 needs-validation">
            @csrf
            <input type="hidden" name="token" value="{{ $request->token }}">

            {{-- Password --}}
            <div class="col-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ $request->email }}" required>
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password --}}
            <div class="col-12">
                <label for="yourPassword" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="yourPassword" required>
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password Confirmation --}}
            <div class="col-12">
                <label for="password_confirmation" class="form-label">Password Confirmation</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                    required>
                @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-12">
                <button class="btn btn-orange-main w-100" type="submit">Reset Password</button>
            </div>
        </form>

    </div>
</div>
@endsection