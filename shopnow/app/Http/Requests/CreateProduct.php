<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateProduct extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required|min:3",
            "price" => "required",
            "company" => "required",
            "quantity" => "required",
        ];
    }
}
