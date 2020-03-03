<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LessonCreateRequest extends Request
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
            'title' => 'required|unique:lessons',
            'category' => 'required',
            'description' => 'required|max:500',
        ];
    }
    public function messages()
    {
        return [
            'category.required'    => 'You must select one of the category',
        ];
    }
}
