<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'description',
        'number_of_field',
        'is_active',
        'total_acres'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function details()
    {
        return $this->belongsToMany(Detail::class);
    }
}
