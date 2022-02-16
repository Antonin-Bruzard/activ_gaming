<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    public function banner() {
        return $this->hasOne('App\File\File', 'id', 'image_id');
    }
}
