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
                        <iframe name="votar" style="display:none;"></iframe>
                        <form method="POST" target="votar" name="fileUploadForm" id="fileUploadForm" style="display:block;" action="/search_student"> 
                               <div class="row p-t-20">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                         <select id="session" name="session" class="form-control">
                                          @foreach($session as $sess)
                                            <option selected value="{{$sess->id}}">{{$sess->name}}</option>
                                         @endforeach   
                                         </select>
                                        </div>
                                    </div> 
                                            <!--/span-->
                                    <div class="col-md-3">
                                        <div class="form-group has-danger">
                                                <select id="classroom" name="classroom" class="form-control">
                                                    <option  value="">--- select classroom --</option>
                                                    @foreach($classroom as $class)
                                                    <option selected value="{{$class->id}}">{{$class->name}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-danger">
                                                <select id="term" name="term" class="form-control">
                                                    <option  value="">--- select term --</option>
                                                    @foreach($term as $ter)
                                                    <option selected value="{{$ter->id}}">{{$ter->name}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                                <div class="form-group has-danger">
                                                    <button type="submit" id="create_sheet" class="btn btn-success"> <i class="fa fa-search"></i> Create</button>
                                            </div>
                                     </div> 
                                     
                                         <!--/span-->
                                     </form>

                       {{--  <div class="col-md-4">
                           <button class="btn btn-primary xm" onclick="submitRes()" id="enterSubject"> Add Subject</button>
                           <button class="btn btn-success xm" id="openAssign"> Submit Assign</button>
                          </div>--}}
                            <div class="card-body">
                           {{--     <h4 class="card-title">Data Export</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> --}}
                                <button class="btn btn-success xm" id="submitResult"> Submit Result</button>
                                <div class="m-t-40">
                                  <div id="example50"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

</div>
@endsection

@section('javascript')
<link rel="stylesheet" type="text/css" href="{{url('//cdn.jsdelivr.net/npm/handsontable-pro@latest/dist/handsontable.full.min.css')}}">
<script src="{{url('//cdn.jsdelivr.net/npm/handsontable@6.1.1/dist/handsontable.full.min.js')}}"></script>
<script>

// var
//  objectData = [
//     {id: 1, name: 'Ted Right', address: ''},
//     {id: 2, name: 'Frank Honest', address: ''},
//     {id: 3, name: 'Joan Well', address: ''},
//     {id: 4, name: 'Gail Polite', address: ''},
//     {id: 5, name: 'Michael Fair', address: ''},
//   ],
//   container1 = document.getElementById('example50'),
//   settings1 = {
//   data: objectData,
//   fixedRowsTop: 2,
//   fixedColumnsLeft: 2,
//   colWidths: 100,
//   colHeaders: ['ID', 'First Name', 'Last Name'],
//   autoInsertRow: false,
//   fillHandle: false,
//   colHeaders: true,
//   minSpareRows: 1
//   },
//   //hot1;

// hot1 = new Handsontable(container1, settings1);
//  {{-- objectData[0].name = 'Ford';  change "Tesla" to "Ford" programmatically --}}
// hot1.render();

 var testA =[];
 var dats = [{ id:1, firstname: 'judeski', address: '26 oremerin' }]
var
  container = document.getElementById('example50'),
  hot6;

hot6 = new Handsontable(container, {
  data: testA,
  dataSchema: {id: null, firstname: null,  address: null, title: null, term_id:null, exam: null, test: null, benchmark: null, total: null},
  startRows: 5,
  startCols: 4,
  colHeaders: ['ID', 'First Name', 'Address', 'Subject', 'Term', 'Exam', 'CA', 'Benchmark', 'Total'],
  columns: [
    {data: 'id'},
    {data: 'firstname'},
    {data: 'address'},
    {data: 'title'},
    {data: 'term_id'},
    {data: 'exam'},
    {data: 'test'},
    {data: 'benchmark', readOnly: true},
    {data: 'total'},
  ],
  minSpareRows: 1
});


function submitRes(){
    testA = [...dats];
    hot6.destroy();
    new Handsontable(container, {
  data: testA,
  dataSchema: {id: null, firstname: null,  address: null, Subject: null, Term:null, Exam: null, CA: null, benchmark: null, total: null},
  startRows: 5,
  startCols: 4,
  colHeaders: ['ID', 'First Name', 'Address', 'Subject', 'Term', 'Exam', 'CA', 'Benchmark', 'Total'],
  columns: [
    {data: 'id'},
    {data: 'firstname'},
    {data: 'address'},
    {data: 'title'},
    {data: 'term_id'},
    {data: 'exam'},
    {data: 'test'},
    {data: 'benchmark'},
    {data: 'total'},
  ],
  minSpareRows: 1
});
    //hot6.render();
}


runAM = ()=>{
    //alert('helo');
}
var changedData = [];
$("#create_sheet").click(function (event) {
    //stop submit the form, we will post it manually.
    event.preventDefault();

    // Get form
    var form = $('#fileUploadForm')[0];
   // var token = "{{csrf_token()}}";
    // Create an FormData object 
    var data = new FormData(form);
    // If you want to add an extra field for the FormData
    // disabled the submit button
    //$("#btnSubmit").prop("disabled", true);
    $('#main-body').loading({
        message: 'Working...'
    });

    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "/testarray",
        data: data,
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, 
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: (data)=> {
           // $("#result").text(data);
           const response = data.data;
           $('#main-body').loading('stop');
            // console.log("SUCCESS : ", data);
            // if(response.title == 'success'){
            // swal("Success!", "Result sheet has been created!", "success");
           
            // //$("#btnSubmit").prop("disabled", false);

            // } else if(response.title == 'exist'){
            //     swal("Already exist!", "Result sheet already exist, delete the existing one if you intend creating a new one!", "warning");
               
            // }

                testA = [...response];
                //hot6.destroy();
                new Handsontable(container, {
            data: testA,
            dataSchema: {id: null, firstname: null, lastname:null,  address: null, title: null, term_id:null, exam: null, test: null, benchmark: null, total: null},
            startRows: 5,
            startCols: 4,
            observeChanges: true,
            colHeaders: ['ID', 'First Name', 'Lastname', 'Address', 'Subject', 'Term', 'Exam', 'CA', 'Benchmark', 'Total'],
            columns: [
                {data: 'id', readOnly: true},
                {data: 'firstname', readOnly: true},
                {data: 'lastname', readOnly: true},
                {data: 'address', readOnly: true},
                {data: 'title', readOnly: true},
                {data: 'term_id', readOnly: true},
                {data: 'exam', type: 'numeric'},
                {data: 'test', type: 'numeric'},
                {data: 'benchmark', readOnly: true},
                {data: 'total', readOnly: true},
            ],
            afterChange: (changes, source)=> {
               // alert(changes)
                window.changes = changes;
                console.log(changes);
                let changeArray = changes[0][0];
                const examRow = testA[changeArray].exam;
                const testRow = testA[changeArray].test;
                const cellId = testA[changeArray].id;
            //alert(testA[changeArray].total );
            testA[changeArray].total = parseInt(examRow) + parseInt(testRow);
           // alert(examRow);
           // alert(testRow);
            //testA = [...testA];
            //alert(testA[changeArray].test);
            //hot6.render();
            testFunction(cellId, testRow, examRow);
           },
            minSpareRows: 1
        });
        },
        error: function (e) {
            $('#main-body').loading('stop');
            // $("#result").text(e.responseText);
          //  $('#fileUploadForm')[0].reset()

            swal("Error!", "An error occured while adding user, please try again!", "error");
            //$("#fileUploadForm").get(0).reset();
            // console.log("ERROR : ", e);
            // $("#btnSubmit").prop("disabled", false);
        }
    });

  });

