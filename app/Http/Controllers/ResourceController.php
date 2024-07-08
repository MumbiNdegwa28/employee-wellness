<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Video;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function showResources()
    {
        $blogs = Blog::latest()->get();
        $videos = Video::latest()->get();

        return view('employee.resources', compact('blogs', 'videos'));
    }
    public function searchResources(Request $request)
    {
        $query = $request->input('query');
        $blogs = Blog::where('title', 'LIKE', "%{$query}%")->get();
        $videos = Video::where('title', 'LIKE', "%{$query}%")->get();

        return view('employee.resources', compact('blogs', 'videos'));
    }
}
