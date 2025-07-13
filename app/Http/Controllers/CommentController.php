<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function userComments()
    {
        $comments = auth()->user()->comments()->with('post')->latest()->paginate(10);
        return view('comments.user-comments', compact('comments'));
    }   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , Post $post)
    {
        $data = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $post->comments()->create([
            'user_id' => Auth::user()->id,
            'content' => $data['content'],
        ]);
        return redirect()->back()->with('success', 'Comment added successfully.');

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comments)
    {
        

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comments)
    {
        $this->authorize('update', $comments);

        $data = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comments->update([
            'content' => $data['content'],
        ]);

        return redirect()->back()->with('success', 'Comment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comments)
    {
        $this->authorize('delete', $comments);

        $comments->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}
