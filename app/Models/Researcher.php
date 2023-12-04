<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Researcher extends Model
{
    use HasFactory;

    public $fillable=[
        'name',
        'phone',
        'gender',
        'valid',
    ];

    protected $hidden = [
        'password',
        // 'device_id',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];


    public function teacher_info()
    {
        return $this->hasMany(TeacherInfo::class);
    }
}
