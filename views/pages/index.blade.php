@extends('layouts.app')

@section('content')
    <div class='jumbotron text-center'>
        <h1>Welcome</h1>
        @component('components.who')       
      @endcomponent
        <p>{{$message}}</p>
         @if($message == false )
        <!--<p><a class='btn btn-primary btn-lg' href='/login' role='button'>Login</a> <a class='btn btn-success btn-lg' href='/register' role='button'>Register</a></p>
         <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>  -->
         @endif
    </div>
@endsection
