<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class ProfileController extends Controller
{
    public function create()
    {
        return view('pages.profile');
    }

    public function update()
    {
            
        $user = request()->user();
        $attributes = request()->validate([
            'email' => 'required|email|unique:users,email,'.$user->id,
            'name' => 'required',
            'phone' => 'required|max:12',
            'role' => 'required:max:150',
            
        ]);
        // dd($attributes);
        auth()->user()->update($attributes);
        return back()->withStatus('Profile successfully updated.');
    
}
    public function addUser(){
        return view('pages.newuser');
    }

    public function postAddUser(){
        
        // if(request()->['password'] !== request()->['password_confirmation'])
        // {
        //     dd('ok');
        // }
        $attributes = request()->validate([
            'email' => 'required|email|max:255|unique:users,email',
            'name' => 'required',
            'phone' => 'required|max:12',
            'role' => 'required:max:150',
            'password' => 'required|min:5|max:255',
            
            
        ]);
        
        dd($attributes);
        $user = User::create($attributes);
      
        return back()->withStatus('Profile successfully created.');
    
    }

    public function userManagement(){

        $users = User::all();

        return view('pages.laravel-examples.user-management')->with('users',$users);
    }



}
