<?php

namespace App\Http\Controllers\Auth;

use App\Authme;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Null_;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'username' => ['required', 'string', 'max:255','unique:authme'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:authme'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Authme
     */
    protected function create(array $data)
    {
        $ip =  \Request::ip();

        return Authme::create([
            'username' => trim(strtolower($data['username'])),
            'realname' => trim($this->getRealname($data)),
            'email' => $data['email'],
            'password' => $this->hashPassword($data['password']),
            'ip'=> $ip,
            'regip' => $ip,
            'regdate' => now()->timestamp
        ]);
    }

    protected function getRealname(array $data){
        $endPoint = 'https://api.mojang.com/users/profiles/minecraft/'.$data['username'].'?at='.now()->timestamp;
        $json = json_decode(file_get_contents($endPoint, true),true);
        if($json['name']){
            return $json['name'];
        }
        return $data['username'];

    }

    protected function salt($length = 16)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    protected function hashPassword($password){
         $salt = $this->salt();
        return $hash = '$SHA$' . $salt . '$' . hash('sha256', hash('sha256', $password) . $salt);
    }
}
