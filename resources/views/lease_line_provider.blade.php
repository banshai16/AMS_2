@extends('layout.app_dashboard')
@section('title','link type')
@section('content')
{{-- The modal starts from here --}}
<div class="modal fade" id="edit_lease_line_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Lease Line Provider</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input hidden type="text" class="form-control" name="id" id="id">
            <form id="edit_lease_line_form">
                @csrf
                @method('POST')
                <div class="row mb-3">
                <label for="edit_lease_line" class="col-sm-2 col-form-label">Lease Line Provider</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="lease_line_provider" id="edit_lease_line">
                </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="update_lease_line">Update</button>
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
          <table class="table table-bordered table-striped" id="lease_line_table">
            <thead>
              <tr>
                <th scope="col" >Id</th>
                <th scope="col">Lease Line Provider</th>
                <th colspan="2">Action</th>

              </tr>
            </thead>
            <tbody class="table-group-divider" id="lease_line_body">
              
            </tbody>
          </table>
          <div id="pagination-info">

          </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <div class="section mt-3">
            <form id="lease_line_form">
            @csrf
              <div class="row mb-3">
                <label for="lease_line" class="col-sm-2 col-form-label">Lease Line Provider</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="lease_line_provider" id="lease_line">
                </div>
              </div>
              <button type="submit" class="btn btn-primary" id="lease_line_button">Submit</button>
            </form>
        </div>
      </div>
</div>

@endsection