<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Image;

class NewsController extends Controller
{
    public function news(){        

        $user = Auth::User();
        $news = News::orderBy('created_at', 'desc')->paginate(10);
        return view('news.news')->with('news', $news)->with('user', $user);
    }

    public function createNews(){ 

        return view('news.create');
    }

    public function postNews(Request $req){ 
        $news = new News();

        //Uploading Video
        $req->validate([
            'video' => 'mimes:mp4,ogx,oga,ogg,ogv,webm'
        ]);
        if(isset($req->video)){    
            $file = $req->video;
            $file->move('videos', $file->getClientOriginalName());
            $file_name = $file->getClientOriginalName();
            $req->video = $file_name;
        }else{
            $req->video = null;
        }

        $avatar= $req->file('image');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        Storage::disk('local')->makeDirectory('events/' );
        Image::make($avatar)->resize(800,800)->save(public_path('events/'. $filename));
        $news->image_path = $filename;

        $news->body = request('body');
        $news->title = request('title');
        $news->video_path = $req->video;
        $news->save();

        return back()->withStatus('News successfully Posted.');
    }

    public function deleteNews($id)
    {
        $news = News::where('id', $id)->first();
        $news->delete();
        return back()->withStatus('News successfully deleted.');
    }
}