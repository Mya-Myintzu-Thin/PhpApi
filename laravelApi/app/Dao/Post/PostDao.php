<?php

namespace App\Dao\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostDao implements PostDaoInterface
{ 
/**
   * create post function
   *
   * @return $post object
   */

  public function PostCreate($request)
  {
    $post = new Post([
      'title' => $request->get('title'),
      'comment' => $request->get('comment'),
    //   'created_user_id' => Auth::user()->id,
    //   'updated_user_id' => Auth::user()->id
    ]);
    $post->save();

    return $post;
  }

  //post list action
  public function getPostList()
  {
    $users = Post::all();    
    return $users;
  }

  //post list by id
  public function getPostById($id)
  {
    $post = Post::find($id);
    return $post;
  }

  public function updatedPostById($request, $postId)
  {
    // $post = Post::find($postId);
    // $post->title = $request['title'];
    // $post->comment = $request['comment'];
    // if ($request['status']) {
    //   $post->status = '1';
    // } else {
    //   $post->status = '0';
    // }
    // $post->updated_post_id = Auth::post()->id;
    // $post->save();
    // return $post;
    $request -> validate([
      'title'=>'required|max:190',
      'comment' => 'required|max:190',
    ]);
    dd("updatepost");

    $post = Post::find($postId);
    if($post)
    {
      $post -> title = $request->title;
      $post -> comment = $request->comment;
      $post->update();

      return response()->json(['message'=>'Post Updated Successfully'],200);
    }
    else
    {
      return response()->json(['message'=>'No Post Found'],404);

    }

   }  
    

  public function deletePostById($postId, $deletedUserId)
  {
    $post = Post::find($postId);
    if ($post) {
      $post-> $deletedUserId;
      $post->save();
      $post->delete();
      return 'Deleted Successfully!';
    }
    $post = Post::find($postId);
    return $post;
    return 'Post Not Found!';
  }

  public function uploadPostCSV($validated, $uploadedUserId)
  {
    $path =  $validated['csv_file']->getRealPath();
    $csv_data = array_map('str_getcsv', file($path));
    // save post to Database accoding to csv row
    foreach ($csv_data as $index => $row) {
      if (count($row) >= 2) {
        try {
          $post = new Post();
          $post->title = $row[0];
          $post->description = $row[1];
          $post->created_user_id = $uploadedUserId ?? 1;
          $post->updated_user_id = $uploadedUserId ?? 1;
          $post->save();
        } catch (\Illuminate\Database\QueryException $e) {
          $errorCode = $e->errorInfo[1];
          //error handling for duplicated post
          if ($errorCode == '1062') {
            $content = array(
              'isUploaded' => false,
              'message' => 'Row number (' . ($index + 1) . ') is duplicated title.'
            );
            return $content;
          }
        }
      } else {
        // error handling for invalid row.
        $content = array(
          'isUploaded' => false,
          'message' => 'Row number (' . ($index + 1) . ') is invalid format.'
        );
        return $content;
      }
    }
    $content = array(
      'isUploaded' => true,
      'message' => 'Uploaded Successfully!'
    );
    return $content;
  }
  


}