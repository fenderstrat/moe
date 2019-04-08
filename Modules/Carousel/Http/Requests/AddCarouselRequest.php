<?php

namespace Modules\Carousel\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCarouselRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required'
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
     * @return array
     */
    public function transform(): array
    {
        return [
            'carousel_id' => $this->carousel_id,
            'title' => $this->title,
            'description' => $this->description,
            'url' => $this->url,
            'language' => $this->language,
        ];
    }
}
