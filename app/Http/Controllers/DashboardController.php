<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $courses = Course::Count();
        return view('page.dashboard',[
            'courses' => $courses
        ]);
    }
}
