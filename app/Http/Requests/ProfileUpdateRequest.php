<?php
// app/Http/Requests/ProfileUpdateRequest.php
// Create with: php artisan make:request ProfileUpdateRequest

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/' // Only letters and spaces
            ],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id)
            ],
            'phone' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^([0-9\s\-\+\(\)]*)$/' // Phone number format
            ],
            'address' => ['nullable', 'string', 'max:500'],
            'avatar' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048', // Max 2MB
                'dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000'
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap harus diisi.',
            'name.regex' => 'Nama hanya boleh berisi huruf dan spasi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh user lain.',
            'phone.regex' => 'Format nomor telepon tidak valid.',
            'avatar.image' => 'File harus berupa gambar.',
            'avatar.mimes' => 'Avatar harus berformat: jpeg, png, jpg, atau gif.',
            'avatar.max' => 'Ukuran avatar maksimal 2MB.',
            'avatar.dimensions' => 'Dimensi avatar minimal 100x100px dan maksimal 2000x2000px.',
            'address.max' => 'Alamat maksimal 500 karakter.',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
