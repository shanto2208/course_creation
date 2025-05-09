<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{

    protected $table = 'contents';
    
    protected $fillable = ['module_id', 'title', 'video_url', 'video_length', 'source_type'];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

}
