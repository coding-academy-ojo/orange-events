@extends("dashboard.layout")

@section('content')
    <h1>Edit Event</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- <form action="{{ route('events.update', $event->event_id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="{{ old('title', $event->title) }}" required>

        <label for="location">Location:</label>
        <input type="text" name="location" id="location" value="{{ old('location', $event->location) }}" required>

        <label for="start_date_time">Start Date & Time:</label>
        <input type="datetime-local" name="start_date_time" id="start_date_time" value="{{ old('start_date_time', $event->start_date_time) }}" required>

        <label for="end_date_time">End Date & Time:</label>
        <input type="datetime-local" name="end_date_time" id="end_date_time" value="{{ old('end_date_time', $event->end_date_time) }}" required>

        <label for="short_description">Short Description:</label>
        <textarea name="short_description" id="short_description">{{ old('short_description', $event->short_description) }}</textarea>

        <label for="long_description">Long Description:</label>
        <textarea name="long_description" id="long_description">{{ old('long_description', $event->long_description) }}</textarea>

        <label for="status">Status:</label>
        <select name="status" id="status" required>
            <option value="active" {{ $event->status == 'active' ? 'selected' : '' }}>Active</option>
            <option value="completed" {{ $event->status == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="cancelled" {{ $event->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>

        <button type="submit" class="btn btn-orange-main">Update Event</button>
    </form> --}}
    <form action="{{ route('events.update', $event->event_id) }}" method="POST" class="container mt-4 p-4 border rounded">
        @csrf
        @method('PUT')
    
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $event->title) }}" required>
        </div>
    
        <div class="mb-3">
            <label for="location" class="form-label">Location:</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $event->location) }}" required>
        </div>
    
        <div class="mb-3">
            <label for="start_date_time" class="form-label">Start Date & Time:</label>
            <input type="datetime-local" name="start_date_time" id="start_date_time" class="form-control" value="{{ old('start_date_time', $event->start_date_time) }}" required>
        </div>
    
        <div class="mb-3">
            <label for="end_date_time" class="form-label">End Date & Time:</label>
            <input type="datetime-local" name="end_date_time" id="end_date_time" class="form-control" value="{{ old('end_date_time', $event->end_date_time) }}" required>
        </div>
    
        <div class="mb-3">
            <label for="short_description" class="form-label">Short Description:</label>
            <textarea name="short_description" id="short_description" class="form-control">{{ old('short_description', $event->short_description) }}</textarea>
        </div>
    
        <div class="mb-3">
            <label for="long_description" class="form-label">Long Description:</label>
            <textarea name="long_description" id="long_description" class="form-control">{{ old('long_description', $event->long_description) }}</textarea>
        </div>
    
        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select name="status" id="status" class="form-select" required>
                <option value="active" {{ $event->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="completed" {{ $event->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $event->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
    
        <button type="submit" class="btn btn-orange-main">Update Event</button>
    </form>
    
@endsection
