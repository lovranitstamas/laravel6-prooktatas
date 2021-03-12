<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request, $postId){
        $this->validate($request , [
           'content' => 'required | max: 2000'
        ]);

        $comment = new Comment;
        $comment->customer()->associate(authCustomer());
        $comment->content = $request->input('content');
        $comment->note()->associate($postId);

        $comment->save();

        session()->flash('message', 'Komment elmentve');

        return redirect()->route('posts.show', $postId);
    }

}
