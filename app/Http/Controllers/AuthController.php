<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Social; //sử dụng model Social
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
// use Socialite; //sử dụng Socialite


class AuthController extends Controller

{
    // public function googleCallback()
    // {
    //     # code...
    // }
    public function googleLogin(Request $request)
    {
        $user = Socialite::driver('google')->userFromToken($request->access_token)->user;
        $data =  $this->_registerOrLoginUser($user);
        // Auth::login($data);
        $token = $data->createToken('authToken')->plainTextToken;
        return response()->json([
            'status' => true,
            'payload' => $data,
            'token' => $token
        ]);
    }

    protected function _registerOrLoginUser($data)
    {
        $user = User::where('email',  $data['email'])->first();
        if (!$user) {
            $user = new User();
            $user->name = $data['name'];
            $user->image = $data['picture'];
            $user->email = $data['email'];
            $user->google_id = $data['id'];
            $user->save();
        } else {
            $user->update([
                'google_id' =>  $data['id'],
                'image' => $data['picture'],
            ]);
        }
        return $user;
    }


    public function fake_login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'status' => true,
                'payload' => [
                    'token' => $token,
                    'user' => $user->toArray(),
                ],
            ]);
        }

        return response()->json([
            'status' => false,
            'payload' => "email không tồn tại",
        ]);
    }

    public function logout()
    {
        dd('ok');
        auth()->logout();
        return redirect()->route('login');
    }
}