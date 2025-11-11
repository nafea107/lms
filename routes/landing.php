<?php


use Illuminate\Support\Facades\Route;

Route::name('landing.')->group(function () {
    Route::get('/settings/{keys}', App\Http\Controllers\Landing\SettingController::class)->name('settings');

    Route::get('/', [App\Http\Controllers\Landing\HomeController::class, 'index'])->name('home');
    Route::get('/search/data', [App\Http\Controllers\Landing\SearchController::class, 'data'])->name('search.data');
    Route::get('/search/{search?}', [App\Http\Controllers\Landing\SearchController::class, 'show'])->name('search.show');

    Route::get('/courses', [App\Http\Controllers\Landing\CourseController::class, 'index'])->name('courses');
    Route::get('/courses/subject/{subject?}', [App\Http\Controllers\Landing\CourseController::class, 'index'])->name('courses.by-subject');
    
    // Categories routes
    Route::get('/categories', [App\Http\Controllers\Landing\CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category}/courses', [App\Http\Controllers\Landing\CategoryController::class, 'courses'])->name('categories.courses');

    Route::middleware('auth')->group(function () {
        Route::get('/lessons/{lesson}', [App\Http\Controllers\Landing\LessonController::class, 'show'])->name('lessons.show');

        Route::get('/courses/{course}', [App\Http\Controllers\Landing\CourseController::class, 'show'])->name('courses.show');
        Route::get('/courses/{course}/enroll', [App\Http\Controllers\Landing\CourseController::class, 'enroll'])->name('courses.enroll');

        Route::get('/quizzes/{quiz}', [App\Http\Controllers\Landing\QuizController::class, 'show'])->name('quizzes.show');
    });

    Route::post('/pages/contact/send-email', [App\Http\Controllers\Landing\PageController::class, 'sendEmail'])->name('contact.send-email');

    // Instructors routes
    Route::get('/pages/instructors', [App\Http\Controllers\Landing\InstructorController::class, 'index'])->name('instructors.index');
    Route::get('/pages/instructors/{type}', [App\Http\Controllers\Landing\InstructorController::class, 'byType'])->name('instructors.by-type');
    Route::get('/pages/instructor/{slug}', [App\Http\Controllers\Landing\InstructorController::class, 'show'])->name('instructors.show');

    // Podcasts routes
    Route::get('/podcasts', [App\Http\Controllers\Landing\PodcastController::class, 'index'])->name('podcasts.index');
    Route::get('/podcasts/{podcast}', [App\Http\Controllers\Landing\PodcastController::class, 'show'])->name('podcasts.show');

    // Posts routes
    Route::get('/posts/{post}', [App\Http\Controllers\Landing\PostController::class, 'show'])->name('posts.show');

    // Library routes
    Route::get('/library', [App\Http\Controllers\Landing\LibraryController::class, 'index'])->name('library.index');
    Route::get('/library/category/{category}', [App\Http\Controllers\Landing\LibraryController::class, 'byCategory'])->name('library.by-category');
    Route::get('/library/book/{book}', [App\Http\Controllers\Landing\LibraryController::class, 'show'])->name('library.book.show');

    Route::get('/pages/{page}', [App\Http\Controllers\Landing\PageController::class, 'show'])->name('pages.show');


    Route::post('/favorite-courses/{course}', [App\Http\Controllers\Landing\FavoriteController::class, 'update'])->name('favorite-courses.update');
});
