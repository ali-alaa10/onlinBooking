<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('admin.books.index', compact('books')); // غيرت المسار علشان يكون في مجلد admin
    }

    public function create()
    {
        return view('admin.books.create'); // عرض صفحة إضافة كتاب
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
        ]);

        Book::create($validated);

        return redirect()->route('admin.books.index')
            ->with('success', 'تم إضافة الكتاب بنجاح');
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.books.show', compact('book'));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $book = Book::findOrFail($id);
        $book->update($validated);

        return redirect()->route('admin.books.index')
            ->with('success', 'تم تعديل الكتاب بنجاح');
    }

    public function destroy($id)
    {
        Book::findOrFail($id)->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'تم حذف الكتاب بنجاح');
    }
}
