<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $query = Comment::query();

        if ($request->has('username')) {
            $query->where('username', 'like', '%' . $request->input('username') . '%');
        }

        if ($request->has('comment')) {
            $query->where('comment', 'like', '%' . $request->input('comment') . '%');
        }

        $comments = $query->latest()->paginate(10);

        return response()->json([
            'data' => $comments
        ], 200);
    }
}
