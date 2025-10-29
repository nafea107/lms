<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\FavoriteCourse;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    //
    public function update($locale, Course $course, Request $request)
    {

        $course = $course->isFav()->whereId($course->id)->first();
        if ($request->is_fav && !$course->is_fav) {

            FavoriteCourse::create([
                'user_id' => auth()->id(),
                'course_id' => $course->id
            ]);
        } else {
            FavoriteCourse::where('user_id', auth()->id())->where('course_id', $course->id)->delete();
        }
        return response(['status' => 'success'], 201);
    }
}
