<?php

namespace App\Dao\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Models\Post;

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

    $post = Post::find($postId)->first();
    $post->title = $request['title'];
    $post->comment = $request['comment'];
    $post->status = $request['status'];
    $post->save();
    return $post;
  }

  public function deletePostById($postId)
  {
    $post = Post::find($postId);
    if ($post) {
      $post->save();
      $post->delete();
    }
    return $post;
  }

  public function uploadPostCSV($validated, $uploadedUserId)
  {

    $path =  $validated['csv_file']->getRealPath();
    $csv_data = array_map('str_getcsv', file($path));
    // save post to Database accoding to csv row
    foreach ($csv_data as $index => $row) {
      if (count($row) >= 2) {
        try {
          $post = new Post([
            'title' => $row[0],
            'comment' => $row[1],
            'created_user_id' => $uploadedUserId ?? 1,
            'updated_user_id' => $uploadedUserId ?? 1,
          ]);
          $post->save();
        } catch (\Illuminate\Database\QueryException $e) {
          $errorCode = $e->errorInfo[1];
          //error handling for duplicated post
          if ($errorCode == '1062') {
            $content = array(
              'isUploaded' => false,
              'message' => 'Row number (' . ($index + 1) . ') is duplicated title.'
            );
            dd($content);
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
      'message' => 'Your CSV File is Uploaded Successfully!'
    );
    return $content;
  }
}
