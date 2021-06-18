<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    //registration function
    public function register(Request $request){
        $data= $request->validate([
            'name'=>'required|max:255',
            'email'=>'email|required|unique:users',
            'password'=>'required|confirmed'
        ]);

        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        $token = $user->createToken('API Token')->accessToken;

        return response([ 'user' => $user, 'token' => $token]);
    }


    //loggin function 
    public function login(Request $request){
    
        $data = $request->validate([
            'email'=>'email|required',
            'password'=>'required'
        ]);

        if(!auth()->attempt($data)){
            return ["message"=>"wrong credentials","status"=>301];
        }
        $token = auth()->user()->createToken('API Token')->accessToken;

        return ['user'=>Auth()->user(),'token'=>$token];
    }

    //logout functionality
    public function logout(Request $request){
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message'=>'you have been successfully logged out'];
        return response($response,200);
    }
}
