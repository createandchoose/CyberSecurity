<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AuthService {

    public function register($r)
    {
        try {
            $u = new User();
            $u->login = $r['login'];
            $u->password = Hash::make($r['password']);
            $u->save();
            return $u->createToken('')->plainTextToken;
        } catch(Throwable $e) {
            return false;
        }
    }

    public function login($r)
    {
        try {
            if(Auth::attempt($r)){
                return Auth::user()->createToken('')->plainTextToken;
            }
            return false;
        } catch(Throwable $e) {
            return false;
        }
    }
}
