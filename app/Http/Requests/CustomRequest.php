<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
    protected $redirect = "/form/page";
    // protected $redirectRoute="";

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        dd($this->route('param')); // $request -> route() is used to get path variables and query() is used to get query params
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
            'email' => 'required|email|min:10|max:55|unique:users',
            'name' => 'required|min:6|max:45',
            // 'name' => 'required|size:12',
            // 'phone' => 'integer|size:11',
            // 'languages' => 'array|size:2',
            'file' => 'required|image',
            // 'file' => 'file|size:512',
            // 'password' => 'current_password',
            'password' => 'required|min:8|max:16',
            'publish_at' => 'nullable|date',
            'date_of_birth' => 'required|date|before:today',
            'payment_type' => 'required',
            'card_number' => 'required_if:payment_type,cc'
        ];
    }
}
