<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];

    public function instructor() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lessons() {
        return $this->hasMany(Lesson::class);
    }

    public function favorites() {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

}
