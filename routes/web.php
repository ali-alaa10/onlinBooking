<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;

// الصفحة الرئيسية
Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'student') {
            return redirect()->route('student.dashboard');
        }
    }
    return redirect('/login');
});

// تسجيل المستخدمين
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// تسجيل الدخول والخروج
Auth::routes();

// مسارات الـ Admin
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

        // إدارة الكتب (الراوت هتبقى admin.books.index, admin.books.create, admin.books.store, إلخ)
        Route::resource('books', BookController::class);

        // إدارة الطلاب
        Route::get('/students/search', [AdminController::class, 'searchStudent'])->name('students.search');
        Route::get('/students/{id}', [AdminController::class, 'viewStudent'])->name('students.view');
    });

// مسارات الطالب
Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {
        Route::get('/', [StudentController::class, 'dashboard'])->name('dashboard');

        // عرض كل الكتب للطالب
        Route::get('/books', [StudentController::class, 'listBooks'])->name('books.index');

        // استعارة كتاب
        Route::post('/books/{id}/borrow', [StudentController::class, 'borrowBook'])->name('books.borrow');

        // إرجاع كتاب
        Route::post('/books/{id}/return', [StudentController::class, 'returnBook'])->name('books.return');
    });


// عرض الكتب لأي مستخدم (لو حبيت تخليها عامة)
Route::middleware(['auth'])->get('/books', [BookController::class, 'index'])->name('books.index');
