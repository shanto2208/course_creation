<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;        
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return view('page.course.index',[
            'courses' => $courses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.course.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function saveCourse(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'course_title' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
    
        $course = Course::create([
            'title' => $request->course_title,
            'feature_video' => $request->feature_video
        ]);
    
        $modules = json_decode($request->input('modules'), true);
    
        $validationErrors = [];
        $errorNum = 1;
        $errorNum2 = 1;

        foreach ($modules as $index => $mod) {
            
            $validator = Validator::make($mod, [
                'title' => 'required|string',
            ]);
    
            if ($validator->fails()) {
                $validationErrors['modules.' . $errorNum . '.title'] = $validator->errors()->first('title');
                continue;
            }
    
            $module = $course->modules()->create([
                'title' => $mod['title']
            ]);
    
            $contentIndex = 0;

            foreach ($mod['content'] as $cnt) {

                $contentIndex++;

                $contentValidator = Validator::make($cnt, [

                    'title' => 'required|string',

                ]);
                if ($contentValidator->fails()) {

                    foreach ($contentValidator->errors()->messages() as $field => $messages) {
                        $validationErrors["$errorNum.content.title.$contentIndex.$field"] = $messages[0];

                    }
                    continue;
                }

                $contentValidator = Validator::make($cnt, [

                    'video_length' => 'required|string',

                ]);

                if ($contentValidator->fails()) {

                    foreach ($contentValidator->errors()->messages() as $field => $messages) {
                        $validationErrors["$errorNum.content.length.$contentIndex.length"] = $messages[0];

                    }
                    continue;
                }

                $contentValidator = Validator::make($cnt, [

                    'video_url' => 'url',

                ]);

                if ($contentValidator->fails()) {

                    foreach ($contentValidator->errors()->messages() as $field => $messages) {

                        $validationErrors["$errorNum.content.url.$contentIndex.url"] = $messages[0];

                    }
                    continue;
                }

                $module->contents()->create([
                    
                    'title' => $cnt['title'],
                    'video_url' => $cnt['video_url'],
                    'video_length' => $cnt['video_length'],
                    'source_type' => $cnt['source_type'] ?? null
                ]);

                
            }
            $errorNum++;
        }
    
        // Check if there were validation errors
        if (!empty($validationErrors)) {
            return response()->json([
                'success' => false,
                'errors' => $validationErrors
            ], 422);
        }
    
        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteCourse($id)
    {
        $course = Course::find($id);
        if ($course) {
            $course->delete();
        }
    
        return redirect()->back()->with('success', 'Course deleted successfully!');
    }
    
}
