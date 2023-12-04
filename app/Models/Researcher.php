<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
class Researcher extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;


    protected $guard = 'researchers';


    public $fillable=[
        'name',
        'phone',
        'gender',
        'valid',
    ];

    protected $hidden = [
        'password',
        // 'device_id',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];


    public function teacher_info()
    {
        return $this->hasMany(TeacherInfo::class);
    }
}
