<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController {

    use AuthenticatesUsers;

    public function username()
    {
        return 'login';
    }

}
