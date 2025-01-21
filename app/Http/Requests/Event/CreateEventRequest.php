<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
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
            'image' => '|required|image|mimes:png,jpg,jpeg,web',
            'start_date_time' => 'required|date|after_or_equal:today',
            'end_date_time' => 'required|date|after:start_date_time',
            'location' => 'required',
            'location_link' => 'required',
            'short_description' => 'required|max:500',
            'long_description' => 'required|max:1000',
            'attendees' => 'nullable|mimes: xlsx',
        ];
    }


    public function messages()
    {
        return [
            'start_date_time.after_or_equal:today' => "The start date must be after or equal today.",
            'end_date_time.after:today' => "The end date must be a after to start date.",
        ];
    }
}
