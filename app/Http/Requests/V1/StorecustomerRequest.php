<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorecustomerRequest extends FormRequest
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
            'name' => ['required'],
            'type' =>['required','string','max:255',Rule::in(['I','C','i','c'])], 
            'email' =>[ 'required','email'],
            'address' => ['required','string','max:255'],
            'city' => ['string','max:255'],
            'postal_code' =>[ 'string','max:255']
        ];
    }
}
