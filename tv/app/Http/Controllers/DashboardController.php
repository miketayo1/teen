<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Slider;
use App\Models\Logo;
use App\Models\Contact;
use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function config(){

        $sliders = Slider::get();
        $logo = DB::table('logo')->latest()->first();
        
        return view('pages.configuration.configuration')->with('sliders', $sliders)->with('logo', $logo);
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
        $logo = new Logo();
            $avatar= $req->file('path');
			$filename = time() . '.' . $avatar->getClientOriginalExtension();
			Storage::disk('local')->makeDirectory('sliders/' );
			Image::make($avatar)->resize(150,150)->save(public_path('logo/'. $filename));
            $logo->path = $filename;
        $logo->save();
        return back()->withStatus('Logo successfully uploaded.'); 
    }

    public function contact(Request $req){
        $data= Contact::first();
        if($data == null) {
            $data = new Contact();
            $data->address = $req->input('addr');
            $data->phone = $req->input('phone');
            $data->email = $req->input('email');
          
            $data->save();
            return back()->withStatus('Contact updated successfully');

        }else{
            $data->address = $req->input('addr');
            $data->phone = $req->input('phone');
            $data->email = $req->input('email');
            $data->update();
            return back()->withStatus('Contact updated successfully');
        }
 
    }
}
