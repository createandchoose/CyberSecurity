<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory, HasUuids;

    protected $table = "courses";

    protected $fillable = [
        "name",
        "points"
    ];

    protected $hidden = [
        "created_at",
        "updated_at",
    ];

    protected $appends = ['chapters_count'];
    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class, "course_id", "id");
    }

    public function getChaptersCountAttribute()
    {
        return $this->chapters()->count();
    }
}
