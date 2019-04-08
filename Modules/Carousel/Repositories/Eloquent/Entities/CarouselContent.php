<?php

namespace Modules\Carousel\Repositories\Eloquent\Entities;

use Illuminate\Database\Eloquent\Model;

class CarouselContent extends Model
{
    protected $fillable = [
        'carousel_id',
        'title',
        'description',
        'url',
        'language',
    ];

    public function carousel()
    {
        return $this->belongsTo('Modules\Carousel\Repositories\Eloquent\Entities\Carousel');
    }
}