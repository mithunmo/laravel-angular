<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests;
use Request;
use App\User;
use App\Http\Requests\UserRequest;
;
class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
     public function users(){
        $users = User::latest()->get();
        return View("admin.users.users", compact("users"));
    }

    public function show($id){
        $user = User::findOrFail($id);
        return View("admin.users.show", compact("user"));
    }

    public function create(){
        return View("admin.users.register");
    }

    public function store(UserRequest $request){
            $data = Request::all();
            $user = new User();
            $user->name = Request::get("name");
            $user->email = Request::get("email");
            $user->password= bcrypt(Request::get("password"));
            $user->admin = 1;
            $user->save();
            return redirect("/users");
    }

    public function update(Request $request, $id){
        try{
            if (Request::get("delete")){
                $obj = User::findOrFail($id);
                $obj->delete();
            } else {              
                $obj = User::findOrFail($id);
                $obj->name = Request::get("name");
                $obj->email = Request::get("email");
                $obj->save();
            }
        } catch(\Illuminate\Database\QueryException $e){
            return "Error Occured. Please try again";
        }
        return redirect("/users");
    }

}
