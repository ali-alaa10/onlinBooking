@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>تفاصيل الكتاب</h4>
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $book->title }}</h5>
            <p class="card-text"><strong>المؤلف:</strong> {{ $book->author ?? 'غير محدد' }}</p>
            <p class="card-text"><strong>الوصف:</strong> {{ $book->description ?? 'لا يوجد وصف' }}</p>
            <p class="card-text"><strong>الكمية المتاحة:</strong> {{ $book->quantity }}</p>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">رجوع للقائمة</a>
            <div>
                <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-warning">تعديل</a>
                <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection