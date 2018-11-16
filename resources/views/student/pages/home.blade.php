            
@extends('layouts.master')

     @section('content')        
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-lg-12">
                        <div id="invoice" class="effect2">
                            <div id="invoice-top">
                                <div class="invoice-logo"></div>
                                <div class="invoice-info">
                                    <h2>{{$getUser->firstname}} {{$getUser->lastname}}</h2>
                                    <p> {{ $getUser->address }} <br> {{$getUser->middlename}}
                                    </p>
                                </div>
                                <!--End Info-->
                                <div class="title">
                                    <h4>{{$getUser->city}}</h4>
                                    <p>{{$getUser->state_of_origin}}<br> {{$getUser->lga}}
                                    </p>
                                </div>
                                <!--End Title-->
                            </div>
                            <!--End InvoiceTop-->


                            <div id="invoice-mid">

                                <div class="clientlogo"></div>
                                <div class="invoice-info">
                                    <h2>{{$getUser->city}}</h2>
                                    <p>{{$getUser->state_of_origin}}<br> {{$getUser->lga}}
                                        <br>
                                </div>

                                <div id="project">
                                    <h2>Result Template</h2>
                                    <p>Proin cursus, dui non tincidunt elementum, tortor ex feugiat enim, at elementum enim quam vel purus. Curabitur semper malesuada urna ut suscipit.</p>
                                </div>

                            </div>
                            <!--End Invoice Mid-->


                            <div id="invoice-bot">
                                <div id="invoice-table">
                                    <div class="table-responsive">
                                    <table class="table">
                                            <tr class="tabletitle">
                                            <td class="table-item">
                                                    <h2>Id</h2>
                                                </td>
                                                <td class="table-item">
                                                    <h2>Classroom</h2>
                                                </td>
                                                <td class="table-item">
                                                    <h2>Session</h2>
                                                </td>
                                                <td class="table-item">
                                                    <h2>Term</h2>
                                                </td>
                                                <td class="table-item">
                                                    <h2>Released</h2>
                                                </td>
                                                <td class="table-item">
                                                    <h2>Action</h2>
                                                </td>
                                            </tr>
                                         @foreach($getCummulative as $cummulative)
                                            <tr class="service">
                                               <td>{{$cummulative->id}}
                                                <td class="tableitem">
                                                    <p class="itemtext">{{$cummulative->classroom->name}}</p>
                                                </td>
                                                <td class="tableitem">
                                                    <p class="itemtext">{{$cummulative->session->name}}</p>
                                                </td>
                                                <td class="tableitem">
                                                    <p class="itemtext">{{$cummulative->term->name}}</p>
                                                </td>
                                                <td class="tableitem">
                                                 @if($cummulative->released == 'false')
                                                    <p style="color:red">Not yet released</p>
                                                 @else 
                                                  <p style="color:green">Released</p>
                                                 @endif   
                                                </td>
                                                <td class="tableitem">
                                                @if($cummulative->released == "true" && $cummulative->checked == "false")
                                                <form id="pinE">
                                                    <button id="enterPin{{$cummulative->id}}" type="button" value="{{$cummulative->id}}" class="btn btn-primary" >Enter pin <button>
                                                <form>    
                                                @elseif($cummulative->released == "true" && $cummulative->checked == "true")
                                                <button type="button" id="rel{{$cummulative->id}}" value="{{$cummulative->id}}" class="btn btn-success" >View Result <button>
                                                @elseif($cummulative->released == "false" && $cummulative->checked == "false")
                                                <p style="color:red">Not yet available </p>
                                                @endif
                                              </td>
                                            </tr>
                                          @endforeach
                                            <!-- <tr class="tabletitle">
                                                <td></td>
                                                <td></td>
                                                <td class="Rate">
                                                    <h2>Total</h2>
                                                </td>
                                                <td class="payment">
                                                    <h2>$3,644.25</h2>
                                                </td>
                                            </tr> -->
                                        </table>
                                    </div>
                                </div>
                                <!--End Table-->

                                <form action="#" method="post" target="_top" class="m-t-15">
                                    <input type="image" src="images/paypal.png" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                </form>


                                <div id="legalcopy">
                                    <p class="legal"><strong>Thank you for your business!</strong> Payment is expected within 31 days; please process this invoice within that time. There will be a 5% interest charge per month on late invoices.
                                    </p>
                                </div>

                            </div>
                            <!--End InvoiceBot-->
                        </div>
                        <!--End Invoice-->
                    </div>
                </div>
                <!-- End PAge Content -->
            </div>
         @endsection   
            <!-- End Container fluid  -->
@section('javascript')
<script>

$('#pinE').click(function(event){
  
})
$('#pinE').click(function(event){
var cummulativeId = event.target.value;
$.confirm({
title: 'Add Session!',
content: '' +
'<form action="" class="formName">' +
'<div class="form-group">' +
'<label>Title</label>' +
'<input type="text" placeholder="Enter Pin code" id="pincode" class="titl form-control" required />' +
'</div>' +
'</div>' +
'</form>',
buttons: {
    formSubmit: {
        text: 'Submit',
        btnClass: 'btn-blue',
        action:  ()=> {
            var title = $('#pincode').val();
             confirmCheckPin(title, cummulativeId);
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


function confirmCheckPin(title, cummulativeId){
    $.confirm({
    title: 'Confirm!',
    content: 'Are you sure you want to submit!',
    buttons: {
        confirm: function () {
            finallySubmitPin(title, cummulativeId);
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
}


function finallySubmitPin(title, cummulativeId){

    $('#main-body').loading({
        message: 'Working...'
    });
   jQuery.ajax({
   type: "POST", // Post / Get method
   url: "/check_pin", //Where form data is sent on submission
   dataType:"text", // Data type, HTML, json etc.
   data:{pin: title, cummulative_id: cummulativeId, "_token": "{{ csrf_token() }}"}, //Form variables
   success:function(response){
    var json= JSON.parse(response);
    if(json.title == "success"){
        console.log(response);
        $.confirm({
            title: '<div style="color:green">Success!</div>',
            content: 'Pin was successfully validated',
            buttons: {
                ok: function () {
                    window.location = "/getPdf/" + json.data.session_id + '/' + json.data.classroom_id + '/' +  json.data.term_id;
                },
            }
        });
    } else {
        swal("Error!", "An error occured validating pin, please try again later!", "error");
    }
    $('#main-body').loading('stop');
   },
   error:function (xhr, ajaxOptions, thrownError){
      alert(thrownError);
      //$("#loading").hide(); 
      $('#main-body').loading('stop');
   }
 });
}


</script>
@endsection