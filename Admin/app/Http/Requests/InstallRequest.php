<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InstallRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
//        dd($this->all());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'db.host' => 'required',
            'db.port' => 'required',
            'db.username' => 'required',
            'db.password' => 'nullable',
            'db.database' => 'required',
            'admin.first_name' => 'required',
            'admin.last_name' => 'required',
            'admin.gender' => 'required',
            'admin.national_code' => 'required',
            'admin.email' => 'required|email',
            'admin.phone' => 'required',
            'admin.password' => 'required|confirmed|min:6',
            'site.name' => 'required',
            'site.email' => 'required|email',
            'site.phone' => 'required',
            'site.front' => 'required',
        ];
    }
}
