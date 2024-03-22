<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function comments(){

        $comments = Comment::all();
        
        return view('admin.comments.index', compact('comments'));
    }

    public function deleteComment($id)
    {
        try {
            $comment = Comment::findOrFail($id); // Find the comment by its ID
            $comment->delete(); // Delete the comment
            return redirect()->back()->with('success', 'Comment deleted successfully.');
        } 
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete comment: ' . $e->getMessage());
        }
    }

    
}
