<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'login',
        'password',
        'name',
        'surname'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'password',
        'points',
        'role',
        'email'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    protected $with = [
        'pass_tests',
        'pass_courses'
    ];

    protected $appends = ['rank'];

    public function pass_tests(): HasMany
    {
        return $this->hasMany(PassTest::class, "user_id", "id")->orderBy('created_at', 'DESC');
    }

    public function pass_courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, "pass_courses", "user_id", "course_id");
    }

    public function getRankAttribute() {
        if ($this->points < 20) {
            return "Новичок в Кибербезопасности";
        } elseif ($this->points < 40) {
            return "Ассистент по Киберзащите";
        } elseif ($this->points < 60) {
            return "Специалист по Киберобороне";
        } elseif ($this->points < 80) {
            return "Эксперт по Цифровой Безопасности";
        } elseif ($this->points < 100) {
            return "Мастер Шифрования";
        } elseif ($this->points < 120) {
            return "Воин Киберпространства";
        } elseif ($this->points < 140) {
            return "Страж Киберсети";
        } elseif ($this->points < 160) {
            return "Командир Кибербезопасности";
        } elseif ($this->points < 180) {
            return "Гуру Киберзащиты";
        } else {
            return "Легенда Кибербезопасности";
        }
    }
}
