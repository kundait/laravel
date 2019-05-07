@extends('layouts.app')

@section('content')
    <h1>Manage Users</h1>
    <hr>
        @if(count($users) > 0)
         
            <table class="table table-inverse">
            <thead>
                <tr>
                  <th>#</th>
                  <th>First Name</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{$users->counter++}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        @if($user->status == 1)
                            <td style="color:green">{{($user->status == 1 ? 'Active' : 'Inactive')}}</td>
                        @else
                            <td style="color:orangered">{{($user->status == 1 ? 'Active' : 'Inactive')}}</td>
                        @endif
                        <td><a href="/manage/{{$user->id}}">View/Modify</a></td>
                    </tr>    
                @endforeach
            </tbody>
            </table>
            {{$users->links()}}
        @else
            <p>No Users found</p>
        @endif
@endsection


