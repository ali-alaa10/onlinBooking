@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>مرحباً {{ auth()->user()->name }} 👋</h3>
        <p>هذه هي لوحة التحكم الخاصة بك كطالب.</p>

        {{-- زر تصفح الكتب --}}
        <a href="{{ route('student.books.index') }}" class="btn btn-primary mb-3">
            📚 تصفح الكتب
        </a>

        {{-- قائمة الكتب المستعارة --}}
        <div class="card">
            <div class="card-header">كتبي المستعارة</div>
            <div class="card-body">
                @if(isset($borrowedBooks) && $borrowedBooks->count() > 0)
                    <ul class="list-group">
                        @foreach($borrowedBooks as $borrow)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $borrow->book->title }}
                                <span>
                                    {{ \Carbon\Carbon::parse($borrow->borrowed_at)->format('d-m-Y') }}
                                    @if($borrow->returned_at)
                                        - تمت الإعادة
                                    @else
                                        {{-- زر إرجاع الكتاب --}}
                                        <form action="{{ route('student.books.return', $borrow->book->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-warning">
                                                إرجاع
                                            </button>
                                        </form>
                                    @endif
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>لا توجد كتب مستعارة حالياً</p>
                @endif
            </div>
        </div>
    </div>
@endsection
