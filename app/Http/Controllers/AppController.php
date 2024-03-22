<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use DB;

class AppController extends Controller
{

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

    public function aboutUs(){

        return view('about-us');
    }

    public function contactUs(){
        return view('contact-us');

    }

    public function blogs(){

        return view('blogs');
    }

    public function blog($slug){

        $blog = Blog::where(['status' => 'active', 'url_slug' => $slug])->first();
        
        if(!$blog){
            #Redirect to 404 page
        }

        $category_ids = explode(',', $blog->category_id);

        // #Get all blog Categories
         $blogcategoryNames = Category::whereIn('id', $category_ids)
        ->orderBy('category_name')
        ->get();

        // #Get all Categories
        $categoryNames = Category::where('status', 'active')
        ->orderBy('created_at', 'desc')
        ->take(6)
        ->get();

        #Get all comments
        $comments = DB::table('blog_comments')
        ->where(['id'=>$blog->id, 'status'=>'active'])
        ->get();

        #Retrieve blogs with the same category
        $relatedBlogs = Blog::where('status', 'active')
        ->where(function ($query) use ($category_ids) {
            foreach ($category_ids as $categoryId) {
                $query->orWhere('category_id', 'like', '%' . $categoryId . '%');
            }
        })
        ->where('id', '!=', $blog->id) // Exclude the current blog
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get();

        if ($relatedBlogs->isEmpty()) {
            $noRelatedPostMessage = "No related posts found.";
        } else {
            $noRelatedPostMessage = ""; // No need for a message if related posts are found
        }

       return view('blog', compact('blog','categoryNames','comments','blogcategoryNames','relatedBlogs', 'noRelatedPostMessage'));
    }

    public function category($slug){

        #Get the Category Id by Url Slug
        $category = Category::select('*')
        ->where(['status'=>'active', 'url_slug'=> $slug])
        ->first();

        if(!$category){
            #redirect to 404 page

        }
        $cid = $category->id;
        $categoryBlogs = Blog::whereHas('category', function ($query) use ($cid){
            $query->where('category_id', $cid);
        })
        ->where('status','active')
        ->orderBy('id','desc')
        ->paginate(4);

         if ($categoryBlogs->isEmpty()) {
            $noCategoryBlogsMessage = "No Post Found.";
        } else {
            $noCategoryBlogsMessage = ""; // No need for a message if related posts are found
        }

       return view('category', compact('categoryBlogs','category','noCategoryBlogsMessage'));
    }
    
    public function submitComment(Request $request){
        if(Auth::check()){
            if (Auth::check()) {}
        $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'blog_id' => 'required',
                'email' => 'required|email',
                'message' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $param = [
                'full_name' => $request->name,
                'blog_id' => $request->blog_id, // Store as comma-separated string
                'comment' => $request->message,
            ];

            $comment = Comment::create($param);

             return redirect()
                    ->back();
        }else {
            return redirect()->route('login')->with('error', 'Please login to comment.');
        }
    }


    public function searchBlog(Request $request)
    {
        // Get the search query from the request
        $searchQuery = $request->input('search');

        // Perform the search query
        $blogs = Blog::where('status', 'active')
             ->where('blog_title', 'like', "%{$searchQuery}%")
             ->paginate(4);
                    

        // Check if any blogs were found
        if ($blogs->isEmpty()) {
            // If no blogs were found, return a message indicating so
            return view('no-blog-found');
        } else {
            // If blogs were found, return the view with the search results
            return view('search-results', compact('blogs', 'searchQuery'));
        }
    }

   
}
