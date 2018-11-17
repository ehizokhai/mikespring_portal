<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Classroom;
use App\Classroomsubject;
class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $getSubject = Subject::get();
        $getClassroom = Classroom::get();
        return view('admin.pages.subjects', compact('getSubject', 'getClassroom'));
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
      // shell_exec($request->category);
      $subject = new Subject;
      $subject->title = $request->title;
      $subject->codeName = $request->codeName;
      $subject->schoolCategory = $request->category;
      if($subject->save()){
          //return response()->json($subject);
          return response()->json([
            'data' => $subject,
            'title' => 'success'
        ]);
      }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assign_subject(Request $request)
    {
        //
        $classId = $request->classId;
        foreach($request->subjects as $subject){
            $subjectAssign = new Classroomsubject;
            $subjectAssign->classroom_id = $classId;
            $subjectAssign->subject_id = $subject;
            $subjectAssign->save();
        }

    }

    public function getSubjects(Request $request){
     //$getSubject= Classroomsubject::where('classroom_id', $request->classId)->get();

     $subjects = Classroomsubject::where('classroomsubjects.classroom_id', $request->classId)->join('subjects', function ($join) {
         $join->on('classroomsubjects.subject_id', '=', 'subjects.id');
     })->select('classroomsubjects.*', 'subjects.id as id', 'subjects.title as subject_name')->get();

        return response()->json([
            'data' => $subjects,
            'title' => 'success'
        ]);
    }


    public function classroomsubject()
    {
        $classroomSubject = Classroomsubject::get();
        return view('admin.pages.classroomsubjects', compact('classroomSubject'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
