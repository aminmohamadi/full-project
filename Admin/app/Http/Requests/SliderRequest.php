<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('post')){
            return [
                'title' => 'required',
                'header' => 'required',
                'link' => 'required',
                'image' => 'required|image|mimes:jpg,png,jpeg',
            ];
        }
        if ($this->isMethod('patch')){
            return [
                'title' => 'required',
                'header' => 'required',
                'link' => 'required',
                'image' => 'image|mimes:jpg,png,jpeg',

            ];
        }
    }
}
