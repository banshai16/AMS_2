<?php

namespace App\Http\Controllers;

use App\Models\LeaseLine;
use Illuminate\Http\Request;

class LeaselineController extends Controller
{
    public function lease_line_provider_view(Request $request)
    {
        $page = $request->query('page', 1);
        return view('lease_line_provider', compact('page'));     
    }

    public function get_lease_line(Request $request)
    {
        $perpage = 5;
        $page = $request->query('page', 1);        
        $ll = LeaseLine::paginate($perpage, ['*'], 'page', $page);
        if ($request->ajax()) 
        {
            // For AJAX requests, return JSON response
            $paginationLinks = $ll->links('pagination::bootstrap-4')->toHtml(); // Generate pagination links in HTML format
            return response()->json([
                'll' => $ll->items(),
                'total' => $ll->total(),
                'current_page' => $ll->currentPage(),
                'pagination_links' => $paginationLinks,
            ]);
        } 
        else 
        {
            // For non-AJAX requests, return the view with paginated data
            return view('lease_line_provider', compact('ll'));
        }
    }
    public function lease_line_store(Request $request)
    {
        $validatedData = $request->validate([
            'lease_line_provider' => 'required|string',
        ]);

        $lease_line = new LeaseLine();
        $lease_line->lease_line_provider = $validatedData['lease_line_provider'];
        $lease_line->save();
        return response()->json([
            'success' => 'Lease Line Provider is added succesfully',
        ]);
    }

    public function delete_lease_line(Request $request)
    {
        $item = $request->input('id');
        if($item)
        {
            LeaseLine::where('id',$item)->delete();
            return response()->json(['success' => 'Item deleted successfully!']);
        }
        else
        {
            return response()->json(['error' => 'Item not found'], 404);
        }
    }

    public function edit_lease_line(Request $request)
    {
        $id = $request->input('id');
        $lease_line = LeaseLine::findOrFail($id);
        if($lease_line)
        {
            return response()->json([
                'lease_line' => $lease_line,
            ]);
        }
        else
        {
            return response()->json([
                'error' => 'Item is not available',
            ]);
        }
    }

    public function update_lease_line(Request $request)
    {
        $id = $request->input('idkey');
        $validateData = $request->validate([
            'llkey' => 'required|string',
        ]);
        if($id)
        {
            $lease_line = LeaseLine::findOrFail($id);
            if($lease_line)
            {
                $lease_line->lease_line_provider = $validateData['llkey'];
                $lease_line->save();

                return response()->json([
                'success' => 'Data updated successfully',
                ]);
            }
        }
        else
        {
             return response()->json([
            'Not found' => 'Data not found',
            ]);
        }
       
    }
}
