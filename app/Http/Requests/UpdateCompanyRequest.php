<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:companies|max:255',
            'email' => 'required|unique:companies,email,'. $this->company->id.'|email|max:255',
            'logo' => 'required|mimes:png,jpg,jpeg|max:2048|dimensions:min_width=100,min_height=100',
            'website' => 'nullable|url|max:255'
        ];
    }
}
