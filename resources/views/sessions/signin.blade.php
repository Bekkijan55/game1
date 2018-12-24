@extends('layout')

@section('gamecon')
<div class="signinback">
  <div class="container">
    <div class="col-md-6 col-md-offset-3">
    <div class="signin-block">
      <form action="{{route('attmplogin')}}" method = "post">
       {{csrf_field()}}
       <label for="email">Email</label>
       <input type="text" class="form-control" name = 'email'>
       <label for="password">Password</label>
       <input type="password" class="form-control" name = "password" >
       <br>
        <button class="btn btn-success">LogIn!</button> 
        <a href="{{route('home')}}">Registration</a>
      
      </form>
    </div> 
    </div>
  </div>
  </div>
@endsection

