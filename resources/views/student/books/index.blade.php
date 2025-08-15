@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>قائمة الكتب المتاحة</h3>

        @if($books->count() > 0)
            <div class="row">
                @foreach($books as $book)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5>{{ $book->title }}</h5>
                                <p>{{ $book->author }}</p>
                                <p>عدد النسخ المتاحة: {{ $book->quantity }}</p>

                                @if($book->quantity > 0)
                                    <form action="{{ route('student.books.borrow', $book->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">استعارة</button>
                                    </form>
                                @else
                                    <span class="text-danger">غير متاح حالياً</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>لا توجد كتب حالياً</p>
        @endif
    </div>
@endsection
