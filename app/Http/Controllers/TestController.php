<?php

namespace App\Http\Controllers;

use App\Http\Requests\PassTestRequest;
use App\Http\Requests\TestGetRequest;
use App\Services\TestService;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function __construct(private TestService $testService)
    {

    }

    public function index()
    {
        $response = $this->testService->index();
        if($response) {
            return response()->json(["data" => $response], 200);
        } else {
            return response()->json(["data" => "fail"], 400);
        }
    }

    public function get(TestGetRequest $request)
    {
        $response = $this->testService->get($request->all());
        if($response) {
            return response()->json(["data" => $response], 200);
        } else {
            return response()->json(["data" => "fail"], 400);
        }
    }

    public function pass(PassTestRequest $request)
    {
        $response = $this->testService->pass($request->all());
        if($response) {
            return response()->json(["data" => $response], 200);
        } else {
            return response()->json(["data" => "fail"], 400);
        }
    }
}
