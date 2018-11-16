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
use App\Releasenote;
use App\Pin;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Alert;
use Auth;
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
        $releasenote = new Releasenote;
        $releasenote->classroom_id = $class_id;
        $releasenote->session_id = $session_id;
        $releasenote->term_id = $term_id;
        $releasenote->save();
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
                $newSheet->benchmark = $request->benchmark;
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

    public function submitResult(Request $request){
      

        //Log::info($request->data);
        $arrayData = $request->data;
        // for($i = 0; $i < count($arrayVal); ++$i) {
        //     Log::info($arrayVal[$i]['id']);
        // }
        // return null;

        for($i = 0; $i < count($arrayData); ++$i){
            
           // $this->info('Display this on the screen');
           //return Log::info($arrayData[$i]['id']);
           $id = (int)$arrayData[$i]['id'];
         //  Log::info($id);
           $newResult = Result::find($id);
           $newResult->exam =  $arrayData[$i]['examRow'];
           $newResult->test =  $arrayData[$i]['testRow'];
           $newResult->total =  (int)$arrayData[$i]['examRow'] + (int)$arrayData[$i]['testRow'];
           if($newResult->save()){
             $newCum = Cummulative::where('session_id', $newResult->session_id)
             ->where('user_id', $newResult->user_id)
             ->where('term_id', $newResult->term_id)
             ->first();
             $newCum->total += $newResult->total;
             $newCum->save();
           }
        }
        return  response()->json([
            'msg' => 'User has been added',
            'title' => 'success'
        ]);
    }

    public function releaseResult(){
        //$cummulative  = DB::select(DB::raw("SELECT DISTINCT classroom_id, term_id FROM cummulatives LEFT JOIN sessions ON sessions.id= cummulatives.id"));
         $releasenote = Releasenote::get();
    
    //return ($cummulative);
        return view('admin.pages.releaseresult', compact('releasenote'));
    }

    // public function releaseResult(Request $request){
    //     $id = $release->id;
    //     Cummulative::where('', $userEmail)
    //     ->update(array('' => $plan)); 

    // }

    public function markRelease(Request $request){
        $sessionId = $request->session_id;
        $termId = $request->term_id;
        $classroomId = $request->classroom_id;
       // $findCummulative = Cummulative::where('term_id', $termId)->where('session_id', $sessionId)->where('classroom_id', $classroomId)->get();
        //$releasenote = Releasenote::where('term_id', $termId)->where('session_id', $sessionId)->where('classroom_id', $classroomId)->get();
       $markCummu =  Cummulative::where('term_id', $termId)->where('session_id', $sessionId)->where('classroom_id', $classroomId)
        ->update(array('released' => 'true')); 
        $markRele =  Releasenote::where('term_id', $termId)->where('session_id', $sessionId)->where('classroom_id', $classroomId)
        ->update(array('released' => 'true')); 
        Alert::success('Results has been marked as released', 'Success');

        return redirect('/releaseresults');

    }

    public function markRevert(Request $request){
        $sessionId = $request->session_id;
        $termId = $request->term_id;
        $classroomId = $request->classroom_id;
       // $findCummulative = Cummulative::where('term_id', $termId)->where('session_id', $sessionId)->where('classroom_id', $classroomId)->get();
        //$releasenote = Releasenote::where('term_id', $termId)->where('session_id', $sessionId)->where('classroom_id', $classroomId)->get();
       $markCummu =  Cummulative::where('term_id', $termId)->where('session_id', $sessionId)->where('classroom_id', $classroomId)
        ->update(array('released' => 'false')); 
        $markRele =  Releasenote::where('term_id', $termId)->where('session_id', $sessionId)->where('classroom_id', $classroomId)
        ->update(array('released' => 'false')); 
        Alert::success('Results has been marked as not released', 'success');

        return redirect('/releaseresults');

    }

    public function check_pin(Request $request){
        $user = Auth::user();
        Log::info($request->cummulative_id);
        $checkExist = Pin::where('pin', $request->pin)->first();
        if($checkExist->used == 'true'){
            Log::info('checkesist is true');
        return  response()->json([
            'msg' => 'Invalid Pin',
            'title' => 'error'
        ]);
      } else {
        $checkExist->cummulative_id = $request->cummulative_id;
        $checkExist->user_id = $user->id;
        $checkExist->used = 'true';
        $checkExist->save();
        $findCummu = Cummulative::find($request->cummulative_id);
        $findCummu->checked = 'true';
        $findCummu->save();
        Log::info($findCummu);
        return  response()->json([
            'msg' => 'Invalid Pin',
            'title' => 'success',
            'data' => $findCummu,
        ]);
      }
    } 
}
