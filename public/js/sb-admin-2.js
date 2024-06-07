(function($) {
  "use strict"; // Start of use strict

  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // JavaScript to handle tab switching
  // document.querySelectorAll('a[data-bs-toggle="tab"]').forEach(tab => {
  //   tab.addEventListener('click', function(e) {
  //     e.preventDefault();
  //     const target = document.querySelector(this.getAttribute('href'));
  //     const otherTab = document.querySelectorAll('a[data-bs-toggle="tab"]')
  //                             .filter(other => other !== this)
  //                             .map(other => document.querySelector(other.getAttribute('href')))[0];
  //     target.classList.add('show', 'active');
  //     otherTab.classList.remove('show', 'active');
  //   });
  // });

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function() {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');
    };
    
    // Toggle the side navigation when window is resized below 480px
    if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
      $("body").addClass("sidebar-toggled");
      $(".sidebar").addClass("toggled");
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });

})(jQuery); // End of use strict
//
//
//

$(document).ready(function(){

  $.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });

//displaying the links
  fetch_link_to_table();
  fetch_link_to_select('#link_type_drop');
  fetch_lease_to_select();
  //fetch_network_to_table(network_table);
  function fetch_link_to_table()
  {
    $.ajax({
      url: 'link_fetch', // URL of your controller method to fetch links
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        var rowid = 1;
        $.each(response.link_type, function(_, item){//display the value from the database
        $('tbody').append('<tr>\
        <th scope="row" style="display: none;">' + item.id + '</th>\
        <td>' + rowid + '</td>\
        <td>' + item.link_type + '</td>\
        <td><button type="submit" class="btn btn-info" value="'+item.id+'" onclick="updatelink('+ item.id+')">Update</button><td>\
        <td><button type="button" class="btn btn-danger" value="'+item.id+'" onclick="deletelink('+item.id+')">Delete</button><td>\
        </tr>');
        rowid++;
        });
      },
      error: function(xhr, status, error) {
          console.error('Error fetching links:', error);
      }
    });
  }
    //This is for the link type and the link type drop down lists
    function fetch_link_to_select()
    {
          $.ajax({
          url: 'fetch_link_type', // URL of your controller method to fetch links
          type: 'GET',
          dataType: 'json',
          success: function(response) {
              $.each(response.link, function(_, item){//display the value from the database
                $('#link_type_drop').append('<option value="'+item.link_type+'">'+item.link_type+'</option>');
              });
          },
          error: function(xhr, status, error) {
              console.error('Error fetching links:', error);
          }
        });
    }

    //This is for the lease line and the lease line drop down lists
    function fetch_lease_to_select()
    {
          $.ajax({
          url: 'fetch_lease_line', // URL of your controller method to fetch links
          type: 'GET',
          dataType: 'json',
          success: function(response) {
              $.each(response.lease, function(_, item){//display the value from the database
                $('#lease_line_drop').append('<option value="'+item.lease_line_provider+'">'+item.lease_line_provider+'</option>');
              });
          },
          error: function(xhr, status, error) {
              console.error('Error fetching links:', error);
          }
        });
    }
  
  //This is the network form submission
  $('#networkBtn').click(function(e)
    {
      try
      {
      e.preventDefault();
      var form = $('#network_form')[0];

      var formdata = new FormData (form);
      
        $.ajax({
          url : 'network_store',
          method: "POST",
          data : formdata,
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
                swal("Try Again!");
              }
          }
        });
      }
      catch(error)
      {
        swal("Oops!", error.message, "error");
    
      }
    })
  
    //this is for the link type for insertion JS
    $('#linkBtn').click(function(e)
    {
      e.preventDefault();

      var link = $('#link_type').val();

      try
      {
          $.ajax({
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
                swal("Try Again!");
              }
          }
      });
      }
      catch(error)
      {
        swal("Oops!", error.message, "error");
      }
      
    })
    //insertion of the link type ends here


    //updation of the link type starts here
    
});
//this is the function to update the link
function updatelink(index)
  {
      
  }
  //update link ends here

//this is the function to delete the link
function deletelink(index)
{
  alert(index + " this is the delete link");
}
