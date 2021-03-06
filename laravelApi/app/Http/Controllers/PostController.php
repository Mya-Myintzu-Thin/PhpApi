<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Contracts\Services\Post\PostServiceInterface;
use App\Http\Requests\PostUploadRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
  private $postInterface;

  public function __construct(PostServiceInterface $postInterface)
  {
    $this->postInterface = $postInterface;
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  public function getPostList()
  {
    $postList = $this->postInterface->getPostList();
    return response()->json($postList);
  }


  public function getPostById($postId)
  {

    $post = $this->postInterface->getPostById($postId);
    return response()->json($post);
  }


  public function store(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'title' => 'bail|required|unique:posts|max:255',
      'comment' => 'required',
    ]);

    if ($validator->fails()) {


      return [
        'message' => 'The given data was invalid.',
        'errors' => $validator->errors()
      ];
    }
    $post = $this->postInterface->PostCreate($request);

    return $post;
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  public function updatePostById(Request $request, Post $postId)
  {
    $validator = Validator::make($request->all(), [
      'title' => 'bail|required|unique:posts|max:255',
      'comment' => 'required',
    ]);

    if ($validator->fails()) {
      return [
        'message' => 'The given data was invalid.',
        'errors' => $validator->errors()
      ];
    }
    $post = $this->postInterface->updatedPostById($request, $postId);

    return $post;
  }


  public function deletePostById($postId)
  {
    $post = $this->postInterface->deletePostById($postId);
    if (!$post) {
      return [
        'message' => 'The given data was invalid.'
      ];
    }
    return [
      'deleted_post_id' => $postId,
      'delete_at' => now()
    ];
  }

  public function uploadPostCSVFile(PostUploadRequest $request)
  {
    $validated = $request->validated();
    $uploadedUserId = Auth::id();
    $content = $this->postInterface->uploadPostCSV($validated, $uploadedUserId);

    if (!$content['isUploaded']) {
      return response()->json(['error' => $content['message']], JsonResponse::HTTP_BAD_REQUEST);
    } else {
      return response()->json(['message' => $content['message']]);
    }
  }
}
