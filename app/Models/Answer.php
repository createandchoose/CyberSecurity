<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        "answer",
        "is_right",
        "question_id"
    ];

    protected $hidden = [
        "is_right",
        "created_at",
        "updated_at",
        "question_id"
    ];

    protected $table = "answers";

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class, "question_id", "id");
    }
}
