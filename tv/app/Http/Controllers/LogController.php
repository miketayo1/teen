<?php

namespace App\Http\Controllers;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function getLog(){
        if (Auth::User()->role !== 'Admin')
        {
            
            return redirect('/user-profile')->withStatus('Unathorized access');
        }
        
        $logs = Log::OrderBy( 'created_at', 'desc')->paginate(10);
        return view('activity.log')->with('logs', $logs);
    }

}
