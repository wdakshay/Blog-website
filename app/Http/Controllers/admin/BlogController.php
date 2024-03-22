<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Blog;
use Auth;
use DB;

class BlogController extends Controller
{

    public function blogs(){
        $blogs = Blog::select('*')->with('user')->orderBy('id','desc')->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function editBlog($id)
    {
        $blog = Blog::find($id);
        $categories = Category::all();

        $blog_categories = explode(',', $blog->category_id);
        // $blog_categories = $blog->categories->pluck('id')->toArray();
        return view('admin.blogs.edit', compact('blog', 'categories', 'blog_categories'));
    }


    public function addBlog(){

        #Get all active categories
        $data['categories']= Category::select('id','category_name')
        ->where('status','active')
        ->orderBy('category_name')->get();

        return view('admin.blogs.add', $data);

    }

    public function blog($id){

        #call the category Data
        $data['blog']= Blog::find($id);

        $category_ids = explode(',', $data['blog']->category_id);

        

        // #Get all blogs Categories
         $data['blog_categories'] = Category::whereIn('id', $category_ids)
        ->orderBy('category_name')
        ->get();

        #Get all Blogs Comments
        $data['comments'] = DB::table('blog_comments')
        ->where('blog_id', $id)
        ->get();

        return view('admin.blogs.blog', $data);

    }

   public function storeBlog(Request $request){

    try {
        $validator = Validator::make($request->all(), [
            'blog_title' => 'required',
            'category_id' => 'required|array',
            'descritption' => 'required',
            'status' => 'required',
            'display_on_home' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Convert category_id array to comma-separated string
        $categoryIds = implode(',', $request->category_id);

        $param = [
            'blog_title' => $request->blog_title,
            'category_id' => $categoryIds, // Store as comma-separated string
            'descritption' => $request->descritption,
            'status' => $request->status,
            'user_id' => Auth::user()->id,
            'display_on_home' => $request->display_on_home == 1 ? 1 : 0,
        ];

        // Generate the URL slug
        $param['url_slug'] = $this->generateUrlSlug($request->blog_title, 'blogs');

        // Handle the file upload
        if ($request->file('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $param['image'] = 'uploads/' . $fileName;
        }

        // Update or create blog
        if (isset($request->id)) {
            $blog = Blog::findOrFail($request->id);
            $blog->update($param);
            $msg = "Blog has been updated successfully";
        } else {
            $blog = Blog::create($param);
            $msg = "Blog has been created successfully";
        }

    } catch (Exception $e) {
        return redirect()->back()->withErrors($e->getMessage())->withInput();
    }
    return redirect()->route('admin-blogs')->withStatus($msg);
}


    public function generateUrlSlug($title, $table)
    {
        $slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-',$title),'-'));

        //if existing slug from the table
        $existing_url_slugs = DB::table($table)->pluck('url_slug')->implode(',');
        $existingSlugs = explode(",", $existing_url_slugs);

        //if a slug already exists append a suffix
        $originalSlug = $slug;
        $suffix = 2;

        while(in_array($slug, $existingSlugs)){
            $slug= $originalSlug.'-'.$suffix;
            $suffix++;
        }

        return $slug;


    }
}
