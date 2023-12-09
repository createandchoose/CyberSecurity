<?php

namespace App\Services;

use App\Models\Answer;
use App\Models\PassTest;
use App\Models\QuestionPassTest;
use App\Models\Test;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TestService {

    public function index()
    {
        try {
            return Test::orderBy('created_at', 'DESC')->get();
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function get($r)
    {
        try {
            return Test::where('id','=',$r['test_id'])->with(['questions.answers'])->firstOrFail();
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function pass($r)
    {
        try {
            $u = Auth::user();
            $id = DB::transaction(function() use($r, $u) {
                $p_t = new PassTest();
                $p_t->user_id = $u->id;
                $p_t->test_id = $r['test_id'];
                $p_t->save();
                foreach($r['answers'] as $answer) {
                    $q_p_t = new QuestionPassTest();
                    $q_p_t->is_right = $this->is_right($answer['id']);
                    $q_p_t->question_id = $answer['question_id'];
                    $q_p_t->pass_tests_id = $p_t->id;
                    $q_p_t->save();
                }
                $t = Test::find($r['test_id']);
                $u->points = $u->points + $t->points;
                $u->save();
                return $p_t->id;
            });
            return PassTest::find($id);
        } catch (\Throwable $e) {
            return false;
        }
    }

    private function is_right($answer_id): Bool
    {
        return Answer::find($answer_id)->is_right;
    }
}
