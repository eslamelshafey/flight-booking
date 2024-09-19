<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightRequest extends FormRequest
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
            'departure_city' => 'required|string|max:255',
            'arrival_city' => 'required|string|max:255',
            'travel_date' => 'required|date|after_or_equal:today',
            'price' => 'required|numeric|min:0',
            'available_seats' => 'required|integer|min:1|max:30000'
        ];
    }
}
