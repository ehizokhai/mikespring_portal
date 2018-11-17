<?php
use App\User;
use App\Classroom;
use App\Subject;
use App\Cummulative;
use App\Result;
use App\Session;
use App\Term;
use Illuminate\Http\Request;
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
Route::post('/submitResult', 'ResultsController@submitResult');
Route::post('/markAsRelease', 'ResultsController@releaseResult');
Route::post('/getSubjects', 'SubjectController@getSubjects');
Route::get('/enterposition', 'ResultsController@enter_position');
Route::post('/post_position', 'ResultsController@post_position');
Route::post('/submitPosition', 'ResultsController@submitPosition');
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

Route::get('/getPdf/{sessionId}/{classroomId}/{termId}', function ($sessionId, $classroomId, $termId) {
    $user = Auth::user();
    $findSession = Session::find($sessionId);
    $term = Term::find($termId);
    $cummu = Cummulative::where('classroom_id', $classroomId)
    ->where('session_id', $sessionId)->where('term_id', $termId)
    ->where('user_id', $user->id)->first();
    $results = Result::where('session_id', $sessionId)->where('classroom_id', $classroomId)->where('term_id', $termId)
    ->where('user_id', $user->id)->get();
    $pdf = App::make('dompdf.wrapper');
    //$pdf->loadHTML('<h1>Test</h1>');
    $pdf = PDF::loadView('pdf.result', compact('results', 'user', 'findSession', 'term', 'cummu'));
    //return $pdf->download('invoice.pdf');
    return $pdf->stream();
});


Route::get('/getPdfs', function () {
   
    return view('student.pages.result');
});

Route::get('/releaseresults', 'ResultsController@releaseResult');
Route::get('/student/home', function () {
    $getUser = Auth::user();
    $getCummulative = Cummulative::where('user_id', $getUser->id)->get();

    return view('student.pages.home', compact('getUser', 'getCummulative'));
});

Route::post('/testarray', function () {
    // $users = DB::table('results')
    // ->join('users', 'users.id', '=', 'results.user_id')
    // ->join('classrooms', 'classrooms.id', '=', 'results.classroom_id')
    // ->join('terms', 'term.id', '=', 'results.term_id')
    // ->get();

   $users =  Result::join('users', function ($join) {
            $join->on('users.id', '=', 'results.user_id');
        })->join('classrooms', function ($join) {
            $join->on('classrooms.id', '=', 'results.classroom_id')
                 ->where('classrooms.id', '=', request('classroom'));
        })->join('sessions', function ($join) {
            $join->on('sessions.id', '=', 'results.session_id')
                 ->where('sessions.id', '=', request('session'));
        })->join('terms', function ($join) {
            $join->on('terms.id', '=', 'results.term_id')
                 ->where('terms.id', '=', request('term'));
        })->join('subjects', function ($join) {
            $join->on('subjects.id', '=', 'results.subject_id')
            ->where('subjects.id', '=', request('subjects'));

        }) ->select('users.firstname', 'users.lastname', 'results.id as id', 'users.address', 
         'subjects.title as title', 'terms.id as term_id', 'results.grade', 'results.remarks', 'results.exam', 'results.test', 'results.benchmark', 'results.total')->get();

        return  response()->json([
            'msg' => 'User has been added',
            'title' => 'success',
            'data' => $users,
        ]);
   // return $users;
});

Route::post('/markRelease', 'ResultsController@markRelease');
Route::post('/markRevert', 'ResultsController@markRevert');
Route::post('/check_pin', 'ResultsController@check_pin');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
