<?php

namespace App\Dao\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Models\User;

class UserDao implements UserDaoInterface
{ 

  //user list action
  public function getUserList()
  {
    $users = User::all();
    return $users;
  }

}
