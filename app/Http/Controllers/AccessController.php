<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccessController extends Controller
{
    public function front () {
        return view('welcome');
    }

    public function getCountOfVotes () {
        // Since its impossible to submit votes when your IP or email has been logged in the db, the easiest way to get vote count is to get the number of users in the db
        $count = User::count();

        return response()->json([
            'count' => $count
            ]
        );
    }

    public function vote (Request $request) {
        // Validate incoming rquest fields
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required|alpha',
            'email' => 'bail|email|required'
        ]);

        // If validator fails, send a res with the errors 
        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'state' => 'problem',
                'errors' => $validator->messages()
            ]);  

        // Check implemented to see if a user with the email or IP already exists in the db
        }elseif(User::where('email', $request->email)->first() || (User::where('ip', $request->ip())->first())){
            return response()->json([
                'state' => 'wahala',
                'errors' => 'One IP Address or Email per vote',
            ]);

        }else{
            // Create user and record vote and also return a response
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->ip = $request->ip();
            $user->save();
    
            return response()->json([
                'status' => 200,
                'success' => 'Hurray! You have voted successfully!'
            ]);
        }

    }

    public function getVotesList () {
        return response()->json([
            'users' => User::all()
        ]);

    }


}