<?php

namespace App\Http\Requests;

use App\Models\Ads;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdsFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title" => [
                'required',
                'max:255'
            ],

            "category" => [
                'required',
                'max:255'
            ],

            "description" => [
                'required',
                'max:255'
            ],
            
            "path" => [
                'required',
                'max:255'
            ],

            "price" => [
                'required',
            ],

            "location" => [
                'required',
                'max:255'
            ]
        ];
    }
}
