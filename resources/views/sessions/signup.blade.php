@extends('layout')

@section('gamecon')
<div class = "signupback">
 <div class="container">
   <div class="col-md-6 col-md-offset-3">
     <div class="form-block">   
      <h2>Registrtion</h2>
       <form action="{{route('register')}}" method="post">
          <label for="name">Name</label>
          <input type="text" name = "first_name" class="form-control">
          <label for="email">Email</label>
          <input type="text" class="form-control" name = "email" >
          <label for="password">Password</label>
          <input type="password" class="form-control" name = "password">
          <label for="password_confirmation">Confirm Password</label>
          <input type="password" class="form-control" name = "password_confirmation" >
          {{csrf_field()}}
           <br>
          <div>
          <button class="btn btn-primary" type="submit">Register</button> &nbsp
          <a href="{{route('login')}}">Has Account!</a>
          </div>
       </form>
      </div>
   </div>
 </div>
 </div>
@endsection
