<?php

namespace App\Contracts\Services\User;

interface UserServiceInterface
{
  public function getUserList();

  public function changeUserPasswordAPI($validated);

}
