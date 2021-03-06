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
                        <form method="POST" target="votar" name="fileUploadForm" id="fileUploadForm" style="display:block;"> 
                               <div class="row p-t-20">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                         <select id="session" name="session" class="form-control">
                                          @foreach($session as $sess)
                                            <option selected value="{{$sess->id}}">{{$sess->name}}</option>
                                         @endforeach   
                                         </select>
                                        </div>
                                    </div> 
                                            <!--/span-->
                                    <div class="col-md-2">
                                        <div class="form-group has-danger">
                                                <select id="classroom" name="classroom" class="form-control">
                                                    <option  value="">--- select classroom --</option>
                                                    @foreach($classroom as $class)
                                                    <option selected value="{{$class->id}}">{{$class->name}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group has-danger">
                                                <select id="term" name="term" class="form-control">
                                                    <option  value="">--- select term --</option>
                                                    @foreach($term as $ter)
                                                    <option selected value="{{$ter->id}}">{{$ter->name}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group has-danger">
                                          <input type="number" name="benchmark" id="benchmark" class="form-control" placeholder="Enter benchmark" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
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
                                <h4 class="card-title">Data Export</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
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

var
 objectData = [
    {id: 1, name: 'Ted Right', address: ''},
    {id: 2, name: 'Frank Honest', address: ''},
    {id: 3, name: 'Joan Well', address: ''},
    {id: 4, name: 'Gail Polite', address: ''},
    {id: 5, name: 'Michael Fair', address: ''},
  ],
  container1 = document.getElementById('example50'),
  settings1 = {
  data: objectData,
  fixedRowsTop: 2,
  fixedColumnsLeft: 2,
  colWidths: 100,
  autoInsertRow: false,
  fillHandle: false,
  colHeaders: true,
  minSpareRows: 1
  },
  //hot1;

hot1 = new Handsontable(container1, settings1);
 {{-- objectData[0].name = 'Ford';  change "Tesla" to "Ford" programmatically --}}
hot1.render();


function submitRes(){
    alert(JSON.stringify(objectData));
}

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
        url: "/create_sheet",
        data: data,
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, 
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function (data) {
           // $("#result").text(data);
           const response = data;
            console.log("SUCCESS : ", data);
            if(response.title == 'success'){
            swal("Success!", "Result sheet has been created!", "success");
           
            //$("#btnSubmit").prop("disabled", false);

            } else if(response.title == 'exist'){
                swal("Already exist!", "Result sheet already exist, delete the existing one if you intend creating a new one!", "warning");
               
            }

             $('#main-body').loading('stop');
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

</script>

@endsection