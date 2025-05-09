<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;


Route::resource('/', CourseController::class);
Route::post('/save-course', [CourseController::class, 'saveCourse'])->name('saveCourse');
// Route::delete('/courses/{course}', [CourseController::class, 'destroy']);
Route::delete('/delete-course/{id}/delete', [CourseController::class, 'deleteCourse'])->name('deleteCourse');



