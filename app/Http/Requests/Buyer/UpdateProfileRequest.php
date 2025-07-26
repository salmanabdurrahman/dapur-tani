<?php

namespace App\Http\Requests\Buyer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'business_name' => 'required|string|min:3|max:255',
            'contact_name' => 'required|string|min:3|max:255',
            'phone_number' => 'required|string|min:10|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    /**
     * Get the custom messages for the validation rules.
     */
    public function messages(): array
    {
        return [
            'photo.image' => 'File yang diunggah harus berupa gambar.',
            'photo.mimes' => 'Gambar harus dalam format jpeg, png, jpg, gif, atau svg.',
            'photo.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
