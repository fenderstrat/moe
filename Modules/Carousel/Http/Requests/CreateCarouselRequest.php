<?php

namespace Modules\Carousel\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCarouselRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'image' => 'required',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Transform request
     *
     * @return void
     */
    public function transform(): array
    {
        return [
            'carousel' => [
                'image' => $this->image
            ],
            'content' => [
                'title' => $this->title,
                'description' => $this->description,
                'url' => $this->url,
                'language' => \Translation::getActiveLocale(),
            ]
        ];
    }
}
