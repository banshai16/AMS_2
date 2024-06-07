$(document).ready(function () 
{
    $('.spinner-container').show();
    $.ajax(
    {
        url: 'get_location', // Ensure this URL matches your route
        type: 'GET',
        dataType: 'json',
        success: function(response) 
        {
            // var lat = parseFloat(response.location.latitude);
            // var long = parseFloat(response.location.longitude);
            // console.log(lat + " " + long);

             // Initialize the map focusing on Meghalaya
            var marker;
            var mapOptions = 
            {
                zoomControl: false, // Disable zoom control
                dragging: false, // Disable dragging
                scrollWheelZoom: false, // Disable scroll wheel zoom
                doubleClickZoom: false // Disable double-click zoom
            };
            var map = L.map('map', mapOptions).setView([25.4670, 91.3662], 9);

            // Define a custom icon
            var customIcon = L.icon(
            {
                iconUrl: '/assets/image/location_icon.png',
                iconSize: [32, 32], // Size of the icon
                iconAnchor: [16, 32], // Anchor point of the icon (center bottom)
                popupAnchor: [0, -32] // Popup anchor relative to the icon (top center)
            });
            $('.spinner-container').hide();
            // Add marker with custom icon
            $.each(response.location,function(_,item)
            {
                var lat = parseFloat(item.latitude);
                var long = parseFloat(item.longitude);
                marker = L.marker([lat, long], { icon: customIcon }).addTo(map);
                marker.networkid = item.id;


                //To show the info
                marker.on('click',function(e)
                {
                    var networkid = e.target.networkid;
                    $.ajax(
                    {
                        url: 'get_network_info',
                        type: 'GET',
                        data: {network_id: networkid},
                        dataType: 'json',
                        success: function(response)
                        {
                            console.log(response.network_info);
                            var content = '<p hidden>ID: ' + response.network_info.id + '</p>';
                            content += '<p>Department Name: ' + response.network_info.dept_name + '</p>';
                            content += '<p>Latitude: ' + parseFloat(response.network_info.latitude) + '</p>';
                            content += '<p>Longitude: ' + parseFloat(response.network_info.longitude) + '</p>';
                            content += '<p>Bandwidth: ' + response.network_info.bandwidth + '</p>';
                            content += '<p>No of IP: ' + response.network_info.no_of_ip + '</p>';
                            content += '<p>Date of Commission: ' + response.network_info.date_of_commissioning + '</p>';
                            var add_content = '<p>Department Nodal Person: ' + response.network_info.dept_nodal_person + '</p>';
                            add_content += '<p>Link type: ' + response.network_info.link_type + '</p>';
                            add_content += '<p>Lease line provider: ' + response.network_info.lease_line_provider + '</p>';
                            var add_content = '<p>Department Nodal Person: ' + response.network_info.dept_nodal_person + '</p>';
                            add_content += '<p>Link type: ' + response.network_info.link_type + '</p>';
                            add_content += '<p>Lease line provider: ' + response.network_info.lease_line_provider + '</p>';
                            add_content += '<p>No of segments: ' + response.network_info.no_of_segments + '</p>';
                            add_content += '<p>IP range: ' + response.network_info.ip_range + '</p>';
                            add_content += '<p>Vlan Id: ' + response.network_info.vlan_id + '</p>';
                            add_content += '<p>Router Model: ' + response.network_info.router_model + '</p>';
                            add_content += '<p>Ownership of router: ' + response.network_info.ownership_of_router + '</p>';
                            $('#details').append(content);
                            $('#additional_details').append(add_content);
                            $('#show_network_modal').modal('show');


                        },
                        error: function(response)
                        {
                            console.log('error');
                        }
                                     
                    });
                    
                });
            });
             $('#show_network_modal').on('hidden.bs.modal', function (e) {
                $('#details').empty(); // Clear the content
                $('#additional_details').empty();
                $('#additional_details').hide();
                $('#expand_button').show();
                $('#collapse_button').hide();
            });  

            
            // Expand and collapse functionality
            $('#expand_button').on('click', function() 
            {
                $('#additional_details').show();
                $('#expand_button').hide();
                $('#collapse_button').show();
            });

            $('#collapse_button').on('click', function() 
            {
                $('#additional_details').hide();
                $('#expand_button').show();
                $('#collapse_button').hide();
            });


            // Fetch and add the GeoJSON layer
            $.getJSON('/get_geojson', function(data) 
            {
                L.geoJSON(data, 
                {
                    onEachFeature: function(feature, layer) 
                    {
                        if (feature.properties && feature.properties.District) 
                        {
                            var districtName = feature.properties.District;
                            
                            //Bind a tooltip directly to the polygon
                            // layer.bindTooltip(districtName, 
                            // {
                            //     permanent: true,
                            //     className: 'district-label',
                            //     direction: 'center',
                            //     opacity: 0.7
                            // }).openTooltip();
                            
                            // Calculate the centroid of the polygon
                            // var centroid = layer.getBounds().getCenter();

                            layer.bindPopup(feature.properties.District)//The Popup of the District on clicking 
                        }
                    }
                }).addTo(map);
            });
            
        },
        error: function(response) {
            console.log('Error fetching location data:', response);
        }
    });
   
});


    // function mapping()
    // {
    //     $.ajax(
    //     {
    //         url: 'get_location', // Ensure this URL matches your route
    //         type: 'GET',
    //         dataType: 'json',
    //         success: function(response) 
    //         {
    //             var lat = parseFloat(response.location.latitude);
    //             var long = parseFloat(response.location.longitude);
    //             console.log(lat + " " + long);

    //             var mapOptions = {
    //                 center: [lat, long],
    //                 zoom: 9.4,
    //                 zoomControl: false, // Disable zoom control
    //                 dragging: false, // Disable dragging
    //                 scrollWheelZoom: false, // Disable scroll wheel zoom
    //                 doubleClickZoom: false // Disable double-click zoom
    //             };

    //             // Initialize the Leaflet map with the ID of the map container
    //             var map = L.map('map', mapOptions);

    //             // Set up the tile layer (basemap)
    //             L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //                 maxZoom: 19,
    //                 attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    //             }).addTo(map);

                
    //         },
    //         error: function(response) {
    //             console.log('Error fetching location data:', response);
    //         }
    //     });
    // }

    // // Call the mapping function
    // mapping();
