<?php

namespace App\Http\Controllers;

use App\Models\Links;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Contracts\DataTable;

class LinkController extends Controller
{
    public function link_view(Request $request)
    {
        $page = $request->query('page', 1);
        return view('link', compact('page'));      
    }

    public function link_store(Request $request)
    {
        // dd($request->all());
        $validateData = $request -> validate([
            'link_type' => 'required|string',
        ]);
        try
        {
        $link = new Links();
        $link->link_type = $validateData['link_type'];
        $link->save();

        return response()->json(['success' => 'Link Type created successfully'],201);
        }
        catch(\Exception $e){
            return response()->json([
                "error"=>"Errors! Try again"]);
        }
    }
    public function link_fetch(Request $request)
    {
        $perpage = 5;
        $page = $request->query('page', 1);        
        $links = Links::paginate($perpage, ['*'], 'page', $page);
        if ($request->ajax()) 
        {
            // For AJAX requests, return JSON response
            $paginationLinks = $links->links('pagination::bootstrap-4')->toHtml(); // Generate pagination links in HTML format
            return response()->json([
                'links' => $links->items(),
                'total' => $links->total(),
                'current_page' => $links->currentPage(),
                'pagination_links' => $paginationLinks,
            ]);
        } 
        else 
        {
            // For non-AJAX requests, return the view with paginated data
            return view('link', compact('links'));
        }
    }
    public function delete_link(Request $request)
    {
        $item = $request->input('id');
        if($item)
        {
            Links::where('id',$item)->delete();
            return response()->json(['success' => 'Item deleted successfully!']);
        }
        else
        {
            return response()->json(['error' => 'Item not found'], 404);
        }
    }

    public function edit_link_type(Request $request)
    {
        $id = $request->input('id');
        $link_type = Links::findOrFail($id);
        if($link_type)
        {
            return response()->json([
                'link_type' => $link_type,
            ]);
        }
        else
        {
            return response()->json([
                'error' => 'Item is not available',
            ]);
        }
    }

    public function update_link_type(Request $request)
    {
        $id = $request->input('idlt');
        $validateData = $request->validate([
            'ltkey' => 'required|string',
        ]);
        if($id)
        {
            $link_type = Links::find($id);
            if($link_type)
            {
                $link_type->link_type = $validateData['ltkey'];
                $link_type->save();

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

