<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseGetRequest;
use App\Http\Requests\PassCourseRequest;
use App\Http\Requests\PassTestRequest;
use App\Http\Requests\TestGetRequest;
use App\Services\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct(private CourseService $courseService)
    {

    }

    public function index()
    {
        $response = $this->courseService->index();
        if($response) {
            return response()->json(["data" => $response], 200);
        } else {
            return response()->json(["data" => "fail"], 400);
        }
    }

    public function get(CourseGetRequest $request)
    {
        $response = $this->courseService->get($request->all());
        if($response) {
            return response()->json(["data" => $response], 200);
        } else {
            return response()->json(["data" => "fail"], 400);
        }
    }

    public function pass(PassCourseRequest $request)
    {
        $response = $this->courseService->pass($request->all());
        if($response) {
            return response()->json(["data" => $response], 200);
        } else {
            return response()->json(["data" => "fail"], 400);
        }
    }
}
