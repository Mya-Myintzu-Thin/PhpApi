<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostService implements PostServiceInterface
{
  private $postDao;

  /**
   * Class Constructor
   * @param OperatorUserDaoInterface
   * @return
   */
  public function __construct(PostDaoInterface $postDao)
  {
    $this->postDao = $postDao;
  }

  public function PostCreate($request)
  {
    return $this->postDao->PostCreate($request);

  }

  public function getPostList()
  {
    return $this->postDao->getPostList();
  }

    public function getPostById($id)
    {
      return $this->postDao->getPostById($id);
    }

    public function updatedPostById($request, $postId)
    {
      return $this->postDao->updatedPostById($request, $postId);
    }

    public function deletePostById($id)
    {
      return $this->postDao->deletePostById($id);
    }

    public function uploadPostCSV($validated, $uploadedUserId)
    {
      $fileName = $validated['csv_file']->getClientOriginalName();
      Storage::putFileAs(config('path.csv') . $uploadedUserId .
        config('path.separator'), $validated['csv_file'], $fileName);
      return $this->postDao->uploadPostCSV($validated, $uploadedUserId);
    }

}
