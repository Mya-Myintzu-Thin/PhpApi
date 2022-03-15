<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;


class NewPasswordController extends Controller
{
    public function forgotPassword(Request $request)
    { 
        
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if($status == Password::RESET_LINK_SENT){
            return response()->json([$status]);
        }
        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
    public function resetPassword(Request $request)
    {
            $request ->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password'=> 'required',
            'confirm_password' => 'required',
        
        ]);
        
        $status = Password::reset(
            $request->only('email','password','password_confirmation','token'),
            function ($user) use ($request){
                $user ->forcefill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );
        if($status == Password::PASSWORD_RESET){
            return response([
                'message'=> 'Success'
            ]);
        }
        return response()->json([$status],500);

}
     

    public function change_password(Request $request)
{
 
    $input = $request->all();
    $userid =Auth()->id;
    $rules = array(
        'old_password' => 'required',
        'new_password' => 'required|min:6',
        'confirm_password' => 'required|same:new_password',
    );
    $validator = Validator::make($input, $rules);
    if ($validator->fails()) {
        
        $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
    } 
    User::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);
    return [
        "result"=>"Success"
    ];
}
}
