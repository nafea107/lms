<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');

    // categories
    Route::get('/categories', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/data', [App\Http\Controllers\Admin\CategoryController::class, 'data'])->name('categories.data');
    Route::post('/categories/store', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}/update', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}/destroy', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('categories.destroy');

    // subjects
    Route::get('/subjects', [App\Http\Controllers\Admin\SubjectController::class, 'index'])->name('subjects.index');
    Route::get('/subjects/data', [App\Http\Controllers\Admin\SubjectController::class, 'data'])->name('subjects.data');
    Route::post('/subjects/store', [App\Http\Controllers\Admin\SubjectController::class, 'store'])->name('subjects.store');
    Route::post('/subjects/{subject}/update', [App\Http\Controllers\Admin\SubjectController::class, 'update'])->name('subjects.update');
    Route::delete('/subjects/{subject}/destroy', [App\Http\Controllers\Admin\SubjectController::class, 'destroy'])->name('subjects.destroy');

    // instructors
    Route::get('/instructors', [App\Http\Controllers\Admin\InstructorController::class, 'index'])->name('instructors.index');
    Route::get('/instructors/data', [App\Http\Controllers\Admin\InstructorController::class, 'data'])->name('instructors.data');
    Route::post('/instructors/store', [App\Http\Controllers\Admin\InstructorController::class, 'store'])->name('instructors.store');
    Route::put('/instructors/{instructor}/update', [App\Http\Controllers\Admin\InstructorController::class, 'update'])->name('instructors.update');
    Route::delete('/instructors/{instructor}/destroy', [App\Http\Controllers\Admin\InstructorController::class, 'destroy'])->name('instructors.destroy');

    // levels
    Route::get('/levels', [App\Http\Controllers\Admin\LevelController::class, 'index'])->name('levels.index');
    Route::get('/levels/data', [App\Http\Controllers\Admin\LevelController::class, 'data'])->name('levels.data');
    Route::post('/levels/store', [App\Http\Controllers\Admin\LevelController::class, 'store'])->name('levels.store');
    Route::put('/levels/{level}/update', [App\Http\Controllers\Admin\LevelController::class, 'update'])->name('levels.update');
    Route::delete('/levels/{level}/destroy', [App\Http\Controllers\Admin\LevelController::class, 'destroy'])->name('levels.destroy');


    // courses
    Route::get('/courses/data', [App\Http\Controllers\Admin\CourseController::class, 'data'])->name('courses.data');
    Route::resource('/courses', App\Http\Controllers\Admin\CourseController::class);

    // lessons
    Route::get('/lessons/data', [App\Http\Controllers\Admin\LessonController::class, 'data'])->name('lessons.data');
    Route::resource('/lessons', App\Http\Controllers\Admin\LessonController::class);

    // pages
    Route::get('/pages/data', [App\Http\Controllers\Admin\PageController::class, 'data'])->name('pages.data');
    Route::resource('/pages', App\Http\Controllers\Admin\PageController::class);

    //settings
    Route::get('/settings/edit', [App\Http\Controllers\Admin\SettingController::class, 'edit'])->name('settings.edit');
    Route::post('/settings/update', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

    Route::get('/profile/edit', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');


    //settings
    Route::get('/enroll-course', [App\Http\Controllers\Admin\EnrollCourseController::class, 'index'])->name('enroll-course.index');
    Route::post('/enroll-course', [App\Http\Controllers\Admin\EnrollCourseController::class, 'store'])->name('enroll-course.store');

    // podcasts
    Route::get('/podcasts/data', [App\Http\Controllers\Admin\PodcastController::class, 'data'])->name('podcasts.data');
    Route::resource('/podcasts', App\Http\Controllers\Admin\PodcastController::class);
});
