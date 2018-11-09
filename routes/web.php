<?php
use App\User;
use App\Classroom;
use App\Subject;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('/add_session', 'SessionsController@add');
Route::get('/sessions', 'SessionsController@index');
Route::get('/classroomsubject', 'SubjectController@classroomsubject');
Route::post('/assign_subject', 'SubjectController@assign_subject');
Route::post('/add_classroom', 'ClassroomController@create');
Route::get('/classrooms', 'ClassroomController@index');
Route::get('/subjects', 'SubjectController@index');
Route::post('/add_subject', 'SubjectController@create');
Route::get('/registration', 'RegistrationController@index');
Route::get('/search_current_student', 'StudentsController@search_current');
Route::post('/regist', 'RegistrationController@create');
Route::post('/search_student', 'StudentsController@search_student');
Route::get('/logout', 'StudentsController@logout');
Route::get('/results', 'ResultsController@result');
Route::get('/create_exam_sheet', 'ResultsController@create_result_sheet');
Route::post('/create_sheet', 'ResultsController@create_sheet');
Route::get('/dashboard', function () {

    $studentcount = User::where('role_id', 3)->count();
    $inactivecount = User::where('active', 0)->where('role_id', 3)->count();
    $subjectcount = Subject::count();
    $classroomcount = Classroom::count();
    $classrooms = Classroom::get();

    return view('admin.pages.home', compact('studentcount', 'inactivecount', 'classrooms', 'subjectcount', 'classroomcount'));
})->middleware('auth');

Route::get('/', function () {
return redirect('/dashboard');

});

Route::post('/testarray', function () {
    // $users = DB::table('results')
    // ->join('users', 'users.id', '=', 'results.user_id')
    // ->join('classrooms', 'classrooms.id', '=', 'results.classroom_id')
    // ->join('terms', 'term.id', '=', 'results.term_id')
    // ->get();

   $users =  DB::table('results')
        ->join('users', function ($join) {
            $join->on('users.id', '=', 'results.user_id');
        })->join('classrooms', function ($join) {
            $join->on('classrooms.id', '=', 'results.classroom_id')
                 ->where('classrooms.id', '=', 5);
        })->join('sessions', function ($join) {
            $join->on('sessions.id', '=', 'results.session_id')
                 ->where('sessions.id', '=', 3);
        })->join('terms', function ($join) {
            $join->on('terms.id', '=', 'results.term_id')
                 ->where('terms.id', '=', 1);
        })->join('subjects', function ($join) {
            $join->on('subjects.id', '=', 'results.subject_id');

        })->get();

        return  response()->json([
            'msg' => 'User has been added',
            'title' => 'success',
            'data' => $users,
        ]);
   // return $users;
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
