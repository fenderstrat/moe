<?php

namespace Modules\Carousel\Repositories\Eloquent\Entities;

use Translation;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    protected $fillable = [
        'image'
    ];

    public function contents()
    {
        return $this->hasMany('Modules\Carousel\Repositories\Eloquent\Entities\CarouselContent');
    }

    public function translations()
    {
        return $this->contents();
    }

    public function scopeWithAvailableTranslation($query)
    {
        return $query->with(['translations:id,carousel_id,language']);
    }

    public function scopeFindByActiveLocale($query)
    {
        return $query->where('language', Translation::getActiveLocale());
    }
}