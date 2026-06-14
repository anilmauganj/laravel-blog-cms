<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        Comment::create([
            'post_id' => $request->post_id,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Comment submitted successfully. It will appear after approval.');
    }
}
