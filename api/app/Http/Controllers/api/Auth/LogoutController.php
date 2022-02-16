<?php

namespace App\Http\Controllers\api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\JWTAuth;

class LogoutController extends Controller
{

    protected $auth;

    public function __construct(JWTAuth $auth) {
        $this->auth = $auth;
    }

    public function logout() {
        $this->auth->invalidate();

        return response()->json([
            'success' => true
        ]);
    }
}
