@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Book</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.books.update', $book->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Book Title</label>
                    <input type="text" name="title" id="title" class="form-control"
                        value="{{ old('title', $book->title) }}" required>
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" name="author" id="author" class="form-control"
                        value="{{ old('author', $book->author) }}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description"
                        class="form-control">{{ old('description', $book->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="form-control"
                        value="{{ old('quantity', $book->quantity) }}" min="1" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Book</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection