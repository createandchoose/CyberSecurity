<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chapter extends Model
{
    use HasFactory, HasUuids;

    protected $table = "chapters";

    protected $fillable = [
        "name",
        "markdown",
        "course_id"
    ];

    protected $hidden = [
        "created_at",
        "updated_at",
        "course_id"
    ];
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, "course_id", "id");
    }
}
