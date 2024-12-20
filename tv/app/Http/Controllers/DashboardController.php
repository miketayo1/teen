<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Slider;
use App\Models\Community;
use App\Models\Logo;
use App\Models\Contact;
use App\Models\Event;
use App\Models\Log;
use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    public function index()
    {   
        if(!Auth::User()){
            return redirect('sign-in');
        }
        
        $users = User::all();
        $community = Community::OrderBy( 'created_at', 'desc')->paginate(10);
        $events= DB::table('event')
        ->select('event.*')
        ->where('event.active', '1')
        ->distinct()
        ->paginate(10);
        return view('dashboard.index')->with('events', $events)->with('users', $users)->with('community', $community);
    }

    public function config(){

        $sliders = Slider::get();
        $logo = DB::table('logo')->latest()->first();
        $contact = Contact::first();
        
        return view('pages.configuration.configuration')->with('sliders', $sliders)->with('logo', $logo)->with('contact', $contact);
    }

    public function postSlider(Request $req){
        $slider = new Slider();
        $slider->name = $req->input('name');
        $slider->description = $req->input('description');
     
       
            $avatar= $req->file('path');
			$filename = time() . '.' . $avatar->getClientOriginalExtension();
			Storage::disk('local')->makeDirectory('sliders/' );
			Image::make($avatar)->resize(1300,800)->save(public_path('sliders/'. $filename));
            $slider->path = $filename;
        $slider->save();
        return back()->withStatus('Slider successfully uploaded.');   

        
    }

    public function editSlider($id)
    {

        $slider = Slider::where('id', $id)->first();
        return view('pages.configuration.edit-slider')->with('slider', $slider);
    }

    public function updateSlider(Request $req, $id)
    {
        $slider = Slider::where('id', $id)->first();
        $slider->name = $req->input('name');
        $slider->description = $req->input('description');
     
       
            $avatar= $req->file('path');
			$filename = time() . '.' . $avatar->getClientOriginalExtension();
			Storage::disk('local')->makeDirectory('sliders/' );
			Image::make($avatar)->resize(1300,800)->save(public_path('sliders/'. $filename));
            $slider->path = $filename;
        $slider->update();
        return back()->withStatus('Slider successfully updated.');  
    }

    public function deleteSlider($id)
    {
        
        $slider = Slider::where('id', $id)->delete();
        return back()->withStatus('slider Deleted successfully.');
        
    }

    public function logo(){

        $logo = DB::table('logo')->latest()->first();
        
       
        return view('pages.configuration.logo')->with('logo',$logo);
    }

    public function postLogo(Request $req)
    {
        $logo = Logo::first();
        if(isset($logo) ){
            $avatar= $req->file('path');
			$filename = time() . '.' . $avatar->getClientOriginalExtension();
			Storage::disk('local')->makeDirectory('sliders/' );
			Image::make($avatar)->resize(150,150)->save(public_path('logo/'. $filename));
            $logo->path = $filename;
            $logo->update();
            return back()->withStatus('Logo successfully uploaded.'); 
        }else{
            $logo = new Logo();
            $avatar= $req->file('path');
			$filename = time() . '.' . $avatar->getClientOriginalExtension();
			Storage::disk('local')->makeDirectory('sliders/' );
			Image::make($avatar)->resize(150,150)->save(public_path('logo/'. $filename));
            $logo->path = $filename;
            $logo->save();
            return back()->withStatus('Logo successfully uploaded.'); 
        }
    }

    public function contact(Request $req){
        $data= Contact::first();
        if($data == null) {
            $data = new Contact();
            $data->address = $req->input('addr');
            $data->phone = $req->input('phone');
            $data->email = $req->input('email');
          
            $data->save();
            $log = new Log();
            $log->user = Auth::user()->name;
            $log->email = Auth::user()->email;
            $log->activity = Auth::user()->name. " updated the contact information" ;
            $log->save();
            return back()->withStatus('Contact updated successfully');

        }else{
            $data->address = $req->input('addr');
            $data->phone = $req->input('phone');
            $data->email = $req->input('email');
            $data->update();

            $data->save();
            $log = new Log();
            $log->user = Auth::user()->name;
            $log->email = Auth::user()->email;
            $log->activity = Auth::user()->name. " updated the contact information" ;
            $log->save();
            return back()->withStatus('Contact updated successfully');
        }
 
    }
}
