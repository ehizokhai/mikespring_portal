@extends('layouts.master')

@section('content')
<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> -->

 <div class="container-fluid">
 <div class="row">
                    <div class="col-12">
                        <div class="card">
                         <div class="col-md-4">
                           <!-- <button class="btn btn-primary xm" id="enterSubject"> Add Subject</button>
                           <button class="btn btn-success xm" id="openAssign"> Submit Assign</button> -->
                          </div>
                            <div class="card-body">
                                <h4 class="card-title">Result release</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Classroom</th>
                                                <th>Term</th>
                                                <th>Session</th>
                                                <th> Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($releasenote as $result)
                                            <tr> 
                                               <td>{{$result->id}}</td>
                                                <td id="classId{{$result->classroom_id}}">{{$result->classroom->name}}</td>
                                                <td id="termId{{$result->classroom_id}}">{{$result->term->name}}</td>
                                                <td id="sessionsId{{$result->classroom_id}}">{{$result->session->name}}</td>
                                                <td>
                                                <div class="btn-group"> 
                                              @if($result->released == 'false')
                                                <form method="POST" style="display:block" action="/markRelease" onsubmit="return ConfirmDelete()"/>
                                                  <input type="hidden" value="{{$result->classroom_id}}" name="classroom_id"/>
                                                  <input type="hidden" value="{{$result->session_id}}" name="session_id"/>
                                                  <input type="hidden" value="{{$result->term_id}}" name="term_id"/>
                                                  {{csrf_field()}}
                                                  <button type="submit"  class="btn btn-success"><i class="fa fa-check"> Mark as released</i></button>
                                                </form>
                                              @else
                                              <form method="POST" style="display:block" action="/markRevert" onsubmit="return ConfirmRevert()"/>
                                              <input type="hidden" value="{{$result->classroom_id}}" name="classroom_id"/>
                                              {{csrf_field()}}
                                                  <input type="hidden" value="{{$result->session_id}}" name="session_id"/>
                                                  <input type="hidden" value="{{$result->term_id}}" name="term_id"/>
                                                <button type="submit" id="revertRelease"  onclick="confirmTrash(this.value)"  class="btn btn-danger"><i class="fa fa-undo"></i> Revert</button>
                                                </form>
                                              @endif
                     <!-- <button type="button" class="btn btn-primary"><i class="fa fa-eye"></i></button>-->

                                                 </div>
                                                </td>  
                                            </tr>
                                         @endforeach   
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

</div>
@endsection

@section('javascript')
 
<script>

  function ConfirmDelete()
  {
  var x = confirm("Are you sure you want to mark result? Please make sure you have entered every result details");
  if (x)
    return true;
  else
    return false;
  }

  function ConfirmRevert()
  {
  var x = confirm("Are you sure you want to revert results to not released");
  if (x)
    return true;
  else
    return false;
  }
function markRelease(id){
  
   jQuery.ajax({
   type: "POST", // Post / Get method
   url: "/markAsRelease", //Where form data is sent on submission
   dataType:"text", // Data type, HTML, json etc.
   data:{id: id, "_token": "{{ csrf_token() }}"}, //Form variables
   success:function(response){
    if(response == 'success'){
        alert('Session has been added');
    }
   },
   error:function (xhr, ajaxOptions, thrownError){
      alert(thrownError);
      //$("#loading").hide(); 
   }
 });
}
</script>

@endsection
