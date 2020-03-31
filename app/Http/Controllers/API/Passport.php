<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Notifications\SignupActivate;
use Illuminate\Support\Facades\Storage;

use Avatar;
class Passport extends ApiHome
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);
        $credentials['active'] = 1;
        $credentials['deleted_at'] = null;
        if(!auth()->attempt($credentials))
            return $this->sendError('Unauthorized',400);
        $user = $request->user();
        $success['token'] =  $user->createToken('Personal Access Token')-> accessToken;
        $success['name'] =  $user->name;
        return $this->sendResponse($success,'Success Login Operation');

    }//end of login

    public function signup(Request $request){
        $v = validator($request->only('email', 'name', 'password'), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($v->fails())
            return $this->sendError('Validation Error.!',$v->errors()->all(),400);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'activation_token' => Str::random(60)
        ]);
        $avatar = Avatar::create($user->name)->getImageObject()->encode('png');
        Storage::put('avatars/'.$user->id.'/avatar.png', (string) $avatar);
        $user->notify(new SignupActivate($user));
        $success['token'] = $user->createToken('FindMe')->accessToken;
        $success['name'] =  $user->name;
        return $this->sendResponse($success,'Successfully created user!');
    }//end of register

    public function details()
    {
        return  $this->sendResponse(['user' => auth()->user()],'Success To Retrieve the current Auth User Data');
    }//end of details
    public function update(Request $request)
    {
        $v = validator($request->only('email', 'name', 'password'), [
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users',
            'password' => 'string|min:6',
        ]);

        if ($v->fails())
            return $this->sendError('Validation Error.!',$v->errors()->all(),400);
        if(!auth()->user())
            return $this->sendError('Unauthorized',400);
        $requestArray = $request->all();
        if(isset($requestArray['password']) && $requestArray['password'] != ""){
            $requestArray['password'] =  Hash::make($requestArray['password']);
        }else{
            unset($requestArray['password']);
        }

        $user=auth()->user()->update($requestArray);
        $success['name'] =  auth()->user()->name;
        $success['email'] =  auth()->user()->email;
        return $this->sendResponse($success,'Successfully created user!');


    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        $request->user()->token()->delete();
        return $this->sendResponse(null,'Successfully Loged OUT user!');
    }//end of logout

    public function SignupActivate($token)
    {
        $user = User::where('activation_token', $token)->first();
        if (!$user)
            return $this->sendError('This activation token is invalid.!',404);

        $user->active = true;
        $user->activation_token = '';
        $user->save();
        return $user;
    }//end of signupActivate

}//enf of controller
