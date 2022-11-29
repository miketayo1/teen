<?php

namespace App\Http\Controllers;
use App\Mail\WelcomMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    public function postCommnity(Request $req)
    {   
        
        $community = new Community();
        $community->name = $req->input('name');
        $community->email =$req->input('email');
        $community->phone = $req->input('phone');
        $community->age =   $req->input('age');
        $community->hobbies = $req->input('hobbies');

        $check = Community::where('email', $community->email)->first();
        if($check){
            return response()->json([
                'error' => 'Your email has already been registered' ]);
        }   
        Mail::to($community->email)->send(new WelcomMail());
	 
        $community->save();
        // return new WelcomMail();
        return response()->json([
            'success' => 'Your email has been registered' ]);
        
    }

}
