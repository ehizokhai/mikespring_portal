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
                           <button class="btn btn-primary xm" id="enterClassroom"> Add Classroom</button>
                          </div>
                            <div class="card-body">
                                <h4 class="card-title">Data Export</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Alias</th>
                                                <th>School Category</th>
                                                <th> Actions</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Alias</th>
                                                <th>School Category</th>
                                                <th> Actions</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        @foreach($getClassroom as $classroom)
                                            <tr>
                                                <td>{{$classroom->id}}</td>
                                                <td>{{$classroom->name}}</td>
                                                <td>{{$classroom->alias}}</td>
                                                <td>{{$classroom->schoolCategory}}</td>
                                                <td>
                                                <div class="btn-group">
      
                                                <button type="button" value="{{$classroom->id}}" onclick="all_user(this.value)"  class="btn btn-success"><i class="fa fa-edit"></i></button>
                                                <button type="button" value="{{$classroom->id}}" onclick="confirmTrash(this.value)"  class="btn btn-danger"><i class="fa fa-trash"></i></button></form>
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
