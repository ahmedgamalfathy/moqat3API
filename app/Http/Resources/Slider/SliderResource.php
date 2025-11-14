<?php

namespace App\Http\Resources\Slider;

use App\Http\Resources\Media\AllMediaResource;
use App\Http\Resources\Media\MediaResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Product\SliderProductResource;


class SliderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'sliderId' => $this->id,
            'name' => $this->name,
            // 'startDate' => $this->start_date,
            // 'endDate' => $this->end_date,
            'isActive' => $this->is_active,
            'createdAt' => Carbon::parse($this->created_at)->format('Y-m-d'),
            'sliderItems'=> AllMediaResource::collection($this->medias)
        ];
    }
}
