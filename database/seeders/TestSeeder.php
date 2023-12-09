<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $test = Test::create([
            "name" => "Тест по кибербезопасности",
            "is_main" => true
        ]);
        $fq = Question::create([
            "question" => "Завершите предложение ниже. «Приносить с собой личное устройство обычно...»",
            "test_id" => $test->id,
        ]);
        Answer::create([
            "answer" => "...более рискованно, чем использовать рабочие устройства",
            "is_right" => true,
            "question_id" => $fq->id
        ]);
        Answer::create([
            "answer" => "...так же рискованно, как и использовать рабочие устройства",
            "is_right" => false,
            "question_id" => $fq->id
        ]);
        Answer::create([
            "answer" => "...менее рискованно, чем использовать рабочие устройства",
            "is_right" => false,
            "question_id" => $fq->id
        ]);
    }
}
