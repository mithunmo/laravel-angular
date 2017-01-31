<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;
use Request;
use App\Http\Requests\CreateProduct;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function products(){
        $products = Product::latest()->get();
        return View("admin.products", compact("products"));
    }

    public function show($id){
        $product = Product::findOrFail($id);
        return View("admin.show", compact("product"));
    }

    public function create(){
        return View("admin.create");
    }

    public function store(CreateProduct $request){
        $obj = new Product();
        $obj->name = Request::get("name");
        $obj->price = Request::get("price");
        $obj->quantity = Request::get("quantity");
        $obj->company = Request::get("company");
        $obj->imgurl = Request::get("imgurl");
        $obj->save();
        return redirect("/products");
    }
    
    public function update(CreateProduct $request, $id){
        if (Request::get("delete")){
            $obj = Product::findOrFail($id);
            $obj->delete();
        } else {
            $obj = Product::findOrFail($id);
            $obj->name = Request::get("name");
            $obj->price = Request::get("price");
            $obj->quantity = Request::get("quantity");
            $obj->company = Request::get("company");
            $obj->imgurl = Request::get("imgurl");        
            $obj->save();
        }
        return redirect("/products");
    }

}
