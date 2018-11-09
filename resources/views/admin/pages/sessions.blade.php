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
                           <button class="btn btn-success xm" id="openAddSession">Add Session</button>
                          </div>
                            <div class="card-body">
                                <h4 class="card-title">Data Export</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th> Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($getSession as $session)
                                            <tr>
                                                <td>{{$session->name}}</td>
                                                <td>{{$session->start}}</td>
                                                <td>{{$session->end}}</td>
                                                <td>
                                                <div class="btn-group">
      
                                                <button type="button" value="{{$session->id}}" onclick="all_user(this.value)"  class="btn btn-success"><i class="fa fa-edit"></i></button>
                                                <button type="button" value="{{$session->id}}" onclick="confirmTrash(this.value)"  class="btn btn-danger"><i class="fa fa-trash"></i></button></form>
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

var stat = false;

function checkStat(){
    if(stat == false){
    stat=true;
    } else {
        stat = false; 
    }

    alert(stat);
}

$('#openAddSession').click(function(){
 stat = false;
$.confirm({
title: 'Add Session!',
content: '' +
'<form action="" class="formName">' +
'<div class="form-group">' +
'<label>Title</label>' +
'<input type="text" placeholder="Your name" id="sessionname" class="titl form-control" required />' +
'<label>Start Date</label>' +
'<input type="date" placeholder="Your name" id="start_date" class="titl form-control" required />' +
'<label>End Date</label>' +
'<input type="date" placeholder="Your name" id="end_date" class="titl form-control" required />' +
'<label>Status</label>' +
'<div class="checkbox checkbox-success">' +
'<input type="checkbox" id="status" onclick="checkStat()" class="status" required />' +
'<label for="checkbox33">  Click to make this session active</label>' +
'</div>' +
'</div>' +
'</form>',
buttons: {
    formSubmit: {
        text: 'Submit',
        btnClass: 'btn-blue',
        action:  ()=> {
            var title = $('#sessionname').val();
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();
            var status = $('#status').val();
             confirmSessionAdd(title, startDate, endDate, status );
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

function confirmSessionAdd(title, start_date, end_date, status){
    
    // alert(title);
    // alert(start_date)
    // alert(end_date);
    // alert(status);
   jQuery.ajax({
   type: "POST", // Post / Get method
   url: "/add_session", //Where form data is sent on submission
   dataType:"text", // Data type, HTML, json etc.
   data:{name: title, start_date: start_date, end_date: end_date, status: stat, "_token": "{{ csrf_token() }}"}, //Form variables
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