<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
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
            'email' => 'bail|email|required',
            'candidate' => 'bail|required'
        ]);

        // If validator fails, send a res with the errors 
        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'state' => 'problem',
                'errors' => $validator->messages()
            ]);  

        // Check implemented to see if a user with the email or IP already exists in the db
        }elseif(User::where('email', $request->email)->first() || (User::where('ip', $request->ip())->first()) || User::where('mac', $request->mac)->first()){
            return response()->json([
                'state' => 'alreadyVoted',
                'error' => 'You can only vote once!',
            ]);

        }
        else{
            $candidate = Candidate::where('name', $request->candidate)->first();
            if($candidate){
                $candidate->vote_count++;
                // Create user and record vote and also return a response
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->ip = $request->ip();
                $user->vote = $request->candidate;
                $user->mac = exec('getmac');
                
                $candidate->save();
                $user->save();
        
                return response()->json([
                    'status' => 200,
                    'success' => 'Hurray! You have voted successfully!'
                ]);
            }

            return response()->json([
                'state' => 'noCandidate',
                'errors' => 'Candidate does not exist!'
            ]);
        }

    }

    public function getVotesList () {
        return response()->json([
            'users' => Candidate::all()
        ]);

    }

    public function getCandidates () {
        return response()->json([
            'candidates' => Candidate::all()
        ]);

    }

    


}
