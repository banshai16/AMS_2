@extends('layout.app')
@section('title','login')
@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title text-center">Login</h2>
            
            @if(session()->has("error"))
            <div class="alert alert-danger">{{session("error")}}</div>
            @endif
            <form method="POST" action="{{route('login')}}">
                @csrf
                @method('POST')
                <div class="mb-3 py-10">
                  <label for="email" class="form-label">Email address</label>
                  <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                </div>
                <div class="mb-3 py-10">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
      </div>
    
</div>
@endsection