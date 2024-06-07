@extends('layout.app')
@section('title','registration')
@section('content')
<div class="container mt-5" >
    <div class="card" id="register">
        <div class="card-body">
            <h2 class="card-title text-center">Registration</h2>
            <form method="POST" action="{{route('registration.post')}}">
                @csrf
                <div class="mb-3 py-10">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="name">
                </div>
                <div class="mb-3 py-10">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                  </div>
                <div class="mb-3 py-10">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
      </div>
    
</div>
@endsection