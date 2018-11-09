<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;

class SessionsController extends Controller
{
    //

    public function index(){
        $getSession = Session::get();
        return view('admin.pages.sessions', compact('getSession'));
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(Request $request){

        if($request->status == true){
            $update=Session::where('status', 'true')->update(['status' => 'false']);
        }

        $getSession = new Session;
        $getSession->name = $request->name;
        $getSession->start = $request->start_date;
        $getSession->end = $request->end_date;
        $getSession->status = $request->status;
        if($getSession->save()){
            echo "success";
        }
       // return view('admin.pages.sessions', compact('getSession'));
    }
}
