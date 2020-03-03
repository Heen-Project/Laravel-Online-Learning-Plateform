<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ArticleCreateRequest extends Request
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
        $messages = [
            'integer'    => 'You must select one of the lessons',
        ];
        return [
            'title' => 'required|unique:articles',
            'lesson' => 'integer|min:1|required',
            'description' => 'required',
        ];
    }
}
