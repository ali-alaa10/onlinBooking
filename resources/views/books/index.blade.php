@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>كل الكتب</h1>
        <ul>
            @foreach($books as $book)
                <li>{{ $book->title }}</li>
            @endforeach
        </ul>
    </div>
@endsection
