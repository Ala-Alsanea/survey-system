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
        'password',
        'gender',
        'device_id',
    ];


    public function teacher_info()
    {
        return $this->hasMany(TeacherInfo::class);
    }
}
