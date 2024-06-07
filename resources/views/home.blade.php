@extends('layout.app_dashboard')
@section('title','dashboard')
@section('content')

<!-- Begin Page Content -->

{{-- Adding the modal here so that it shows the information  --}}
<div class="modal fade" id="show_network_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Network Information</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <div id="details"></div>
            <div id="additional_details" style="display: none;"></div>
            <button id="expand_button" class="btn btn-primary"><i class="fas fa-chevron-down"></i></button>
            <button id="collapse_button" class="btn btn-primary" style="display: none;"><i class="fas fa-chevron-up"></i></button>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            {{-- <button type="submit" class="btn btn-primary">Update</button> --}}
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
    {{-- Adding the spinner --}}
    <div class="spinner-container" id="spinner">
    <div class="d-flex justify-content-center">
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
  </div>
  {{-- spinner ends here --}}

  {{-- Starting of the page starts from here --}}
<div class="row">
    <div class="col-md-4">
      <div class="info-box">
        <i class="fas fa-users"></i>
        <span class="info-text">Users: {{ $usercount}}</span>
      </div>
    </div>
    <div class="col-md-4">
      <div class="info-box">
        <i class="fas fa-user-shield"></i>
        <span class="info-text">Admins: 10</span>
      </div>
    </div>
    <div class="col-md-4">
      <div class="info-box">
        <i class="fas fa-user-tie"></i>
        <span class="info-text">Employees: 50</span>
      </div>
    </div>
  </div>
  <div id="map" style="height: 550px;">
    <div id="map_name">Meghalaya</div>
  </div>
@endsection