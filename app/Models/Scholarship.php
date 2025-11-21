<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Scholarship extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'university',
        'location',
        'funding_type',
        'degree_level',
        'deadline',
        'image',
    ];

    /**
     * Users who saved this scholarship
     */
    public function savedByUsers()
    {
        return $this->belongsToMany(User::class, 'saved_scholarships');
    }
}
