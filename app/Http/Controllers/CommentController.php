<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('user')->get();
        return view('comment', compact('comments'));
    }

    public function editView(Comment $comment)
    {
        $this->authorize('update', $comment);

        return response()->json(['comment' => $comment]);
    }

    public function create()
    {
        return view('comments.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $comment = new Comment();
        $comment->comment = $request->comment;

        if (auth()->check()) {
            $comment->user_id = auth()->id();
        }

        $comment->save();

        return redirect()->route('comment');
    }

    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment);
        return redirect()->route('comment');
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate([
            'comment' => 'required',
        ]);

        $comment->update(['comment' => $request->input('comment')]);

        return redirect()->route('comment');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('comment');
    }
}
