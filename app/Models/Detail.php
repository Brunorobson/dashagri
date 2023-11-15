<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'photo_path',
    ];

    public function farm()
    {
        return $this->belongsToMany(Farm::class);
    }

}
