@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>إضافة كتاب جديد</h2>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.books.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>عنوان الكتاب</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>المؤلف</label>
            <input type="text" name="author" class="form-control">
        </div>
        <div class="mb-3">
            <label>الوصف</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>الكمية</label>
            <input type="number" name="quantity" class="form-control" value="1" min="1">
        </div>
        <button type="submit" class="btn btn-success">حفظ الكتاب</button>
        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">رجوع</a>
    </form>
</div>
@endsection