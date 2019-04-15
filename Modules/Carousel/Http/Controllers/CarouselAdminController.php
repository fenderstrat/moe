<?php

namespace Modules\Carousel\Http\Controllers;

use App\Traits\CrudAction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Http\Requests\BatchActionRequest;
use Modules\Carousel\Http\Requests\AddCarouselRequest;
use Modules\Carousel\Http\Requests\CreateCarouselRequest;
use Modules\Carousel\Http\Requests\UpdateCarouselRequest;
use Modules\Carousel\Repositories\CarouselRepositoryInterface;

class CarouselAdminController extends Controller
{
    use CrudAction;

    protected $model;

    public function __construct(CarouselRepositoryInterface $carousel)
    {
        $this->model = $carousel;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $carousels = $this->model->paginate($request->all());
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
        return $this->storeAction($request->transform());
    }

    /**
     * Show the form for adding a new resource.
     * @return Response
     */
    public function add(int $id, string $locale)
    {
        $carousel = $this->model->findCarousel($id);
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
        return $this->saveAction($request->transform());
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(int $id, string $language = null)
    {
        if (is_null($language)) {
            $carousel = $this->model->find($id);
        } else {
            $carousel = $this->model->findByLanguage($id, $language);
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
        return $this->updateAction($id, $request->transform());
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @param string $language
     * @return Response
     */
    public function destroy(int $id, ?string $language = null)
    {
        return $this->destroyAction($id, $language);
    }

    /**
     * Action for batch destroy
     *
     * @param BatchActionRequest $request
     * @return boolean
     */
    public function batchDestroy(BatchActionRequest $request)
    {
        return $this->batchDestroyAction($request);
    }
}
