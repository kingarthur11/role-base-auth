<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\BaseRepository;

class CommentRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Comment::class;
    }

    public function createComment($request)
    {
        $user = auth()->user();
        Comment::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return ['data' => [], 'message' => "Comment created successfuly", 'status' => true];
    }

    public function getOneComment($id){
        $comment = Comment::where('id', $id)->first();
        if(empty($comment)) 
        {
           return ['data' => [], 'message' => "Comment not found", 'status' => false];
        }
        return ['data' => $comment, 'message' => "Comment retrived successfuly", 'status' => true];
    }

    public function getAllComment() {
        $comment = Comment::orderBy('created_at', 'desc')->get();
        return ['data' => $comment, 'message' => "Comments retrived successfuly", 'status' => true];
    }

    public function updateComment($request, $id) {
        $user = auth()->user();
        $comment = Comment::where('id', $id)->where('user_id', $user->id)->first();
        if(empty($comment)) 
        {
            return ['data' => [], 'message' => "Comment not found", 'status' => false];
        }
        Comment::where('id', $id)->where('user_id', $user->id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return ['data' => [], 'message' => "Comment updated successfuly", 'status' => true];
    }

    public function destroyComment($id) {
        $user = auth()->user();
        $comment = Comment::where('id', $id)->where('user_id', $user->id)->first();
        if(empty($comment)) 
        {
            return ['data' => [], 'message' => "Comment not found", 'status' => false];
        }
        Comment::where('id', $id)->delete();
        return ['data' => [], 'message' => "Comment deleted successfuly", 'status' => true];
    }
}
