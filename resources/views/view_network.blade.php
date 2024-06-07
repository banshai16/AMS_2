@extends('layout.app_dashboard')
@section('title','Network Information')
@section('content')

  <div class="spinner-container" id="spinner">
    <div class="d-flex justify-content-center">
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
  </div>

  <table class="table table-bordered" id="view_network_table">
    <thead>
      <tr>
        <th scope="col">Network Information</th>
        <th scope="col">Details</th>
      </tr>
    </thead>
    <tbody class="table-group-divider" id="view_network_body">
    
    </tbody>
</table>
@endsection