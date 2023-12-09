<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PassTest extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        "user_id",
        "test_id"
    ];

    protected $table = "pass_tests";

    protected $with = [
        "test",
        "questions"
    ];

    protected $hidden = [
        "id",
        "updated_at",
        "user_id",
        "test_id",
    ];
    protected $appends = ['right_answers'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class, "test_id", "id");
    }

    public function questions(): HasMany
    {
        return $this->hasMany(QuestionPassTest::class, "pass_tests_id", "id");
    }

    public function getRightAnswersAttribute()
    {
        return $this->questions()->where("is_right", '=', true)->count();
    }
}
