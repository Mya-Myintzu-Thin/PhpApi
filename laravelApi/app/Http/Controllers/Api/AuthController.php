<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\Auth\AuthServiceInterface;
use App\Http\Controllers\Controller;
use Exception;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

/**
 * This is Authentication Controller for API.
 * This handles the login, logout processing of user.
 */
class AuthController extends Controller
{
  /**
   * Auth Interface
   */
  private $authInterface;

  /**
   * Create a new controller instance.
   * @param AuthServiceInterface $authServiceInterface
   * @return void
   */
  public function __construct(AuthServiceInterface $authServiceInterface)
  {
    $this->authInterface = $authServiceInterface;
  }

  /**
   * This is to login for user.
   * @param LoginAPIRequest $request Request from user
   * @return Response json response
   */
  public function login (Request $request)
  {
    $rules = array(
        'email' => 'required|email',
        'password' => 'required',
    );
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return Response()->json([ 'message' => 'Invalid username or password', 'errors' => $validator->getMessageBag()->toArray()],422);
    }
    $email = $request->email;
    $password = $request->password;
    if (Auth::attempt(array('email' => $email, 'password' => $password, ))) {
            $userDetails = array(
                'post_id' => Auth::id(),
                'email' => Auth::User()->email,
            );
        return Response()->json($userDetails);
    }else{
        return Response()->json([ 'message' => 'I can not authenticate.'],401);
    }
  }

  /**
   * This is to log out for user.
   * @return Response json response
   */
  public function logout()
  {
    Auth::guard('api')->user();
    return response()->json(
      ['message' => 'Success.'],
      JsonResponse::HTTP_OK
    );
  }
}
