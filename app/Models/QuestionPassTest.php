<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionPassTest extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        "is_right",
        "question_id",
        "pass_tests_id",
    ];

    protected $table = "questions_pass_tests";

    protected $with = [
        "question"
    ];

    protected $hidden = [
        "id",
        "created_at",
        "updated_at",
        "question_id",
        "pass_tests_id"
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class, "question_id", "id");
    }

    public function pass_test(): BelongsTo
    {
        return $this->belongsTo(PassTest::class, "pass_tests_id", "id");
    }
}
