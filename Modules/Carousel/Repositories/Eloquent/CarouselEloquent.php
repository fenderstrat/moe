<?php

namespace Modules\Carousel\Repositories\Eloquent;

use DB;
use Translation;
use Modules\Carousel\Repositories\CarouselRepositoryInterface;
use Modules\Carousel\Repositories\Eloquent\Entities\Carousel;
use Modules\Carousel\Repositories\Eloquent\Entities\CarouselContent;

class CarouselEloquent implements CarouselRepositoryInterface
{
    public function paginate()
    {
        return Carousel::select('*', 'carousel_id as id')->join(
            'carousel_contents', 'carousels.id','=','carousel_contents.carousel_id'
        )
        ->orderBy('carousel_id', 'asc')
        ->withAvailableTranslation()
        ->findByActiveLocale()
        ->paginate(10);
    }

    public function findCarousel(int $id)
    {
        return Carousel::find($id);
    }

    public function find(int $id)
    {
        return Carousel::select('*', 'carousel_id as id')->join(
            'carousel_contents', 'carousels.id','=','carousel_contents.carousel_id'
        )
        ->findByActiveLocale()
        ->findOrFail($id);
    }

    public function findByLanguage(int $id, string $lang)
    {
        return Carousel::select('*', 'carousel_id as id')->join(
            'carousel_contents', 'carousels.id','=','carousel_contents.carousel_id'
        )
        ->where('language', $lang)
        ->findOrFail($id);
    }

    public function findContent(int $id)
    {

    }


    public function store(array $data)
    {
        return Carousel::create($data['carousel'])
            ->contents()->create($data['content']);
    }


    public function save(array $data)
    {
        return CarouselContent::create($data);
    }

    public function update(int $id, array $data)
    {
        // update carousel
        $carousel = Carousel::findOrFail($id);
        $carousel->update($data['carousel']);

        // update content berdasarkan carousel_id dan bahasa
        $content = CarouselContent::where('language', $data['language'])
            ->where('carousel_id', $id)->first();
        $content->update($data['content']);
    }


    public function destroy(int $id, string $language)
    {
        $content = CarouselContent::where('language', $language)
            ->where('carousel_id', $id)->first();
        if (! is_null($content)) {
            $content->delete();
            $carousel = Carousel::where('id', $id)->withCount('contents')->first();
            if ($carousel->contents_count == 0) {
                Carousel::find($id)->delete();
                return true;
            }
        }
        return false;
    }

}