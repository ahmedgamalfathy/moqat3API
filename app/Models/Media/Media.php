<?php

namespace App\Models\Media;
use App\Models\Slider\Slider;
use App\Enums\Media\MediaType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Media extends Model
{
    protected $guarded = [];
    protected $casts = [
      'type'=>MediaType::class
    ];
    protected function path(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? Storage::disk('public')->url($value) : "",
        );
    }
    public function slider(){
        return $this->belongsTo(Slider::class);
    }


}
