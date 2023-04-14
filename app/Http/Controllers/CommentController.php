<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $query = Comment::query();

        if ($request->has('query')) {
            $query->where('username', 'like', '%' . $request->input('query') . '%')
                ->orWhere('comment', 'like', '%' . $request->input('query') . '%');
        }

        $comments = $query->latest()->paginate(10);

        return response()->json($comments, 200);
    }
}
