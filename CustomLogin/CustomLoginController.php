<?php

namespace Statamic\Addons\CustomLogin;

use Statamic\Extend\Controller;

use Statamic\API\Auth;
use Statamic\API\Request;

class CustomLoginController extends Controller
{
    /**
     * Tries to log in a user and returns a JSON formatted response
     *
     * @return mixed
     */
    public function postLogin(Request $request){

        // Fetch submitted data
        $credentials = $request->all();

        // Check whether a redirect url is given
        $redirect = false;
        if(array_key_exists("redirect", $credentials)){
            $redirect = true;
        }
        $redirect_url = $credentials["redirect"];

        // Attempt the login and return a response
        if (Auth::login($credentials["username"], $credentials["password"])) {
            $msg = array(
                'status'  => 'success',
                'message' => 'Login successful',
                'redirect' => $redirect,
                'redirect_url' => $redirect_url
            );
            return response()->json($msg);
        } else {
            $msg = array(
                'status'  => 'error',
                'message' => 'Login failed!'
            );
            return response()->json($msg);
        }

    }
    
}
