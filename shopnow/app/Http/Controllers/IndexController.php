<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;

class IndexController extends Controller
{
    

    public function home(){

        return View("layouts.home");
        
    }

    /*
    public function show(){
        //return "hello world";
    }

    public function login(){
        return View("shopnow.login",["name" => "mithun"]);
    }

    public function signup(){
        return View("shopnow.signup");
    }

    public function products(){
        return Product::all();
    }
    */

}
