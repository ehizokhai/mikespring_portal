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
                    <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Student registeration</h4>
                            </div>
                            <div class="card-body">
                            <iframe name="votar" style="display:none;"></iframe>
                                <form id="fileUploadForm" action="/regist" target="votar" name="fileUploadForm" method="POST"  enctype = "multipart/form-data">
                                {{csrf_field()}}
                                    <div class="form-body">
                                        <h3 class="card-title m-t-15">Person Info</h3>
                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-4">
                                                <div class="form-group {{ $errors->has('firstname') ? ' has-error' : '' }}">
                                                    <label class="control-label">First Name</label>
                                                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="John doe" required>
                                                    <!-- <small class="form-control-feedback"> This is inline help </small>  -->
                                                    </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group {{ $errors->has('lastname') ? ' has-error' : '' }}">
                                                    <label class="control-label">Last Name</label>
                                                    <input type="text"  name="lastname" id="lastname" class="form-control form-control-danger" placeholder="12n" required>
                                                    <!-- <small class="form-control-feedback"> This field has error. </small>  -->
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Middle Name</label>
                                                    <input type="text"   name="middlename" id="middlename" class="form-control form-control-danger" placeholder="12n">
                                                    <!-- <small class="form-control-feedback"> This field has error. </small>  -->
                                                    </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->                                  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
                                                    <label class="control-label">Gender</label>
                                                    <select id="gender" name="gender" class="form-control" required>
                                                        <option></option>
                                                        <option value="male">male</option>
                                                        <option value="female">female</option>
                                                    </select>
                                                    <!-- <small class="form-control-feedback"> Select your gender </small>  -->
                                                </div>
                                            </div>
                                            <!--/span-->

                                            <div class="col-md-4">
                                                <div class="form-group {{ $errors->has('dob') ? ' has-error' : '' }}">
                                                    <label class="control-label">Date of Birth</label>
                                                    <input id="dob" type="date"  name="dob" class="form-control" placeholder="dd/mm/yyyy" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group {{ $errors->has('dob') ? ' has-error' : '' }}">
                                                    <label class="control-label"> Email</label>
                                                    <input id="email" type="text" name="email" class="form-control" placeholder="Enter Email">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group {{ $errors->has('role') ? ' has-error' : '' }}">
                                                    <label class="control-label">Role</label>
                                                    <select id="role_id" name="role_id" class="form-control" data-placeholder="Choose a role" tabindex="1" required>
                                                    <option value=""></option>
                                                   @foreach($roles as $role)
                                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                                    <label>Address</label>
                                                    <input  name="address" id="address" type="text" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group {{ $errors->has('lga') ? ' has-error' : '' }}">
                                                    <label>LGA</label>
                                                    <input  name="lga" id="lga" type="text" class="form-control" required>
                                                </div>
                                            </div>                                            
                                            <!--/span-->
                                            <!-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Membership</label>
                                                    <div class="form-check">
                                                        <label class="custom-control custom-radio">
                                                            <input id="radio1" name="radio" type="radio" checked class="custom-control-input">
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description">Free</span>
                                                        </label>
                                                        <label class="custom-control custom-radio">
                                                            <input id="radio2" name="radio" type="radio" class="custom-control-input">
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description">Paid</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <!-- <h3 class="box-title m-t-40">Address</h3>
                                        <hr>
                                        <div class="row" >
                                            <div class="col-md-12 ">
                                                <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                                    <label>Address</label>
                                                    <input name="address" id="address" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
                                                    <label>City</label>
                                                    <input value="{{ old('city') }}" type="text" name="city" id="city" class="form-control" required>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('state_of_origin') ? ' has-error' : '' }}">
                                                    <label>State</label>
                                                    <input value="{{ old('state_of_origin') }}" type="text" name="state_of_origin" id="state_of_origin"  class="form-control" required>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                                    <label>Password</label>
                                                    <input type="password" name="password" id="password" class="form-control" required>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                                    <label>Confirm Password</label>
                                                    <input type="password" name="password_confirmation" id="password_confirmation"  class="form-control">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                         <div class="col-md-4">
                                                <div class="form-group">
                                                  <img id="blah" src="#" alt="your image" />  
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Passport</label>
                                                    <input type='file' name="photo" id="photo" onchange="readURL(this);" /> 
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group {{ $errors->has('country') ? ' has-error' : '' }}">
                                                    <label>Country</label>
                                                    <select name="country" id="country" class="form-control custom-select">
                                                        <option></option>
                                                        <option>Nigeria</option>
                                                        <!-- <option>Ghana</option>
                                                        <option>Coted</option> -->
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group {{ $errors->has('session') ? ' has-error' : '' }}">
                                                    <label>Session</label>
                                                    <select name="session" id="session" class="form-control custom-select">
                                                        <option></option>
                                                      @foreach($getSession as $session)  
                                                        <option value="{{$session->id}}">{{$session->name}}</option>
                                                      @endforeach  
                                                    </select>
                                                </div>
                                            </div> 
                                            <div class="col-md-4">
                                                <div class="form-group {{ $errors->has('classroom') ? ' has-error' : '' }}">
                                                    <label>Classroom</label>
                                                    <select name="classroom" id="classroom" class="form-control custom-select">
                                                        <option></option>
                                                      @foreach($getClassroom as $classroom)  
                                                        <option value="{{$classroom->id}}">{{$classroom->name}}</option>
                                                      @endforeach  
                                                    </select>
                                                </div>
                                            </div>                                                                         
                                            <!--/span-->
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" id="btnSubmit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                        <button type="button" class="btn btn-inverse">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End PAge Content -->
</div>
            <!-- End Container fluid  -->
            <!-- footer -->
