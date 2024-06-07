<?php

namespace App\Http\Controllers;

use App\Models\Links;
use App\Models\Network;
use App\Models\LeaseLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;

class NetworkController extends Controller
{
    public function network_view()
    {
        return view('network');
    }
    //for storing the data in the database
    public function network_store(Request $request)
    {
        $validateData = $request->validate([
            'dept_name' => 'required',
            'address' => 'required',
            'bandwidth'  => 'required',
            'dept_nodal_person' => 'required',
            'link_type' => 'required',
            'date_of_commission' => 'required',
            'no_of_segments' => 'required',
            'vlan_id' => 'required',
            'no_of_ip' => 'required',
            'ip_range' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'router_model' => 'required',
            'ownership_of_router' => 'required',
            'lease_line' => 'required',
        ]);

        $network = new Network();

        $network->dept_name = $validateData['dept_name'];
        $network->address = $validateData['address'];
        $network->bandwidth = $validateData['bandwidth'];
        $network->dept_nodal_person = $validateData['dept_nodal_person'];
        $network->link_type = $validateData['link_type'];
        $network->date_of_commissioning = $validateData['date_of_commission'];
        $network->no_of_segments = $validateData['no_of_segments'];
        $network->vlan_id = $validateData['vlan_id'];
        $network->no_of_ip = $validateData['no_of_ip'];
        $network->ip_range = $validateData['ip_range'];
        $network->latitude = $validateData['latitude'];
        $network->longitude = $validateData['longitude'];
        $network->longitude = $validateData['longitude'];
        $network->router_model = $validateData['router_model'];
        $network->ownership_of_router = $validateData['ownership_of_router'];
        $network->lease_line_provider = $validateData['lease_line'];

        $network->save();
        return response()->json([
            "success" => "Network Details Added Successfully"
        ],201);
        
    }
    //fetching the link type from the database to the select tag by populating it
    public function fetch_link_type()
    {
        $data = Links::all();
        return response()->json([
            'link' => $data,
        ]);

    }

    //fetching the lease line provider from the database to the select tag 
    public function fetch_lease_line()
    {
        $data = LeaseLine::all();
        return response()->json([
            'lease' => $data,
        ]);
    }

    public function fetch_link_type_modal()
    {
        $data = Links::all();
        return response()->json([
            'link' => $data,
        ]);

    }

    //fetching the lease line provider from the database to the select tag 
    public function fetch_lease_line_modal()
    {
        $data = LeaseLine::all();
        return response()->json([
            'lease' => $data,
        ]);
    }
    //fetching the data to the table
    public function network_fetch()
    {
        $data = Network::all();
        return response()->json([
            'network' => $data,
        ]);
    }

    public function delete_network(Request $request)
    {
        $item = $request->input('id');
        if($item)
        {
            Network::where('id',$item)->delete();
            return response()->json(['success' => 'Item deleted successfully!']);
        }
        else
        {
            return response()->json(['error' => 'Item not found'], 404);
        }
    }
    public function edit_network(Request $request)
    {
        $item = $request->input('id');
        $network = Network::find($item);
        if($network)
        {
            return response()->json([
                'network' => $network,
            ]);
        }
        else
        {
            return response()->json([
                'message' => 'The data for updation is not found',
            ]);
        }
    }

    public function update_network(Request $request)
    {
        $data = $request->input('key2');
        $id = $request->input('key1');
        parse_str($data, $parsedata);
        $parsedata = array_filter($parsedata);
        $network = Network::findOrFail($id);
        if($network)
        {
            foreach ($parsedata as $key => $value) {
                if ($network->isFillable($key)) 
                {
                    $network->$key = $value;
                }
            }
            
            $network->save();
            
            return response()->json(['message' => 'Data updated successfully']);
        }
        else
        {
            return response()->json(['error' => 'Item is not found']);
        }
    }

    public function get_location()
    {
        $location = Network::select('id','latitude','longitude')->get();
        return response()->json([
            'location' => $location,
        ]);
    }

    public function get_geojson()
    {
        $path = public_path('assets/map/meghalaya_map.geojson');
        return response()->file($path, [
            'Content-Type' => 'application/json'
        ]);
    }

    public function get_network_info(Request $request)
    {
        $network_id = $request->input('network_id');
        $network = Network::findOrFail($network_id);
        if($network)
        {
            return response()->json([
                'network_info' => $network,
                ]);
        }
        else
        {
            return response()->json(['error' => 'Item is not found']);
        }
    }

    public function view_network_form()
    {
        return view('view_network');
    }

     public function view_network(Request $request)
    {
        $id = $request->input('id');
        $network = Network::findOrFail($id);
        if($network)
        {
            return response()->json([
                'network_info' => $network,
            ]);
        }
        else
        {
            return response()->json([
                'error' => 'Item not found',
            ]);
        }
    }
      
}

