<?php

namespace App\Dao\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserDao implements UserDaoInterface
{ 

  //user list action
  public function getUserList()
  {
    $users = User::all();    
    return $users;
  }

  public function changeUserPasswordAPI($validated)
  {
    $user = User::find(Auth::guard('api')->user()->id)
      ->update([
        'password' => Hash::make($validated['new_password']),
        'updated_user_id' => Auth::guard('api')->user()->id
      ]);
    return $user;
  }

}
