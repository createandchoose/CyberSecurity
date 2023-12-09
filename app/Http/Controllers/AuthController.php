<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {

    }

    public function register(RegisterRequest $request)
    {
        $response = $this->authService->register($request->all());
        if($response) {
            return response()->json(["data" => $response], Response::HTTP_OK);
        } else {
            return response()->json(["data" => "fail"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function login(RegisterRequest $request)
    {
        $response = $this->authService->login($request->all());
        if($response) {
            return response()->json(["data" => $response], Response::HTTP_OK);
        } else {
            return response()->json(["data" => "fail"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
