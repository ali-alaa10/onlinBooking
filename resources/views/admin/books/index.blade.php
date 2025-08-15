@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Books Management</h2>
    <a href="{{ route('admin.books.create') }}" class="btn btn-primary">Add New Book</a>
</div>

<div class="row">
    @forelse($books as $book)
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $book->title }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ $book->author }}</h6>
                <p class="card-text">{{ Str::limit($book->description, 100) }}</p>
                <p class="mt-auto"><strong>Quantity:</strong> {{ $book->quantity }}</p>
                <div class="mt-2 d-flex justify-content-between">
                    <a href="{{ route('admin.books.show', $book->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this book?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <p class="text-muted">No books found.</p>
    @endforelse
</div>
@endsection