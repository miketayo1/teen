<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Images;
use App\Models\Videos;
use App\Models\Contact;
use App\Models\User;
use App\Models\Logo;
use App\Models\Apimodel;
use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function getEvent(){

       
        $events= DB::table('event')
        ->join('video', 'event.id', '=', 'video.event_id')// joining the contacts table , where user_id and contact_user_id are same
        ->select('event.*', 'video.link1', 'video.link2','video.link3')
        ->distinct()
        ->get();

        return $events;
    }

    public function getNowShowing(){

        $events= DB::table('event')
        ->join('video', 'event.id', '=', 'video.event_id')// joining the contacts table , where user_id and contact_user_id are same
        ->select('event.*', 'video.link1', 'video.link2','video.link3')
        ->where('event.active', '1')
        ->distinct()
        ->get();

        return $events;
    }

    public function getEventImages(){
       
        $events = DB::table('event')
        ->join('images', 'event.id', '=', 'images.event_id')
        ->select('event.id','event.name' , 'images.path')
        ->distinct()
        ->get();

        return $events;
    }
    public function getEventImag(){
       
        $events = DB::table('event')
        ->join('images', 'event.id', '=', 'images.event_id')
        ->select('event.id','event.name' , 'images.path')
        ->where('event.active', '1')
        ->distinct()
        ->get()
        ->unique('id');
        return $events;
    }

    public function getEventImage($id){
        $events = DB::table('event')
        ->join('images', 'event.id', '=', 'images.event_id')
        ->select('event.id','event.name' , 'images.path')
        ->where('images.event_id', $id)
        ->distinct()
        ->get();

        return $events;
    }

    public function getContact()
    {
        $contact = Contact::first();

        return $contact;
    }

    public function getSliders()
    {
        $slider = DB::table('sliders')
        ->select('sliders.id','sliders.name' , 'sliders.path')
        ->where('sliders.active', '1')
        ->distinct()
        ->get();

        return $slider;
    }

    public function getLogo()
    {
        $slider = DB::table('logo')
        ->select('logo.path')
        ->distinct()
        ->get();

        return $slider;
    }

    public function getEventName($id){
        $events = DB::table('event')
        ->join('images', 'event.id', '=', 'images.event_id')
        ->select('event.id','event.name' , 'images.path')
        ->where('images.event_id', '!=', $id)
        ->distinct()
        ->get()
        ->unique('id');
        return $events;
        
    }

    public  function getToken(){
        $user=  Apimodel::where('email', Auth::User()->email )->first();
        
        return view('api.token')->with('user', $user);
    }

    public function postToken(Request $req){
        $token = Auth::User()->createToken('mytoken')->plainTextToken;
            $user_token =  Apimodel::where('email', Auth::User()->email )->first();
            if(!isset($user_token)){
                $user_token = new Apimodel();
                $user_token->email = Auth::User()->email;
                $user_token->token = $token;

                $user_token->save();

                return back()->withStatus('API generated');
            }else
            {
                $user_token->email = Auth::User()->email;
                $user_token->token = $token;
                $user_token->update();

                return back()->withStatus('API generated');
                
            }

    }

    
}
