<?php

namespace App\Contracts\Dao\User;

interface UserDaoInterface
{
  public function getUserList();

  public function changeUserPasswordAPI($validated);
}
