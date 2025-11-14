<?php

namespace App\Models\Slider;

use App\Enums\IsActive;
use App\Models\Media\Media;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $guarded =[];
    protected $table ='sliders';
    public function medias()
    {
       return $this->hasMany(Media::class);
    }

}
