<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Post::class;
    }

    public function createPost($request)
    {
        $isSuperAdmin = auth()->user()->roles->contains('name', 'SuperAdmin');
        if(!$isSuperAdmin) {
            return ['data' => [], 'message' => "You do not have enough privilidge to perform this action", 'status' => false];
        }
        Post::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return ['data' => [], 'message' => "Post created successfuly", 'status' => true];
    }

    public function getOnePost($id){
        $post = Post::where('id', $id)->first();
        if(empty($post)) 
        {
           return ['data' => [], 'message' => "Post not found", 'status' => false];
        }
        return ['data' => $post, 'message' => "Post retrived successfuly", 'status' => true];
    }

    public function getAllPost() {
        $post = Post::orderBy('created_at', 'desc')->get();
        return ['data' => $post, 'message' => "Posts retrived successfuly", 'status' => true];
    }

    public function updatePost($request, $id) {
        $isSuperAdmin = auth()->user()->roles->contains('name', 'SuperAdmin');
        if(!$isSuperAdmin) {
            return ['data' => [], 'message' => "You do not have enough privilidge to perform this action", 'status' => false];
        }
        $post = Post::where('id', $id)->first();
        if(empty($post)) 
        {
            return ['data' => [], 'message' => "Post not found", 'status' => false];
        }
        Post::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return ['data' => [], 'message' => "Post updated successfuly", 'status' => true];
    }

    public function destroyPost($id) {
        $isSuperAdmin = auth()->user()->roles->contains('name', 'SuperAdmin');
        if(!$isSuperAdmin) {
            return ['data' => [], 'message' => "You do not have enough privilidge to perform this action", 'status' => false];
        }
        $post = Post::where('id', $id)->first();
        if(empty($post)) 
        {
            return ['data' => [], 'message' => "Post not found", 'status' => false];
        }
        Post::where('id', $id)->delete();
        return ['data' => [], 'message' => "Post deleted successfuly", 'status' => true];
    }

}
