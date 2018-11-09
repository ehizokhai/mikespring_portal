<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Classroom;
use App\User;
use Auth;
class StudentsController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function search_current(){

        $getStudent = null;
        $getCurrentSession  =  Session::where('status','true')->first();
        $getClassroom = Classroom::get();
        $currentClass = null;
        //return $getCurrrentSession;
        return view('admin.pages.current_session_search', compact('getStudent', 'getCurrentSession', 'getClassroom', 'currentClass'));
    }

    public function search_student(Request $request){
      $classroomId = $request->classroom;
      $sessionId = $request->session;
      $getStudent = User::where('classroom_id', $classroomId )->where('session_id', $sessionId)->get();
      $getCurrentSession  =  Session::where('status','true')->first();
      $getClassroom = Classroom::get();
      $currentClass = Classroom::find($classroomId);
      return view('admin.pages.current_session_search', compact('getStudent', 'getCurrentSession', 'getClassroom', 'currentClass'));
    }


    public function logout(){
        auth()->logout(); 

        return  redirect('/login');
    }
}
