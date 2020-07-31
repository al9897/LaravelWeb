@extends('layouts.master')

@section('title',$title)

@section('content')
    <div class="container">
        @if(Auth::user()->isAdmin==1)
            <div class="row">
                <h3 class="font-weight-bold ml-3">Users Table
                </h3>
                <a href="#deleteProductModal" class="ml-3 h3 text-danger" data-toggle="modal" data-target="#deleteProductModal"><i class="fas fa-minus-circle"></i></a>
                <div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="deleteProductModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteUserModal">Delete a user</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="get" action="{{url('/users/deleteuser')}}">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="deleteUserID">User ID</label>
                                        <input class="form-control" type="text" name="deleteUserID" placeholder="ID of user to delete">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-9 col-sm-12">
                    <table class="table">
                        <thead class="thead text-white bg-primary font-weight-bold">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Admin Role</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)

                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>     
                            <td>
                                @if($user->isAdmin==1)
                                    <a href="{{url('/users/lockAdmin/'.$user->id)}}" style="color:blue"><i class="fas fa-unlock"></i></a>
                                @else
                                    <a href="{{url('/users/unlockAdmin/'.$user->id)}}" style="color:red"><i class="fas fa-lock"></i></a>
                                    @endif
                            </td>

                        </tr>

                        @endforeach
                        <th><a href=" {{url('/download')}}" class="btn btn-danger ">Export all users</a>  </th>
                        
                        </tbody>
                        
                    </table>
                </div>
                
  
                    

                
            </div>

        @endif
    </div>
@endsection
