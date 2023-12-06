<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Isolation extends Model
{
    use HasFactory;

    public $fillable = [
        'siteCode',
        'ParentCode',
        'Ar_Name',
        'En_Name',
    ];
}
