<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
            'title' => 'required|',
            // 'image' => 'nullable|image|mimes:png,jpg,jpeg,web',
            'start_date_time' => 'required|date',
            'end_date_time' => 'required|date',
            'location' => 'required|',
            'location_link' => 'required',
            'short_description' => 'required|max:500',
            'long_description' => 'required|max:1000',
            'attendees' => 'nullable|mimes: xlsx',
        ];
    }
}
