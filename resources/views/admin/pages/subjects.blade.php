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
                           <button class="btn btn-primary xm" id="enterSubject"> Add Subject</button>
                           <button class="btn btn-success xm" id="openAssign"> Submit Assign</button>
                          </div>
                            <div class="card-body">
                                <h4 class="card-title">Subjects</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Choose</th>
                                                <th>Id</th>
                                                <th>Title</th>
                                                <th>Code Name</th>
                                                <th>School Category</th>
                                                <th> Actions</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                               <th>Choose</th>
                                                <th>Id</th>
                                                <th>Title</th>
                                                <th>Code Name</th>
                                                <th>School Category</th>
                                                <th> Actions</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        @foreach($getSubject as $subject)
                                            <tr>
                                               <th><input type="checkbox" value="{{$subject->id}}" onchange="changeStatus(this.value)" > 
                                               {{-- <input type="checkbox" onchange="changeStatus(this.value)" value="{{_id}}"  name="check" id="input{{_id}}" checked="true"> --}}
                                               </th>
                                                <td>{{$subject->id}}</td>
                                                <td>{{$subject->title}}</td>
                                                <td>{{$subject->codeName}}</td>
                                                <td>{{$subject->schoolCategory}}</td>
                                                <td>
                                                <div class="btn-group">
      
                                                <button type="button" value="{{$subject->id}}" onclick="all_user(this.value)"  class="btn btn-success"><i class="fa fa-edit"></i></button>
                                                <button type="button" value="{{$subject->id}}" onclick="confirmTrash(this.value)"  class="btn btn-danger"><i class="fa fa-trash"></i></button></form>
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

$('#openAssign').click(function(){

$.confirm({
title: 'Add Classroom!',
content: '' +
'<form action="" class="formName">' +
'<div class="form-group">' +
'<label>Category</label>' +
'<select name="country" id="classId" class="category form-control custom-select"><option>--Select your Category-- </option> @foreach($getClassroom as $classroom)<option value={{$classroom->id}}>{{$classroom->name}}</option>@endforeach' +
'</div>' +
'</form>',
buttons: {
    formSubmit: {
        text: 'Submit',
        btnClass: 'btn-blue',
        action: function () {
            var classId = $('#classId').val();
            confirmSubmitAssign(classId);
            // var name = this.$content.find('.name').val();
            // if(!name){
            //     $.alert('provide a valid name');
            //     return false;
            // }
            // $.alert('Your name is ' + name);
        }
    },
    cancel: function () {
        //close
    },
},
onContentReady: function () {
    // bind to events
    var jc = this;
    this.$content.find('form').on('submit', function (e) {
        // if the user submits the form by pressing enter in the field.
        e.preventDefault();
        jc.$$formSubmit.trigger('click'); // reference the button and click it
    });
}
});
})


var allVals=[];
function changeStatus(id){

var idx = $.inArray(id, allVals);
if (idx == -1) {

  allVals.push(id);
  //$('#attenStatus'+id).html('Present');
console.log(allVals);
} else {

 allVals.splice(idx, 1);
 //$('#attenStatus'+id).html('Absent');
 console.log(allVals);
}
//alert(allVals);
}

function confirmSubmitAssign(classId){
    
   jQuery.ajax({
   type: "POST", // Post / Get method
   url: "/assign_subject", //Where form data is sent on submission
   dataType:"text", // Data type, HTML, json etc.
   data:{classId: classId, subjects: allVals, "_token": "{{ csrf_token() }}"}, //Form variables
   success:function(response){
    var json=response;
    alert(json.title);
     console.log(response);

   },
   error:function (xhr, ajaxOptions, thrownError){
      alert(thrownError);
      //$("#loading").hide(); 
   }
 });
}

</script>
@endsection