<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Reservation;
class StoreReservation extends FormRequest
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
     * @return array
     */
    public function rules()
    {   
        $unavailableDates = Reservation::FormatToValidation();
        return [
            'user_id' => 'required',
            'name' => 'required',
            'start_date' => ['required', 'date', 'date_format:y-m-d H:i', Rule::notIn($unavailableDates)],
            'end_date' => 'required',
            'type' => 'required',
        ];
    }
}
