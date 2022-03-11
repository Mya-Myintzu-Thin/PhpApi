<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Contracts\Services\Post\PostServiceInterface;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostEditAPIRequest;
use App\Http\Requests\PostEditRequest;
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

    public function updatePostById(PostEditRequest $request, $postId)
    {
      // validation for request values
      $validated = $request->validated();
      $post = $this->postInterface->updatedPostById($validated, $postId);
      return response()->json($post);
    }

  
  public function deletePostById($postId)
  {
    $deletedPostId = Post::find($postId);
    $msg = $this->postInterface->deletePostById($postId, $deletedPostId);
    return response(['message' => $msg]);
  }

    public function uploadPostCSVFile(PostUploadRequest $request)
  {
    $validated = $request->validated();
    $uploadedUserId = Auth::guard('api')->user()->id;
    $content = $this->postInterface->uploadPostCSV($validated, $uploadedUserId);
    if (!$content['isUploaded']) {
      return response()->json(['error' => $content['message']], JsonResponse::HTTP_BAD_REQUEST);
    } else {
      return response()->json(['' => $content['message']]);
    }
  }
    }
