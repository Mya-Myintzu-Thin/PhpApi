<?php

namespace App\Contracts\Dao\Post;

use Illuminate\Http\Request;

interface PostDaoInterface
{
    public function PostCreate($request);

    public function getPostList();

    public function getPostById($id);

    public function updatedPostById(Request $request, $postId);

    public function deletePostById($postId);

    public function uploadPostCSV($validated, $uploadedUserId);





}
