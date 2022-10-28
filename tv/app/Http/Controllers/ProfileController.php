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

    public function update( Request $req)
    {
        
        $user = request()->user();
       
        $attributes = request()->validate([
            'email' => 'required|email|unique:users,email,'.$user->id,
            'name' => 'required',
            'phone' => 'required|max:12',
            
            
        ]);
        auth()->user()->update($attributes);
        return back()->withStatus('Profile successfully updated.');
    
}
    public function addUser(){
        return view('pages.newuser');
    }

    public function postAddUser(Request $req){
        
        if( strcmp( $req['password'], $req['password_confirmation']) == 0)
        {
            $attributes = request()->validate([
                'email' => 'required|email|max:255|unique:users,email',
                'name' => 'required',
                'phone' => 'required|max:12',
                'role' => 'required:max:150',
                'password' => 'required|min:5|max:255',
                
                
            ]);
            $user = User::create($attributes);
            return back()->withStatus('Profile successfully created.');
        }
        return back()->withDemo('Some fields are missing');
        
      
        
    
    }

    public function userManagement(){

        $users = User::all();

        return view('pages.laravel-examples.user-management')->with('users',$users);
    }


    public function deleteUser($id){

        $user = User::where('id', $id)->delete();
        return back()->withStatus('User Deleted successfully.');
    }

    public function editUser($id){
        $user = User::where('id', $id)->first();

        return view('pages.edit-user')->with('user',$user);
    }
    
    public function postEditUser($id){
    
        $user = User::where('id', $id)->first();
        $attributes = request()->validate([
            'email' => 'required|email|unique:users,email,'.$user->id,
            'name' => 'required',
            'phone' => 'required|max:12',
            'role' => 'required:max:150',
            
        ]);
        
         $user->update($attributes);
        return back()->withStatus('Profile successfully updated.');
    }


}
