<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        // 'email',
        'Phone',
        'Phone_par',   
        'class',
        'type',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // العلاقات مع الامتحانات
    public function examResults()
    {
        return $this->hasMany(ExamResult::class);
    }
public function devices()
{
    return $this->hasMany(User_session::class);
}

    public function studentAnswers()
    {
        return $this->hasMany(StudentAnswer::class);
    }

    // التحقق من نوع المستخدم
    public function isAdmin()
    {
        return $this->type === 'Adm';
    }

    public function isStudent()
    {
        return $this->type === 'Std';
    }

    public function isTeacher()
    {
        return $this->type === 'Tch';
    }
}
