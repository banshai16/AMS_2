
$(document).ready(function()
{

  $.ajaxSetup(
  {
    headers:
    {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });

  //toggle of the sidebar
  $('#sidebarToggle').click(function()
  {
    $('#sidebar').toggleClass('active');
    $('.content').toggleClass('sidebar-active');
  });

  //displaying the links
  fetch_network_to_table();
  fetch_lease_line_to_table();
  fetch_link_to_select();
  fetch_lease_to_select();

  let cachedLinkOptions = '';
  let cachedLeaseOptions = '';

  // Pre-fetch link and lease options and cache them
  fetch_link_to_select_modal(function(options) {
    cachedLinkOptions = options;
  });

  fetch_lease_to_select_modal(function(options) {
    cachedLeaseOptions = options;
  });
            
  // Use URLSearchParams to get the page number from the URL
  var urlParams_lt = new URLSearchParams(window.location.search);
  var initialPage_lt = urlParams_lt.get('page') ? parseInt(urlParams_lt.get('page')) : 1;
  function fetch_link_to_table(page = 1, replaceHistory = false)
  {
    $.ajax(
    {
      url: 'link_fetch', // URL of your controller method to fetch links
      type: 'GET',
      data: { page: page },
      dataType: 'json',
      success: function(response) 
      {
        var tableBody = $('#link_body');
        tableBody.empty(); // Clear existing table data
        var rowid = (page - 1) * 5 + 1; // Calculate the correct starting row ID based on the current page and perPage value

        $.each(response.links, function(_, item) 
        {
          var row = $('<tr>');
          // Build table row using item properties
          row.append('<th scope="row" style="display: none;">' + item.id + '</th>');
          row.append('<td>' + rowid + '</td>');
          row.append('<td>' + item.link_type + '</td>');
          row.append('<td><button type="submit" class="edit_link_type btn btn-info" value="' + item.id + '">Update</button></td>');
          row.append('<td><button type="button" class=" delete_link btn btn-danger" value="' + item.id + '">Delete</button></td>');
          tableBody.append(row);
          rowid++;
        });
        $('#pagination-info').html('Page ' + response.current_page + ' of ' + Math.ceil(response.total / 5) +  '<br><br>' + response.pagination_links);

        // Update the URL without reloading the page
        var newUrl = window.location.pathname + (page > 1 ? '?page=' + page : '');
        if (replaceHistory) {
            window.history.replaceState({page: page}, '', newUrl);
        } else {
            window.history.pushState({page: page}, '', newUrl);
        }

      },
      error: function(xhr, status, error) 
      {
        console.error('Error fetching links:', error);
      }
    });

    
  }
  fetch_link_to_table(initialPage_lt, true);
  $(document).on('click', '.pagination a', function(event) 
  {
    event.preventDefault(); // Prevent default link behavior
    var pageUrl = $(this).attr('href'); // Get the URL of the clicked page link
    var url = new URL(pageUrl);
    var pageNumber = url.searchParams.get('page'); // Extract the page number from the URL

      // Fetch data for the new page
    fetch_link_to_table(pageNumber);
  });

  // Handle back and forward button navigation
  window.addEventListener('popstate', function(event) 
  {
    event.preventDefault();
   if (event.state && event.state.page) 
   {
      var previousPage = event.state.page;

      fetch_link_to_table(previousPage, true);

    } 
    else 
    {
      fetch_link_to_table(1 , true);
    }
  });

  //This is for displaying the lease_line_provider to the table
  var urlParams_ll = new URLSearchParams(window.location.search);
  var initialPage_ll = urlParams_ll.get('page') ? parseInt(urlParams_ll.get('page')) : 1;
  function fetch_lease_line_to_table(page = 1, replaceHistory = false)
  {
    $.ajax(
    {
      url: 'get_lease_line',
      type: 'GET',
      data: {
        page: page,
      },
      dataType: 'json',
      success: function(response)
      {
        if(response)
        {
          var tableBody = $('#lease_line_body');
          tableBody.empty();
          var rowid = (page - 1) * 5 + 1;
          $.each(response.ll, function(_,item)
          {
             var row = $('<tr>');
            // Build table row using item properties
            row.append('<th scope="row" style="display: none;">' + item.id + '</th>');
            row.append('<td>' + rowid + '</td>');
            row.append('<td>' + item.lease_line_provider + '</td>');
            row.append('<td><button type="submit" class="edit_lease_line btn btn-info" value="' + item.id + '">Update</button></td>');
            row.append('<td><button type="button" class="delete_lease_line btn btn-danger" value="' + item.id + '">Delete</button></td>');
            tableBody.append(row);
            rowid++;
          })
        }

        $('#pagination-info').html('Page ' + response.current_page + ' of ' + Math.ceil(response.total / 5) +  '<br><br>' + response.pagination_links);

        // Update the URL without reloading the page
        var newUrl = window.location.pathname + (page > 1 ? '?page=' + page : '');
        if (replaceHistory) {
            window.history.replaceState({page: page}, '', newUrl);
        } else {
            window.history.pushState({page: page}, '', newUrl);
        }
      },
      error: function(response)
      {
        console.log('error');
      }
    });
    
  }

  fetch_lease_line_to_table(initialPage_ll,true);
  $(document).on('click', '.pagination a', function(event) 
  {
    event.preventDefault(); // Prevent default link behavior
    var pageUrl = $(this).attr('href'); // Get the URL of the clicked page link
    var url = new URL(pageUrl);
    var pageNumber = url.searchParams.get('page'); // Extract the page number from the URL

      // Fetch data for the new page
    fetch_lease_line_to_table(pageNumber);
  });

  // Handle back and forward button navigation
  window.addEventListener('popstate', function(event) 
  {
    event.preventDefault();
   if (event.state && event.state.page) 
   {
      var previousPage = event.state.page;

      fetch_lease_line_to_table(previousPage, true);

    } 
    else 
    {
      fetch_lease_line_to_table(1 , true);
    }
  });

  


  //This is for the displaying of the network to the table
  function fetch_network_to_table()
  {
    $.ajax(
    {
      url: 'network_fetch', // URL of your controller method to fetch links
      type: 'GET',
      dataType: 'json',
      success: function(response) 
      {
        var rowid = 1;
        $.each(response.network, function(_, item)//display the value from the database
        {
          $('#network_body').append('<tr>\
          <th scope="row" style="display: none;">' + item.id + '</th>\
          <td>' + rowid + '</td>\
          <td>' + item.dept_name + '</td>\
          <td>' + item.address + '</td>\
          <td>' + item.bandwidth + '</td>\
          <td>' + item.link_type + '</td>\
          <td>' + item.date_of_commissioning + '</td>\
          <td>' + item.longitude + '</td>\
          <td>' + item.latitude + '</td>\
          <td>' + item.lease_line_provider + '</td>\
          <td><button type="submit" class="view_network btn btn-info" value="'+item.id+'"><i class="fas fa-eye"></i></button></td>\
          <td><button type="submit" class="edit_network btn btn-info" value="'+item.id+'">Update</button></td>\
          <td><button type="button" class="delete_network btn btn-danger" value="'+item.id+'">Delete</button></td>\
          </tr>');

          rowid++;
        });
      },
      error: function(xhr, status, error) 
      {
        console.error('Error fetching links:', error);
      }
    });
  }
   //This is for the link type and the link type drop down lists
  function fetch_link_to_select()
  {
    $.ajax(
    {
      url: 'fetch_link_type', // URL of your controller method to fetch links
      type: 'GET',
      dataType: 'json',
      success: function(response) 
      {
        $.each(response.link, function(_, item)
        {//display the value from the database
          $('#link_type_drop').append('<option value="'+item.link_type+'">'+item.link_type+'</option>');
        });
      },
      error: function(xhr, status, error) 
      {
        console.error('Error fetching links:', error);
      }
    });
  }

  //This is for the lease line and the lease line drop down lists
  function fetch_lease_to_select()
  {
    $.ajax(
    {
      url: 'fetch_lease_line', // URL of your controller method to fetch links
      type: 'GET',
      dataType: 'json',
      success: function(response)
      {
        $.each(response.lease, function(_, item)
        {//display the value from the database
          $('#lease_line_drop').append('<option value="'+item.lease_line_provider+'">'+item.lease_line_provider+'</option>');
        });
      },
      error: function(xhr, status, error) 
      {
        console.error('Error fetching links:', error);
      }
    });
  }   

  //This is the lease line provider form submission
  $('#lease_line_button').on('click',function(e)
  {
    e.preventDefault();
    var lease_line = $('#lease_line').val();
    $.ajax(
    {
      url: 'lease_line_store',
      type: 'POST',
      data: {'lease_line_provider': lease_line},
      success: function(response)
      {
        if(response)
        {
          // Refresh the page and then redirect after a delay
          setTimeout(function()
          {
            location.reload();
            window.location.href = "lease_line_provider_view"; // Replace with the URL you want to redirect to
          }, 2000); // 2000 milliseconds = 2 seconds
          swal("Success!!", response.success, "success");
  
        }
      },
      error:function(xhr, status, error)
      {
        if(xhr.status===422)
        {
          // Extract the validation errors from the response JSON
          var errors = xhr.responseJSON.errors;

          // Display the first error message for each field
          $.each(errors, function(field, messages)
          {
            swal("Error!", messages[0], "error");
          });
        }
        else
        {
          // Display a generic error message
          swal("Oops!", "An unexpected error occurred. Please try again later.", "error");
        }
      }
      
    });
    
  });
 

  //This is the network form submission
  $('#networkBtn').click(function(e)
  {
    try
    {
      e.preventDefault();
      var form = $('#network_form')[0];
  
      var formdata = new FormData(form);
        
      $.ajax(
      {
        url : 'network_store',
        method: "POST",
        data: formdata,
        contentType: false, // Added this line to set the content type to false cause the data being send is a multiple data
        processData: false, // Added this line to set the process data to false preventing ajax from converting it to string format
        success: function(response)
        {
          if(response)
          {
            // Refresh the page and then redirect after a delay
            setTimeout(function()
            {
              location.reload();
              window.location.href = "network"; // Replace with the URL you want to redirect to
            }, 2000); // 2000 milliseconds = 2 seconds
            swal("Success!!", response.success, "success");
  
          }
        },
        error:function(xhr, status, error)
        {
          if(xhr.status===422)
          {
            // Extract the validation errors from the response JSON
            var errors = xhr.responseJSON.errors;

            // Display the first error message for each field
            $.each(errors, function(field, messages)
            {
              swal("Error!", messages[0], "error");
            });
          }
          else
          {
            // Display a generic error message
            swal("Oops!", "An unexpected error occurred. Please try again later.", "error");
          }
        }
      });
    }
    catch(error)
    {
      swal("Oops!", error.message, "error");
    }
  })

  //This is where the viewing of the network details will be in the form
  $(document).on('click', '.view_network', function(){
    var id = $(this).val();
    sessionStorage.setItem('networkId', id);// Keeping the network id in a session so that i can be recieved for showing the data in the network form
    window.location.href = "view_network_form";

  });

  var id = sessionStorage.getItem('networkId');
  if (id) 
  {
    // Make an AJAX call to fetch and populate the data
    $('.spinner-container').show();
    $.ajax(
    {
      type: 'GET',
      url: 'view_network',
      data: { id: id },
      success: function(response) 
      {
        var tableBody = $('#view_network_body');
        tableBody.empty(); // Clear existing table data
        
        var networkInfo = response.network_info;
        
        // Define a mapping object of labels to their corresponding data properties
        var labelMapping = 
        {
          "Department Name": "dept_name",
          "Bandwidth": "bandwidth",
          "Latitude": "latitude",
          "Longitude": "longitude",
          "Address": "address",
          "IP range": "ip_range",
          "Vlan Id": "vlan_id",
          "Department Nodal Person": "dept_nodal_person",
          "Link Type": "link_type",
          "Lease Line Provider": "lease_line_provider",
          "Date of Commission": "date_of_commissioning",
          "No of segments": "no_of_segments",
          "Router Model": "router_model",
          "Ownership of Router": "ownership_of_router",
        };

        $.each(labelMapping, function(label, property) 
        {
          var row = $('<tr>');
          row.append('<td>' + label + '</td>'); // Static label column
          row.append('<td>' + (networkInfo[property] || '') + '</td>'); // Dynamic data column
          tableBody.append(row);
        });
        $('.spinner-container').hide();
      },
      error: function(response) 
      {
        console.log(response.error);
        $('.spinner-container').hide();
      }
    });
  }
    
  //this is for the link type for insertion JS
  $('#linkBtn').click(function(e)
  {
    e.preventDefault();
    var link = $('#link_type').val();
  
    try
    {
      $.ajax(
      {
        url : 'link_store',
        method: "POST",
        data : {
          'link_type' : link
        },
        success: function(response)
        {
          console.log(response);
          if(response)
          {
            // Refresh the page and then redirect after a delay
            setTimeout(function()
            {
              location.reload();
              window.location.href = "link"; // Replace with the URL you want to redirect to
            }, 2000); // 2000 milliseconds = 2 seconds

            swal("Success!!", response.success, "success");//show the message
          }
        },
        error:function(xhr, status, error)
        {
          if(xhr.status===422)
          {
            // Extract the validation errors from the response JSON
            var errors = xhr.responseJSON.errors;

            // Display the first error message for each field
            $.each(errors, function(field, messages)
            {
              swal("Error!", messages[0], "error");
            });
          }
          else
          {
            // Display a generic error message
            swal("Oops!", "An unexpected error occurred. Please try again later.", "error");
          }
        }
      });
    }
    catch(error)
    {
      swal("Oops!", error.message, "error");
    }
        
  })
   
  //this is the function to delete the link
  $(document).on('click','.delete_link',function(e)
  {
    e.preventDefault();
    var index = $(this).val();
    $.ajax(
    {
      url: 'delete_link',
      type: 'GET',
      data: {
        id : index,
      },
      success:function(response)
      {
        if(response)
        {
          // Refresh the page and then redirect after a delay
          setTimeout(function()
          {
            location.reload();
            window.location.href = "link"; // Replace with the URL you want to redirect to
          }, 2000); // 2000 milliseconds = 2 seconds

          swal("Success!!", response.success, "success");//show the message
        }
      },
      error: function(response)
      {
        swal("Not found", response.error, "error");
      },
    });
    
  });

  //This is for deleting the lease line provider from the table
  $(document).on('click','.delete_lease_line',function(e)
  {
    e.preventDefault();
    var id = $(this).val();
    $.ajax(
    {
      url:'delete_lease_line',
      type: 'GET',
      data: {
        'id': id,
      },
      success:function(response)
      {
        if(response)
        {
          // Refresh the page and then redirect after a delay
          setTimeout(function()
          {
            location.reload();
            window.location.href = "lease_line_provider_view"; // Replace with the URL you want to redirect to
          }, 2000); // 2000 milliseconds = 2 seconds

          swal("Success!!", response.success, "success");//show the message
        }
      },
      error:function(response)
      {
        swal("Not found", response.error, "error");

      }
    });
  })

  //this for deleting the network from the table
  $(document).on('click','.delete_network',function(e)
  {
    e.preventDefault();
    var index = $(this).val();
    $.ajax(
    {
      url: 'delete_network',
      type: 'GET',
      data: {
          id : index,
      },
      success:function(response)
      {
        if(response)
        {
          // Refresh the page and then redirect after a delay
          setTimeout(function()
          {
            location.reload();
            window.location.href = "network"; // Replace with the URL you want to redirect to
          }, 2000); // 2000 milliseconds = 2 seconds

          swal("Success!!", response.success, "success");//show the message
        }
      },
      error: function(response)
      {
        swal("Not found", response.error, "error");
      },
    });
  });

  // Function to handle network editing
  $(document).on('click', '.edit_network', function() {
    var index = $(this).val();
    $('#edit_network_modal').modal('show');

    // Fetch existing network data based on the ID
    $.ajax({
      url: 'edit_network', 
      type: 'GET',
      data: { id: index },
      success: function(response) {
        if (response && response.network) {
          populateModalFields(response.network);
        } else {
          swal("Error", "No data found for this network", "error");
        }
      },
      error: function(response) {
        swal("Not found", response.message, "error");
      }
    });
  });

  function populateModalFields(network) {
    // Populate modal fields with the existing data as placeholders
    $('#id').val(network.id);
    $('#edit_address').attr('placeholder', network.address);
    $('#edit_Department_name').attr('placeholder', network.dept_name);
    $('#edit_bandwidth').attr('placeholder', network.bandwidth);
    $('#edit_dept_nodal_person').attr('placeholder', network.dept_nodal_person);
    $('#edit_date_of_commission').val(network.date_of_commissioning);
    $('#edit_no_of_segments').attr('placeholder', network.no_of_segments);
    $('#edit_vlan_id').attr('placeholder', network.vlan_id);
    $('#edit_no_of_ip').attr('placeholder', network.no_of_ip);
    $('#edit_ip_range').attr('placeholder', network.ip_range);
    $('#edit_longitude').attr('placeholder', network.longitude);
    $('#edit_latitude').attr('placeholder', network.latitude);
    $('#edit_router_model').attr('placeholder', network.router_model);
    $('#edit_ownership').attr('placeholder', network.ownership_of_router);

    // Fetch and set dropdown values
    $('#link_type_drop_modal').html(cachedLinkOptions).val(network.link_type);
    $('#lease_line_drop_modal').html(cachedLeaseOptions).val(network.lease_line_provider);
  }

  $('#edit_network_modal').on('hidden.bs.modal', function () {
    // Clear all input fields
    $(this).find('form')[0].reset();
    // Clear placeholders if needed
    $(this).find('input').attr('placeholder', '');
    // Reset select dropdowns to default state
    $('#link_type_drop_modal').html(cachedLinkOptions);
    $('#lease_line_drop_modal').html(cachedLeaseOptions);
  });

  // Fetch link types and call callback when done
  function fetch_link_to_select_modal(callback) {
    $.ajax({
      url: 'fetch_link_type_modal', // URL of your controller method to fetch links
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        $.each(response.link, function(_, item) {
          $('#link_type_drop_modal').append('<option value="'+item.link_type+'">'+item.link_type+'</option>');
        });
        if (callback) callback();
      },
      error: function(xhr, status, error) {
        console.error('Error fetching links:', error);
      }
    });
  }

  // Fetch lease lines and call callback when done
  function fetch_lease_to_select_modal(callback) {
    $.ajax({
      url: 'fetch_lease_line_modal', // URL of your controller method to fetch lease lines
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        $.each(response.lease, function(_, item) {
          $('#lease_line_drop_modal').append('<option value="'+item.lease_line_provider+'">'+item.lease_line_provider+'</option>');
        });
        if (callback) callback();
      },
      error: function(xhr, status, error) {
        console.error('Error fetching lease lines:', error);
      }
    });
  }

  $('#update_network').click(function(e)
  {
    e.preventDefault();
    var id = $('#id').val();
    var formdata = $('#edit_network_form').serialize();
    // alert(id + formdata);
    // return;
    $.ajax(
      {
      url: 'update_network',
      type: 'POST',
      data: {
        key1: id,
        key2: formdata
        },
      // contentType: false,
      // processData: false,
      success: function(response)
      {
        if(!response)
        {
          setTimeout(function()
          {
            location.reload();
            window.location.href = "network"; // Replace with the URL you want to redirect to
          }, 2000); // 2000 milliseconds = 2 seconds
          swal("Success!!",response.message,"success");
        }
        else
        {
          swal('Error','Fields cannot be empty','error');
        }
      }, 
      error: function(response)
      {
        swal("Opps!!", response.message, "error");
      }
    })
  });
 
 //This is the updation of the lease line provider
 $(document).on('click','.edit_lease_line',function(e)
 {
    e.preventDefault();
    var id = $(this).val();
    $('#edit_lease_line_modal').modal('show');
    $.ajax(
    {
      url: 'edit_lease_line',
      type: 'GET',
      data: {
        'id' : id
      },
      success: function(response)
      {
        if(response)
        {
          $('#id').val(response.lease_line.id);
          $('#edit_lease_line').attr('placeholder', response.lease_line.lease_line_provider);

        }
        else
        {
          swal('Error', 'No data found for this lease line', 'error');
        }
      },
      error: function(response)
      {
        swal('Not Found', response.error,'error');
      }
    });

  })

  //This is for updating the lease line provider
  $(document).on('click','#update_lease_line',function(e)
  {
    e.preventDefault();
    var id = $('#id').val();
    var ll = $('#edit_lease_line').val();
    $.ajax({
      url: 'update_lease_line',
      type: 'POST',
      data: {
        'idkey': id,
        'llkey': ll,
      },
      success: function(response)
      {
        if(response)
        {
          setTimeout(function()
          {
            location.reload();
            window.location.href = "lease_line_provider_view"; // Replace with the URL you want to redirect to
          }, 2000); // 2000 milliseconds = 2 seconds
          swal("Success!!",response.success,"success");
        }
      },
     error:function(xhr, status, error)
        {
          if(xhr.status===422)
          {
            // Extract the validation errors from the response JSON
            var errors = xhr.responseJSON.errors;

            // Display the first error message for each field
            $.each(errors, function(field, messages)
            {
              swal("Error!", messages[0], "error");
            });
          }
          else
          {
            // Display a generic error message
            swal("Oops!", "An unexpected error occurred. Please try again later.", "error");
          }
        }
    });
  })

  //Editing of the Link type starts here
  $(document).on('click','.edit_link_type', function(e)
  {
    e.preventDefault();
    var id = $(this).val();
    $('#edit_link_type_modal').modal('show');
    $.ajax(
    {
      url: 'edit_link_type',
      type: 'GET',
      data: {
        'id' : id
      },
      success: function(response)
      {
        if(response)
        {
          $('#id').val(response.link_type.id);
          $('#edit_link_type').attr('placeholder', response.link_type.link_type);

        }
        else
        {
          swal('Error', 'No data found for this lease line', 'error');
        }
      },
      error: function(response)
      {
        swal('Not Found', response.error,'error');
      }
    });
  })
});

 //This is for updating the link type
  $(document).on('click','#update_link_type',function(e)
  {
    e.preventDefault();
    var id = $('#id').val();
    var lt = $('#edit_link_type').val();
    $.ajax({
      url: 'update_link_type',
      type: 'POST',
      data: {
        'idkey': id,
        'ltkey': lt,
      },
      success: function(response)
      {
        if(response)
        {
          setTimeout(function()
          {
            location.reload();
            window.location.href = "link"; // Replace with the URL you want to redirect to
          }, 2000); // 2000 milliseconds = 2 seconds
          swal("Success!!",response.success,"success");
        }
      },
     error:function(xhr, status, error)
        {
          if(xhr.status===422)
          {
            // Extract the validation errors from the response JSON
            var errors = xhr.responseJSON.errors;

            // Display the first error message for each field
            $.each(errors, function(field, messages)
            {
              swal("Error!", messages[0], "error");
            });
          }
          else
          {
            // Display a generic error message
            swal("Oops!", "An unexpected error occurred. Please try again later.", "error");
          }
        }
    });
  })
