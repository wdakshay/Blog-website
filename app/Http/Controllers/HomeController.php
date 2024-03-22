<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function index()
    {
        // Retrieve all blogs with their category names
        $blogs = Blog::where('status', 'active')->orderBy('id', 'desc')->paginate(4);

        // Iterate through each blog to get category names
        foreach ($blogs as $blog) {
            // Convert category_id string to an array
            $categoryIds = explode(',', $blog->category_id);

            // Retrieve category names using the category IDs
            $categories = Category::whereIn('id', $categoryIds)->pluck('category_name')->toArray();

            // Assign category names to the blog model
            $blog->category_names = implode(', ', $categories);
        }

        // Pass the blogs data to the view
        return view('index', compact('blogs'));
    }
}
