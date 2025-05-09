<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = ['title', 'feature_video'];

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

}
