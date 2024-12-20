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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Mail;

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
        ->join('video', 'event.id', '=', 'video.event_id')
        ->select('event.*', 'video.link1', 'video.link2','video.link3','event.name as  slug')
        ->where('event.active', '1')
        ->distinct()
        ->get();

        return $events->transform(function ($event, $key) {
            return [
                'id'=> $event->id,
                'name'=>$event->name,
                'description'=> $event->description,
                'video' => $event->video,
                'active'=> $event->active,
                'schedule'=> $event->schedule,
                'link1' => $event->link1,
                'link2' => $event->link2,
                'link3' => $event->link3,
                'slug' => str_slug($event->name),
                
            ];
        });
    }

    public function getEventImages(){
       
        $events = DB::table('event')
        ->join('images', 'event.id', '=', 'images.event_id')
        ->select('event.id','event.name' , 'images.path')
        ->where('event.active', '1')
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
        ->unique('id')
        ->values();
        return $events->transform(function ($event, $key) {
            return [
                'id'=> $event->id,
                'name'=>$event->name,
                'path'=> $event->path,
                'slug' => str_slug($event->name),
                
            ];
        });
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

    public function postContact(Request $req){

        $contact = new Contact();

        $contact->email= $req->input('email');
        $contact->name = $req->input('name');
        $contact->phone = $req->input('phone');
        $contact->message = $req->input('message');

        Mail::send('email.name', array(
            'name' => $contact['name'],
            'email' => $contact['email'],
            'phone' => $contact['phone'],
            'subject' => $contact['subject'],
            'messag' => $contact['message'],
        ), function($message) use ($req){
            $message->from($req->email);
            $message->to('tatvweb@gmail.com', 'Admin')->subject($req->get('subject'));
        });

        return response()->json([
            'success' => 'Thank you for contacting us!!!' ]);
    }

    
}
