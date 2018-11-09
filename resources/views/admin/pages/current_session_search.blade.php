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
                            <div class="card-body">
                             <form method="POST" style="display:block;" action="/search_student"> 
                               {{ csrf_field() }}
                               <div class="row p-t-20">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                         <select name="session" readonly class="form-control">
                                            <option selected value="{{$getCurrentSession->id}}">{{$getCurrentSession->name}}</option>
                                         </select>
                                        </div>
                                    </div> 
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group has-danger">
                                                     <select name="classroom" class="form-control">
                                                         <option  value="">--- select classroom --</option>
                                                       @foreach($getClassroom as $classroom)
                                                            <option value="{{$classroom->id}}">{{$classroom->name}}</option>
                                                        @endforeach    
														</select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group has-danger">
                                                    <button type="submit" class="btn btn-success"> <i class="fa fa-search"></i> Search</button>
                                            </div>
                                            <!--/span-->
                                     </form>
                                    </div>
                                  <div class="table-responsive m-t-40">
                                  @if($currentClass)
                                    <h3>  {{$currentClass->name}}  </h3>
                                  @endif
                                    <table id="myTable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Passport</th>
                                                <th>Reg no</th>
                                                <th>Firstname</th>
                                                <th>Lastname</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th>State of Origin</th>
                                                <th>LGA</th>
                                                <th>Date of birth</th>
                                                <th> Actions</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                            <th>Id</th>
                                                <th>Passport</th>
                                                <th>Reg no</th>
                                                <th>Firstname</th>
                                                <th>Lastname</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th>State of Origin</th>
                                                <th>LGA</th>
                                                <th>Date of birth</th>
                                                <th> Actions</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                      @if(count($getStudent) > 0)      
                                        @foreach($getStudent as $student)
                                            <tr>
                                                <td>{{$student->id}}</td>
                                                <td><img src="/storage/{{$student->passport}}" width="80px" height="80px" ></td>
                                                <td>{{$student->reg_no}}</td>
                                                <td>{{$student->firstname}}</td>
                                                <td>{{$student->lastname}}</td>
                                                <td>{{$student->address}}</td>
                                                <td>{{$student->city}}</td>
                                                <td>{{$student->state_of_origin}}</td>
                                                <td>{{$student->lga}}</td>
                                                <td>{{$student->dob}}</td>
                                                <td>
                                                <div class="btn-group">
      
                                                <button type="button" value="{{$student->id}}" onclick="all_user(this.value)"  class="btn btn-success"><i class="fa fa-edit"></i></button>
                                                <button type="button" value="{{$student->id}}" onclick="confirmTrash(this.value)"  class="btn btn-danger"><i class="fa fa-trash"></i></button></form>
                     <!-- <button type="button" class="btn btn-primary"><i class="fa fa-eye"></i></button>-->
                                                 </div>
                                                </td>  
                                            </tr>
                                         @endforeach   
                                      @endif   
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
function confirmTrash(){



}
</script>


@endsection