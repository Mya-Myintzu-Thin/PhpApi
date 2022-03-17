<?php

namespace App\Contracts\Services\Post;

interface PostServiceInterface
{
    public function PostCreate($request);

    public function getPostList();

    public function getPostById($id);

    public function updatedPostById($request, $id);

    public function deletePostById($postId);

    public function uploadPostCSV($validated, $uploadedUserId);
}
