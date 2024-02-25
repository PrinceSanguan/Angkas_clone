<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\LoginNeedsVerification;

class LoginController extends Controller
{
    public function submit(Request $request)
    {
        // validate the phone number
        $request->validate([
            'phone' => 'required|numeric|min:11'
        ]);

        //find or create a user model

        $user = User::firstOrCreate([
            'phone' => $request->phone
        ]);

        if(!$user) {
            return response()->json(['message' => 'Could not process a user with that phone number.'], 401);
        }

        //send the user a one time use code
        $user->notify(new LoginNeedsVerification());

        //return back a response
        return response()->json(['message' => 'Text message notification sent.']);
    }

    public function verify(Request $request) 
    {
        // validate incoming request
        $request->validate([
            'phone' => 'required|numeric|min:10',
            'login_code' => 'required|numeric|between:111111,999999'
        ]);

        // find the user
        $user = User::where('phone', $request->phone)
                ->where('login_code', $request->login_code)
                ->first();

        // is the code provided the same one saved?

        //if so, return back an auth token

        

        // if not, return back a message
    }
}
