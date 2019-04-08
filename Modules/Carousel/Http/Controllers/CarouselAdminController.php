<?php

namespace Modules\Carousel\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Carousel\Http\Requests\AddCarouselRequest;
use Modules\Carousel\Http\Requests\CreateCarouselRequest;
use Modules\Carousel\Http\Requests\UpdateCarouselRequest;
use Modules\Carousel\Repositories\CarouselRepositoryInterface;

class CarouselAdminController extends Controller
{
    public function __construct(CarouselRepositoryInterface $carousel)
    {
        $this->carousel = $carousel;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $carousels = $this->carousel->paginate();
        return view('carousel::admin.index', compact('carousels'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('carousel::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateCarouselRequest $request
     * @return Response
     */
    public function store(CreateCarouselRequest $request)
    {
        try {
            $this->carousel->store($request->transform());
            notify()->success(__('messages.store.success'));
            return redirect()->back();
        } catch(\Exception $e) {
            \Log::error($e->getMessage());
            notify()->error(__('messages.store.error'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for adding a new resource.
     * @return Response
     */
    public function add(int $id, string $locale)
    {
        $carousel = $this->carousel->findCarousel($id);
        $carousel->language = $locale;
        return view('carousel::admin.add', compact('carousel'));
    }

    /**
     * Save a newly created resource in storage.
     * @param AddCarouselRequest $request
     * @return Response
     */
    public function save(AddCarouselRequest $request)
    {
        try {
            $this->carousel->save($request->transform());
            notify()->success(__('messages.save.success'));
            return redirect()->back();
        } catch(\Exception $e) {
            \Log::error($e->getMessage());
            notify()->error(__('messages.save.error'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(int $id, string $language = null)
    {
        if (is_null($language)) {
            $carousel = $this->carousel->find($id);
        } else {
            $carousel = $this->carousel->findByLanguage($id, $language);
        }

        return view('carousel::admin.edit', compact('carousel'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateCarouselRequest $request
     * @param int $id
     * @return Response
     */
    public function update(int $id, UpdateCarouselRequest $request)
    {
        try {
            $this->carousel->update($id, $request->transform());
            notify()->success(__('messages.update.success'));
            return redirect()->back();
        } catch(\Exception $e) {
            \Log::error($e->getMessage());
            notify()->error(__('messages.update.error'));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @param string $language
     * @return Response
     */
    public function destroy(int $id, string $language)
    {
        try {
            $this->carousel->destroy($id, $language);
            notify()->success(__('messages.destroy.success'));
            return redirect()->back();
        } catch(\Exception $e) {
            \Log::error($e->getMessage());
            notify()->error(__('messages.destroy.error'));
            return redirect()->back();
        }
    }
}
