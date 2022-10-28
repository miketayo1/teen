<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
use Image;
class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function config(){

        $sliders = Slider::get();
        
        
        return view('pages.configuration.configuration')->with('sliders', $sliders);
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
        return back()->withStatus('Slider successfully updated.');   

        
    }
}
