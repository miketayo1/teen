<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Images;
use App\Models\EventTrash;
use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function getEvent()
    {
        $trashs  = EventTrash::get();
        if (EventTrash::exists()) {
            foreach ( $trashs as $trashs){
                $trashs= $trashs->count();
            }
        }
        else{
            $trashs = 0;  
        }
        $events = Event::OrderBy( 'created_at', 'desc')->get();
        if (Event::exists()) {
            foreach($events as $event){
                $user = User::where('email', $event->created_by)->first();
            }
            
            return view('pages.events.event')->with('events', $events)->with('user', $user)->with('trashs', $trashs);
        }else{
            return view('pages.events.event')->with('events', $events)->with('trashs', $trashs);
        }
        
    }

    public function addEvent(){

        return view('pages.events.addevent');
    }

    public function postAddEvent(Request $req){
        $events= new Event();
        $events->name=$req->name;
        $events->description=$req->description;   
        $events->created_by= Auth::User()->email;
        $events->save();

        $images= $req->file('image');
        foreach( $images as $image){
            $event_pics= new Images();
            $new_pic = Event::latest()->first();
            // dd($new_pic);
            $filename = time().rand(1, 1000) . '.' . $image->getClientOriginalExtension();
            Storage::disk('local')->makeDirectory('events/' );
            Image::make($image)->resize(1300,800)->save(public_path('events/'. $filename));
            $event_pics->path = $filename;
            $event_pics->event_id = $new_pic->id;
            $event_pics->save();
        }

    return back()->withStatus('Event successfully Posted.');
    }

    public function deleteEvent($id){
        $event = Event::where('id', $id)->first();
        $trash = new EventTrash();
        $trash->event_id = $id;
        $trash->name = $event->name;
        $trash->description = $event->description;
        $trash->created_by = $event->created_by;
        $trash->save();

        $event->delete();

        
        return back()->withStatus('Event successfully deleted.');
    }

    public function deletedEvent(){
        

        $trashs  = EventTrash::get();
        if (EventTrash::exists()) {
            foreach ( $trashs as $trashs){
                $trashs= $trashs->count();
            }
        }
        else{
            $trashs = 0;  
        }
        

        if (Event::exists()) {
            $revent = Event::OrderBy( 'created_at', 'desc')->get();
            $revent = $revent->count();
        }else{
            $revent = 0;
        }
        
        $events = EventTrash::OrderBy( 'created_at', 'desc')->get();
        if (EventTrash::exists()) {
            foreach($events as $event){
                $user = User::where('email', $event->created_by)->first();
            }
            
            return view('pages.events.trash')->with('events', $events)->with('user', $user)->with('trashs', $trashs)->with('revent',$revent);
        }else{
            return view('pages.events.trash')->with('events', $events)->with('trashs', $trashs)->with('revent',$revent);
        }

       
    }

    public function restoreEvent(Request $req, $id){

        
        $trash = EventTrash::where('event_id', $id)->first();
        $event = new Event();
        $event->id = $trash->event_id;
        $event->name = $trash->name;
        $event->description = $trash->description;
        $event->created_by = $trash->created_by;
        $event->save();

        $trash->delete();

        return back()->withStatus('Event successfully restored.');
    }

    public function permanentDelete($id){
       
        $event = EventTrash::where('event_id', $id)->first();
        $event->delete();
        return back()->withStatus('Event Permanently Deleted');
    }

    public function deletEvent($id) {

        return $this->permanentDelete($id);
    }

    public function getEditEvent($id){

        $event = Event::where('id', $id)->first();
        $images = Images::where('event_id', $event->id)->get();
        return view('pages.events.edit')->with('event',$event)->with('images',$images);
    }

    public function postEditEvent(Request $req, $id){

        $events = Event::where('id', $id)->first();       
        $images= $req->file('image');
        $events->name=$req->name;
        $events->description=$req->description;   
        $events->created_by= Auth::User()->email;
        $events->update();


        if (isset($images)) {
            $old_images = Images::where('event_id', $id)->get();
                foreach($old_images as $old_image){
                $old_image->delete();
                }
           
            foreach( $images as $image){
                
                $event_pics= new Images();
                $new_pic = Event::where('id', $id)->first();  
                // dd($new_pic);
                $filename = time().rand(1, 1000) . '.' . $image->getClientOriginalExtension();
                Storage::disk('local')->makeDirectory('events/' );
                Image::make($image)->resize(1300,800)->save(public_path('events/'. $filename));
                $event_pics->path = $filename;
                $event_pics->event_id = $new_pic->id;
                $event_pics->delete();
                $event_pics->save();
            }
        }else{
            $images = Images::where('event_id', $id)->get();
            foreach( $images as $image){
                $event_pics= Images::where('event_id', $id)->first();
                // dd($event_pics);
                $event_pics->path = $event_pics->path;
                $event_pics->event_id = $event_pics->event_id;
                $event_pics->update();
            }
        }

        return back()->withStatus('Event updated successfully');
    }

}


