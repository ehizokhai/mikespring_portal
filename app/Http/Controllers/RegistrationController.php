<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Role;
use App\User;
use App\Result;
use App\Classroom;
use App\Classroomsubject;
use App\Session;
use Alert;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $getSession = Session::get();
        $getClassroom = Classroom::get();
      
        //
        $roles = Role::get();
        return view('admin.pages.registeration', compact('roles', 'getSession', 'getClassroom'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if (request()->file('photo') == null) {
            $file = "";

        } else {
           //$file=  Storage::putFile('photo', new File('/photos'), 'public');
           $file = request()->file('photo')->store('public/photos');  
       }

      $user = new User;
      $user->firstname = $request->firstname;
      $user->lastname = $request->lastname;
      $user->email = $request->email;
      $user->middlename = $request->middlename;
      $user->address = $request->address;
      $user->city = $request->city;
      $user->state_of_origin = $request->state_of_origin;
      $user->lga = $request->lga;
      $user->passport = substr($file, 7);
      $user->dob = $request->dob;
      $user->gender = $request->gender;
      $user->role_id = $request->role_id;
      $user->password = bcrypt($request->password);
      $user->session_id = $request->session;
      $user->classroom_id = $request->classroom;

      if($user->save()){
        $currYr = date("Y");
        $initial = substr($currYr, 2);
        $user->reg_no = 'MS/'.$initial. '/'.str_pad($user->id, 5, '0', STR_PAD_LEFT);
        $user->save();

        $findSubject =  Classroomsubject::where('classroom_id', $user->classroom_id)->get();

        foreach($findSubject as $subject){
         $newResult = new Result;
         $newResult->classroom_id = $user->classroom_id; 
         $newResult->user_id = $user->id; 
         $newResult->session_id = $user->session_id;
         $newResult->classroomsubject_id = $subject->id;
         $newResult->term_id = 1;
         $newResult->save();
        }
          //$result = new Result;
        return  response()->json([
            'msg' => 'User has been added',
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
    public function store(Request $request)
    {
        //
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
