<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneRepeat extends Model
{
    use HasFactory;
    public $fillable = [
        'phone',
        'repeated',
    ];
}
