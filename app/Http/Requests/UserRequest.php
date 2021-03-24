<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        return [
            'name'  => 'required',
            'username'  => 'required',
            'email'  => 'required|email',
            'address.street' => 'required',
            'address.suite' => 'required',
            'address.city' => 'required',
            'address.zipcode' => 'required',
            'address.geo.lat' => 'required',
            'address.geo.lng' => 'required',
            'phone'  => 'required',
            'website'  => 'required',
            'company.name'  => 'required',
            'company.catchPhrase'  => 'required',
            'company.bs'  => 'required',
        ];


    }
}
