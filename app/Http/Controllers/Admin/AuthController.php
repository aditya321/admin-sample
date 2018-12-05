<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
//use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Log;
use App\Model\User;
use App\Http\Request\Admin\LoginUserRequest;
use App\Http\Request\Admin\RegisterUserRequest;
use Auth;

class AuthController extends BaseController {
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

    //use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    //protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        
    }

    public function getLogin() {
        $user = Auth::user();
        if (is_object($user)) {
            return view('admin/dashboard');
        }
        return view('admin.login');
    }

    public function postLogin(LoginUserRequest $request) {
        try {
            $remember = $request->has('remember_me') ? true : false;
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
                return view('admin.dashboard');
            }

            return \Redirect::back()->withErrors(['Invalid Credentials']);
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
            Log::error($e->getMessage());
        }
    }

//End of function login

    public function getRegister() {
        $user = Auth::user();
        if (is_object($user)) {
            return view('admin/dashboard');
        }
        return view('admin.register');
    }

    public function postRegister(RegisterUserRequest $request) {
        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();
        return view('admin.login');
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }

}
