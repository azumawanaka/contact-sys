<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => 'required',
            'phone' => ['nullable'], //'regex:/^\(\d{3}\)\d{3}\d{4}$/'
            'company' => 'nullable',
            'email' => 'required|string|email',
        ];
    
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $contactId = $this->route('contact')->id;
            $rules['email'] .= '|unique:contacts,email,' . $contactId;
        } else { // For create request, ensure email is unique
            $rules['email'] .= '|unique:contacts,email';
        }
    
        return $rules;
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'phone.regex' => 'The phone field format is invalid. Format: (273)1234567'
        ];
    }
}