@endsection


@section('javascript')
<script>
function readURL(input) {
        $('#blah').show();
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

 $('#blah').hide();
 
$(document).ready(function () {

$("#btnSubmit").click(function (event) {
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
        url: "/regist",
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
            swal("Success!", "User has been added!", "success");
            $('#main-body').loading('stop');
            $("#fileUploadForm").get(0).reset();
            //$("#btnSubmit").prop("disabled", false);
            $('#blah').hide();
            validateForm('#fileUploadForm');
            } else {
                swal("Error!", "Could not add user!", "error");
               
            }
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

});


$('#fileUploadForm').on('blur keyup change', 'input', function(event) {
  validateForm('#fileUploadForm');
});

function validateForm(id) {
  var valid = $(id).validate({
      rules: {
        firstName: {
          required: true,
          minlength: 2,
        },
        lastname: {
          required: true,
          minlength: 2,
          maxlength: 20
        }, 
        middlename: {
          required: false,
          minlength: 2,
          maxlength: 20
        },                  
         email: {
          required: false,
          minlength: 2,
          email: true,
          maxlength: 100,
        }, 
        gender: {
          required: true,
        },          
        photo:{
                required: true,
            },   
        dob: {
          required: true,
          minlength: 6,
        },

        role_id: {
          required: true,
        },
        phone: {
          required: true,
          maxlength: 11,
        },
        address: {
          required: true,
          minlength: 6,
        },
       lga: {
          required: true,
        },
        city: {
          required: true,
        },
        state: {
          required: true,
        },
        state_of_origin: {
          required: true,
        },
        country: {
          required: true,
        },
        session: {
          required: true,
        },
        password: {
          required: true,
          minlength: 6,
        },
        classroom: {
          required: true,
        },
        password_confirmation:{
            required: true,
            equalTo: "#password",
        },                                     
      },                                                                                                                                                                                                  
      errorElement: "span",
      errorClass: "errormsg",
    }).checkForm();
    if ($('#fileUploadForm').valid()) {
        // $('#btnSubmit').prop('disabled', false);
        // $('#btnSubmit').removeClass('isDisabled');
    } else {
    //    $('#btnSubmit').prop('disabled', 'disabled');
    //   $('#btnSubmit').addClass('isDisabled');
    }
}

// Run once, so subsequent input will be show error message upon validation
validateForm('#fileUploadForm');


</script>
@endsection