<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewArtistRequest extends FormRequest
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
        return [
            //
            'full_name'=>['required','min:2'],
            'category_id'=>['required'],
            'avatar'=>['required','mimes:jpg,png,jpeg,mpeg','min:100','max:512'],
            'background'=>['required','mimes:jpg,png,jpeg,mpeg','min:256','max:1024']
        ];
    }
}
