<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BorrowedBook;

class StudentController extends Controller
{
    // صفحة الطالب الرئيسية
    public function dashboard()
    {
        $borrowedBooks = auth()->user()->borrowedBooks()->with('book')->get();
        return view('student.dashboard', compact('borrowedBooks'));
    }

    // عرض كل الكتب
    public function listBooks()
    {
        $books = Book::all();
        return view('student.books.index', compact('books'));
    }

    // استعارة كتاب
    public function borrowBook($id)
    {
        $book = Book::findOrFail($id);

        // التأكد أن الطالب لم يستعر الكتاب مسبقاً ولم يرجعه
        $alreadyBorrowed = auth()->user()->borrowedBooks()
            ->where('book_id', $id)
            ->whereNull('returned_at')
            ->exists();

        if ($alreadyBorrowed) {
            return back()->with('error', 'لقد قمت باستعارة هذا الكتاب بالفعل ولم ترجه بعد.');
        }

        if ($book->quantity > 0) {
            $book->decrement('quantity');

            auth()->user()->borrowedBooks()->create([
                'book_id' => $book->id,
                'borrowed_at' => now(),
            ]);

            return back()->with('success', 'تم استعارة الكتاب بنجاح');
        }

        return back()->with('error', 'هذا الكتاب غير متاح حالياً');
    }

    // ارجاع كتاب
    public function returnBook($id)
    {
        $borrow = auth()->user()->borrowedBooks()
            ->where('book_id', $id)
            ->whereNull('returned_at')
            ->firstOrFail();

        // زيادة الكمية
        $borrow->book->increment('quantity');

        // تسجيل وقت الإرجاع
        $borrow->update([
            'returned_at' => now(),
        ]);

        return back()->with('success', 'تم إرجاع الكتاب بنجاح');
    }
}