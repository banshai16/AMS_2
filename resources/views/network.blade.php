@extends('layout.app_dashboard')
@section('title','network')
@section('content')

{{-- the modal for updation --}}
<div class="modal fade" id="edit_network_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Network</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input hidden type="text" class="form-control" name="id" id="id">
            <form id="edit_network_form">
                @csrf
                @method('POST')
                <div class="row mb-3">
                <label for="Department_name" class="col-sm-2 col-form-label">Department Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="dept_name" id="edit_Department_name">
                </div>
                </div>
                <div class="row mb-3">
                <label for="address" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="address" id="edit_address">
                </div>
                </div>
                <div class="row mb-3">
                    <label for="bandwidth" class="col-sm-2 col-form-label">Bandwidth</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="bandwidth" id="edit_bandwidth">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="dept_nodal_person" class="col-sm-2 col-form-label">Department Nodal Person</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="dept_nodal_person" id="edit_dept_nodal_person">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="link_type_drop" class="col-sm-2 col-form-label">Link type</label>
                    <div class="col-sm-10">
                    <select class="form-control select_link-modal" name="link_type" id="link_type_drop_modal" >
                        <option value="" disabled selected>Select the link type</option>
                    </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="lease_line_drop" class="col-sm-2 col-form-label">Lease Line Provider</label>
                    <div class="col-sm-10">
                    <select class="form-control select_lease_line_modal" name="lease_line" id="lease_line_drop_modal">
                        <option value="" disabled selected>Select the lease line provider</option>
                   
                    </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="date_of_commission" class="col-sm-2 col-form-label">Date of Commission:</label>
                    <div class="col-sm-10">
                    <input type="date" class="form-control" name="date_of_commission" id="edit_date_of_commission" placeholder="none">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="no_of_segments" class="col-sm-2 col-form-label">No. of segments </label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="no_of_segments" id="edit_no_of_segments">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="vlan_id" class="col-sm-2 col-form-label">Vlan Id</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="vlan_id" id="edit_vlan_id">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="no_of_ip" class="col-sm-2 col-form-label">No. of IP</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="no_of_ip" id="edit_no_of_ip">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ip_range" class="col-sm-2 col-form-label">IP range</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="ip_range" id="edit_ip_range">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="longitude" class="col-sm-2 col-form-label">Longitude</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="longitude" id="edit_longitude">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="latitude" class="col-sm-2 col-form-label">Latitute</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="latitude" id="edit_latitude">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="router_model" class="col-sm-2 col-form-label">Router Model</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="router_model" id="edit_router_model">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ownership" class="col-sm-2 col-form-label">Ownership of Router</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="ownership_of_router" id="edit_ownership">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="update_network">Update</button>
                </div>
            </form>
        </div>
      </div>
    </div>
    </div>
  </div>
  
  {{-- end of the modal --}}

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
            <table class="table table-bordered table-striped" id="network_table">
                <thead>
                    <tr>
                        <th scope="col">Sl.no</th>
                        <th scope="col">Department</th>
                        <th scope="col">Address</th>
                        <th scope="col">Bandwidth</th>
                        <th scope="col">Link Type</th>
                        <th scope="col">Date of Commission</th>
                        <th scope="col">Longitude</th>
                        <th scope="col">Latitude</th>
                        <th scope="col">Lease line provider</th>
                        <th scope="col" colspan="3">Action</th>

                    </tr>
                </thead>
                <tbody class="table-group-divider" id="network_body">
                    
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade mb-5" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <!-- Profile form content -->
            <div class="section mt-5">
                <form id="network_form">
                    @csrf
                    <div class="row mb-3">
                    <label for="Department_name" class="col-sm-2 col-form-label">Department Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="dept_name" id="Department_name">
                    </div>
                    </div>
                    <div class="row mb-3">
                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="address" id="address">
                    </div>
                    </div>
                    <div class="row mb-3">
                        <label for="bandwidth" class="col-sm-2 col-form-label">Bandwidth</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="bandwidth" id="bandwidth">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="dept_nodal_person" class="col-sm-2 col-form-label">Department Nodal Person</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="dept_nodal_person" id="dept_nodal_person">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="link_type_drop" class="col-sm-2 col-form-label">Link type</label>
                        <div class="col-sm-10">
                        <select class="form-control select_link_main" name="link_type" id="link_type_drop">
                            <option value="" disabled selected>Select the link type</option>
                        </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="lease_line_drop" class="col-sm-2 col-form-label">Lease Line Provider</label>
                        <div class="col-sm-10">
                        <select class="form-control select_lease_line_main" name="lease_line" id="lease_line_drop">
                            <option value="" disabled selected>Select the lease line provider</option>
                       
                        </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="date_of_commission" class="col-sm-2 col-form-label">Date of Commission:</label>
                        <div class="col-sm-10">
                        <input type="date" class="form-control" name="date_of_commission" id="date_of_commission" placeholder="none">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="no_of_segments" class="col-sm-2 col-form-label">No. of segments </label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="no_of_segments" id="no_of_segments">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="vlan_id" class="col-sm-2 col-form-label">Vlan Id</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="vlan_id" id="vlan_id">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="no_of_ip" class="col-sm-2 col-form-label">No. of IP</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="no_of_ip" id="no_of_ip">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="ip_range" class="col-sm-2 col-form-label">IP range</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="ip_range" id="ip_range">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="longitude" class="col-sm-2 col-form-label">Longitude</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="longitude" id="longitude">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="latitude" class="col-sm-2 col-form-label">Latitute</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="latitude" id="latitude">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="router_model" class="col-sm-2 col-form-label">Router Model</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="router_model" id="router_model">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="ownership" class="col-sm-2 col-form-label">Ownership of Router</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="ownership_of_router" id="ownership">
                        </div>
                    </div>
                
                    <button type="submit" class="btn btn-primary" id="networkBtn">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection