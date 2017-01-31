<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;

class ItemController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth.basic');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {     
        return Product::latest()->get();
    }

    public function show(Request $request,$id)
    {     
        return Product::findOrFail($id);
    }


}
