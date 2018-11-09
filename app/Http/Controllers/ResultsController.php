<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classroom;
use App\Session;
use App\Term;
use App\Result;
use App\User;
use App\Classroomsubject;
use App\Cummulative;
class ResultsController extends Controller
{
    //


    public function  result(){
        $classroom = Classroom::get();
        $session = Session::get();
        $term = Term::get();
        return view('admin.pages.results', compact('classroom', 'session', 'term'));
    }


    public function create_result_sheet(){
        $classroom = Classroom::get();
        $session = Session::get();
        $term = Term::get();
        return view('admin.pages.create_result_sheet', compact('classroom', 'session', 'term'));
    }

    public function create_sheet(Request $request){
        $class_id = $request->classroom;
        $session_id = $request->session;
        $term_id = $request->term;
        $findexist = Result::where('classroom_id', $class_id)->where('session_id', $session_id)->where('term_id', $term_id)->count();
        if($findexist < 1){
           $findUsers = User::where('classroom_id', $class_id)->where('session_id', $session_id)->get();
           $classroomsubjects = Classroomsubject::where('classroom_id', $class_id)->get();
           foreach($findUsers as $user):
             foreach($classroomsubjects as $subjectoffered):
                $newSheet = new Result;
                $newSheet->classroom_id = $user->classroom_id; 
                $newSheet->user_id = $user->id; 
                $newSheet->session_id = $user->session_id;
                $newSheet->classroomsubject_id = $subjectoffered->id;
                $newSheet->subject_id =  $subjectoffered->subject->id;
                $newSheet->term_id = $request->term;
                $newSheet->save();  
              endforeach;
              $newCum = new Cummulative;
              $newCum->user_id = $user->id;
              $newCum->classroom_id = $user->classroom_id;
              $newCum->session_id = $user->session_id;
              $newCum->term_id = $request->term;
              $newCum->save();
            endforeach;
            return  response()->json([
                'msg' => 'User has been added',
                'title' => 'success'
            ]);
        } else {
            return  response()->json([
                'msg' => 'User has been added',
                'title' => 'exist'
            ]);
        }
    }
}
