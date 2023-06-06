<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Trait\Response;
use Illuminate\Http\Request;
use App\Http\Requests\Register;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AuthController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, Response;

    public function signup(Register $request){
        $user = User::create($request->validated());
        
        return $this->success('register successfully', 200, $user); 
    } 

    public function signin(Request $request){
        $user = new User;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            // $token = $user->createToken($user)->plainTextToken;
            return $this->success('', 200, 'login successfully');
        }
        return $this->error('UnAuthorised User', 401, '');
    }

    public function logout(){
        dd(Auth::logout());
        if(Auth::logout()){
            return $this->success('user logout successfully', 200, ''); 
        } 
        return $this->error('user not logout', 200, ''); 
    }
}
