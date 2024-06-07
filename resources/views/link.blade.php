@extends('layout.app_dashboard')
@section('title','link type')
@section('content')
{{-- This is the tab functionality --}}

{{-- The modal starts from here --}}
<div class="modal fade" id="edit_link_type_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Link Type</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input hidden type="text" class="form-control" name="id" id="id">
            <form id="edit_link_type_form">
                @csrf
                @method('POST')
                <div class="row mb-3">
                <label for="edit_link_type" class="col-sm-2 col-form-label">Link Type</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="link_type" id="edit_link_type">
                </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="update_link_type">Update</button>
                </div>
              </form>
        </div>
      </div>
    </div>
    </div>
  </div>
  {{-- The modal ends here --}}

<div class="container mt-5">
  <div class="col-md-4">
    <div class="input-group mb-3"> <!-- Added mb-3 class for margin bottom -->
      <input type="text" class="form-control input-text" placeholder="Enter your search...">
      <div class="input-group-append">
        <button class="btn btn-primary" type="button">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  </div>   
  <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Add 
          </a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <!-- Home form content -->
          <table class="table table-bordered table-striped" id="link_table">
            <thead>
              <tr>
                <th scope="col" >Id</th>
                <th scope="col">Link Type</th>
                <th colspan="2">Action</th>

              </tr>
            </thead>
            <tbody class="table-group-divider" id="link_body">
              
            </tbody>
          </table>
          <div id="pagination-info">

          </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <div class="section mt-3">
            <form id="link_form">
              <div class="row mb-3">
                <label for="link_type" class="col-sm-2 col-form-label">Link Type</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="link_type" id="link_type">
                </div>
              </div>
              <button type="submit" class="btn btn-primary" id="linkBtn">Submit</button>
            </form>
        </div>
      </div>
</div>

@endsection