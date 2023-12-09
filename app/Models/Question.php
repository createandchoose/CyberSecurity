<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        "question",
        "test_id"
    ];
    protected $hidden = [
        "created_at",
        "updated_at",
        "test_id"
    ];

    protected $table = "questions";

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class,"test_id", "id");
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class, "question_id", "id");
    }
}
