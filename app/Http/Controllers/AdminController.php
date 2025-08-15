<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;

class AdminController extends Controller
{
    public function dashboard()
    {
        $books = Book::all();
        $students = User::where('role', 'student')->get();
        return view('admin.dashboard', compact('books', 'students'));
    }

    public function searchStudent(Request $request)
    {
        $student = User::where('role', 'student')
            ->where('student_id', $request->student_id)
            ->first();

        if (!$student) {
            return back()->with('error', 'الطالب غير موجود');
        }

        return view('admin.view-student', compact('student'));
    }


    public function viewStudent($id)
    {
        $student = User::findOrFail($id);
        return view('admin.view-student', compact('student'));
    }
}