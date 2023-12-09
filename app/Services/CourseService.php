<?php

namespace App\Services;

use App\Http\Requests\PassTestRequest;
use App\Http\Requests\TestGetRequest;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseService {

    public function index()
    {
        try {
            return Course::orderBy('created_at', 'DESC')->get();
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function get($r)
    {
        try {
            return Course::where('id','=',$r['course_id'])->with(['chapters'])->firstOrFail();
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function pass($r)
    {
        try {
            $c = Course::find($r['course_id']);

            $u = Auth::user();
            if(!$u->pass_courses()->where("course_id", '=', $r['course_id'])->exists()) {
                $u->points = $u->points + $c->points;
                $u->save();
            }
            $u->pass_courses()->syncWithoutDetaching($r['course_id']);
            return Course::find($r['course_id']);
        } catch (\Throwable $e) {
            return false;
        }
    }

}
