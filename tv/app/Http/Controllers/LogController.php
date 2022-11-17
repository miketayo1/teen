<?php

namespace App\Http\Controllers;
use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function getLog(){

        $logs = Log::OrderBy( 'created_at', 'desc')->paginate(10);
        return view('activity.log')->with('logs', $logs);
    }
}
