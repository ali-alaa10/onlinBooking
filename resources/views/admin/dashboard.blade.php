@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Admin Dashboard</h1>

    <div class="row mb-4">
        <div class="col-md-12 text-end">
            <a href="{{ route('admin.books.create') }}" class="btn btn-success">Add New Book</a>
        </div>
    </div>

    <div class="row mb-5">
        @foreach($books as $book)
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <p class="card-text"><strong>Author:</strong> {{ $book->author }}</p>
                    <p class="card-text">{{ $book->description }}</p>
                    <p class="card-text"><strong>Quantity:</strong> {{ $book->quantity }}</p>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-primary btn-sm">Edit</a>

                    <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <h2 class="mb-3">Students</h2>
    <div class="row">
        @foreach($students as $student)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $student->name }}</h5>
                    <p class="card-text">{{ $student->email }}</p>
                    <a href="{{ route('admin.students.view', $student->id) }}" class="btn btn-info btn-sm">View
                        Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection