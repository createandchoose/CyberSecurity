<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Test extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        "name"
    ];

    protected $table = "tests";

    protected $hidden = [
        "created_at",
        "updated_at",
    ];

    protected $appends = ['questions'];
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, "test_id", "id");
    }

    public function answers(): HasManyThrough
    {
        return $this->hasManyThrough(Answer::class, Question::class, "test_id", "question_id", "id", "id");
    }

    protected function getQuestionsAttribute()
    {
        return $this->questions()->count();
    }
}
