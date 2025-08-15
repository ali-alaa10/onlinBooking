@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Student Details</h1>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h4 class="card-title">{{ $student->name }}</h4>
            <p class="mb-1"><strong>Email:</strong> {{ $student->email }}</p>
            <p class="mb-1"><strong>Student ID:</strong> {{ $student->student_id ?? 'N/A' }}</p>
            <p class="mb-0"><strong>Role:</strong> {{ ucfirst($student->role) }}</p>
        </div>
    </div>

    <h3 class="mb-3">Borrowed Books</h3>
    @if(isset($student->borrowedBooks) && $student->borrowedBooks->count() > 0)
    <div class="list-group mb-4">
        @foreach($student->borrowedBooks as $book)
        <div class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <strong>{{ $book->title }}</strong>
                <small class="text-muted d-block">Author: {{ $book->author }}</small>
            </div>
            <span class="badge bg-primary rounded-pill">Borrowed</span>
        </div>
        @endforeach
    </div>
    @else
    <p class="text-muted">This student hasn't borrowed any books yet.</p>
    @endif

    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
</div>
@endsection