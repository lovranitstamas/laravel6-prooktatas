<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request, /*$postId*/ $type, $id){
        $this->validate($request , [
           'content' => 'required | max: 2000'
        ]);

        $model = $type::findOrFail($id);

        $comment = new Comment;
        $comment->customer()->associate(authCustomer());
        $comment->content = $request->input('content');
        //$comment->note()->associate($postId);
        $comment->commentable()->associate($model);

        $comment->save();

        session()->flash('message', 'Komment elmentve');

        //return redirect()->route('posts.show', $id);
        return redirect()->back();
    }

}