testFunction = (cellId, testRow, examRow) =>{

 if(changedData.length < 1){

    return  changedData.push({ id: cellId, testRow: testRow, examRow: examRow });
 } 
   let inArray = -1;
  for(var i =0; i < changedData.length; ++i){
     if(parseInt(cellId) == parseInt(changedData[i].id))
     inArray = i;
  }
if (inArray > -1) {
        changedData.splice(inArray, 1);
        changedData.push({ id: cellId, testRow: testRow, examRow: examRow });
       // hot6.render();
   } else {
        changedData.push({ id: cellId, testRow: testRow, examRow: examRow });
       // hot6.render();
   }

  alert(JSON.stringify(changedData));
}




 $('#submitResult').click(function(){
  
   if(changedData.length < 1){

     return   swal("Notice!", "No data has been editted or changed !", "warning");
   }
    $.confirm({
    title: 'Confirm!',
    content: "Are you sure you want to submit!",
    buttons: {
        confirm: function () {
            finallySubmitResult();
        },
        cancel: function () {
            $.alert('Canceled!');
        },
        // somethingElse: {
        //     text: 'Something else',
        //     btnClass: 'btn-blue',
        //     keys: ['enter', 'shift'],
        //     action: function(){
        //         $.alert('Something else?');
        //     }
        // }
    }
});
// swal({
//   title: "Are you sure?",
//   text: "Once deleted, you will not be able to recover this imaginary file!",
//   icon: "warning",
//   buttons: true,
//   dangerMode: true,
// })
// .then((willDelete) => {
//   if (willDelete) {
//     swal("Poof! Your imaginary file has been deleted!", {
//       icon: "success",
//     });
//   } else {
//     swal("Your imaginary file is safe!");
//   }
// });
 })


 finallySubmitResult = () =>{
    //stop submit the form, we will post it manually.
    event.preventDefault();

    // Get form
    var form = $('#fileUploadForm')[0];
   // var token = "{{csrf_token()}}";
    // Create an FormData object 
    var data = new FormData(form);
    // If you want to add an extra field for the FormData
    // disabled the submit button
    //$("#btnSubmit").prop("disabled", true);
    $('#main-body').loading({
        message: 'Working...'
    });

   jQuery.ajax({
   type: "POST", // Post / Get method
   url: "/submitResult", //Where form data is sent on submission
   dataType:"text", // Data type, HTML, json etc.
   data:{data: changedData,  "_token": "{{ csrf_token() }}"}, //Form variables
   success:function(response){
     var json=JSON.parse(response);
    // console.log(json);
    if(json.title == 'success'){
         changedData = [];
         swal("Success!", "Result has been added!", "success");
    } else {
        swal("Error!", "An error occured adding classroom!", "error");
    }

      $('#main-body').loading('stop');
    
   },
   error:function (xhr, ajaxOptions, thrownError){
      alert(thrownError);
      //$("#loading").hide();
      $('#main-body').loading('stop');
      swal("Error!", "An error occured adding classroom!", "error"); 
   }
 });
    // $.ajax({
    //     type: "POST",
    //     enctype: 'multipart/form-data',
    //     url: "/submitResult",
    //     data: {data: changedData},
    //     headers: {
    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }, 
    //     processData: false,
    //     contentType: false,
    //     cache: false,
    //     timeout: 600000,
    //     success: function (data) {
    //        // $("#result").text(data);
    //        //const response = data.data;
    //        $('#main-body').loading('stop');
    //         // console.log("SUCCESS : ", data);
    //         // if(response.title == 'success'){
    //         // swal("Success!", "Result sheet has been created!", "success");
           
    //         // //$("#btnSubmit").prop("disabled", false);

    //         // } else if(response.title == 'exist'){
    //         //     swal("Already exist!", "Result sheet already exist, delete the existing one if you intend creating a new one!", "warning");
               
    //         // }

    //             hot6.render();
    //     },
    //     error: function (e) {
    //         $('#main-body').loading('stop');
    //         // $("#result").text(e.responseText);
    //       //  $('#fileUploadForm')[0].reset()

    //         swal("Error!", "An error occured while adding user, please try again!", "error");
    //         //$("#fileUploadForm").get(0).reset();
    //         // console.log("ERROR : ", e);
    //         // $("#btnSubmit").prop("disabled", false);
    //     }
    // });

  };


</script>

@endsection