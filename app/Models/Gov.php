<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gov extends Model
{
    use HasFactory;

    public $fillable = [
        'siteCode',
        'Ar_Name',
        'En_Name',
    ];


    public function district()
    {
        return $this->hasMany(District::class);
    }
}
