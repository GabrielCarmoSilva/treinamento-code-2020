<?php

namespace App\Http\Controllers;

use App\Course;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.index', compact('courses')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = new Course();
        $categories = Category::all();
        return view('admin.courses.create', compact('course', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
        $data = $request->all();
        if($request->hasfile('image_link')) {
            $extension = $request->image_link->getClientOriginalExtension();
            $slug = $request->slug;
            $file_name = "{$slug}.{$extension}";
            $request->image_link->storeAs('public/img', $file_name);
            $data['image_link'] = 'img/'.$file_name;
        }
        else {
            $data['image_link'] = "img/imagem.jpg";
        }
        Course::create($data);
        return redirect()->route('courses.index')->with('success', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $categories = Category::all();
        if(Str::contains($course->video, 'watch?v=')) {
            $video_url = explode('watch?v=', $course->video);
            $video_id = explode('&', $video_url[1]);
            $video_link = 'https://www.youtube.com/embed/' . $video_id[0];
        } else if (Str::contains($course->video, 'embed')) {
            $video_link = $course->video;
        } else {
            $video_url = explode('/', $course->video);
            $video_link = 'https://www.youtube.com/embed/' . $video_url[3];
        }    
        return view('admin.courses.show', compact('course', 'categories', 'video_link'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $categories = Category::all();
        return view('admin.courses.edit', compact('course', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $data = $request->all();
        $image = $course->image_link;
        if($request->hasfile('image_link')) {
            $extension = $request->image_link->getClientOriginalExtension();
            $slug = $request->slug;
            $file_name = "{$slug}.{$extension}";
            $request->image_link->storeAs('public/img', $file_name);
            $data['image_link'] = 'img/'.$file_name;
        }
        $course->update($data);
        if (Course::where('image_link', '=', $image)->count() == 0) {
            Storage::disk('public')->delete($image);
        }
        return redirect()->route('courses.index')->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $image = $course->image_link;
        $course->delete();
        if (Course::where('image_link', '=', $image)->count() == 0) {
            Storage::disk('public')->delete($image);
        }
        return redirect()->route('courses.index')->with('success', true);
    }

    public function register(Request $request, Course $course) {
        $user = User::findOrFail($request->user);
        $user->courses()->syncWithoutDetaching($course);
        if (!($request->register)) {
            $user->courses()->detach($course);
        }
        return redirect()->route('courses.index')->with('success',true);
    }

    public function userCourses() {
        $courses = auth()->user()->courses;
        return view('admin.courses.user_courses', compact('courses'));
    }
}
