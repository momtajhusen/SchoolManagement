<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Parents;

class ParentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $parent_response;
    public $data;
    public $ParentData = [];
    public function index(Request $request)
    {

        $parents_search_select = $request->parents_search_select;
        $parents_input_search = $request->parents_input_search;

        if($parents_input_search != "")
        {
            if($parents_search_select == "father_mobile" || $parents_search_select == "login_email")
            {
                $this->parent_response = Parents::where($parents_search_select, $parents_input_search)->get();
            }
            else{
              $this->parent_response = Parents::where($parents_search_select, 'LIKE', '%'.$parents_input_search.'%')->get();   
            }
        }
        else{
            $this->parent_response = Parents::get(); 
        }

        if(count($this->parent_response) != "0")
        {
            foreach($this->parent_response as $this->data)
            {
                array_push($this->ParentData,$this->data);
            }   
            
            return response(array("data"=>$this->ParentData),200);
        }
        else{
            return response()->json(['message' => 'data not found']); 
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() 
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) 
    {
        echo "store";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) 
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) 
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) 
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) 
    {
        //
    }
}