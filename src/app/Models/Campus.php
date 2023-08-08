<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;

    protected $table = 'campuses';

    protected $fillable = [
        'university_name',
        'location',
        'website',
    ];

    public function majors()
    {
        return $this->hasMany(Major::class);
    }
}
