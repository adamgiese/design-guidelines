<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Authenticates user 
     */
		public function authenticate(Request $request){

        $attempt = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        if ($attempt) {

            $user = Auth::user();

            $response = array(
                'success' => true,
                'user'    => $user
            );
						return response()->json($response);
				} else{
						$response = array('success' => false, 'message' => 'Invalid login credentials');
						return response()->json($response);
				}
		}

}
