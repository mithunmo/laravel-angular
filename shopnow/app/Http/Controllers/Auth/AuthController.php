<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Log;
//use App\Http\Requests\Request;
use Illuminate\Http\Request;
use Auth;

//use Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/products';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
    
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'admin' => 1
        ]);
        
    }

    public function signup(Request $request){        
        
        $validator = $this->validator($request->all());             
        if ( $validator->fails()){
           return Response("False");
        } else {
            $data = $request->all();
            Log::info($request);
            $user = new User();
            $user->name = $request->get("name");
            $user->email = $request->get("email");
            $user->password= bcrypt($request->get("password"));
            $user->save();
            return Response("True");
        }
        
    }

    public function loginapi(Request $request){
        Log::info($request->all());
        Log::info(bcrypt($request->get("password")));

        if (Auth::attempt(array('email' => $request->get("email"),
         'password' => $request->get("password")))){
            return Response("True");
        } else {        
            return Response("False");
         }        
    }
}
