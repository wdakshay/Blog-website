<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Blog;
use Auth;
use DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function categories(){
        $categories = Category::select('*')->with('user')->orderBy('id','desc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function addCategory(){
        return view('admin.categories.add');
    }

    public function storeCategory(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'category_name' => 'required|max:255',
                'status' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $param = $request->only(['category_name', 'status']);
            $param['user_id'] = Auth::user()->id;

            // Update category
            if ($request->id) {
                $category = Category::findOrFail($request->id);
                $category->update($param);
                $msg = "Category has been updated successfully";
            } else {
                $category = Category::create($param);
                $msg = "Category has been created successfully";
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }

        return redirect()->route('admin-categories')->withStatus($msg);
    }

    public function editCategory($id){

        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
    }

}
