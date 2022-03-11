<?php

namespace App\Http\Controllers;

use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Requests\UserPasswordChangeRequest;

class UserController extends Controller
{
    private $userInterface;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserServiceInterface $userInterface)
    {
      $this->userInterface = $userInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = $this->userInterface->getUserList();
      return $users->map(function ($user) {
        return [
          'id' => $user->id,
          'name' => $user->name,
          'email' => $user->email,
          'type' => $user->type,
          'phone' => $user->phone,
          'date_of_birth' => $user->date_of_birth,
          'address' => $user->address,
          'created_at' => $user->created_at,
          'updated_at' => $user->updated_at,
        ];
      });
    }

    public function savePassword(UserPasswordChangeRequest $request)
  {
    // validation for request values
    $validated = $request->validated();
    $user = $this->userInterface->changeUserPasswordAPI($validated);
    return response()->json($user);
  }
}
