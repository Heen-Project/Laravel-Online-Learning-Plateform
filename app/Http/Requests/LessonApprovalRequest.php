<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Validator;

class LessonApprovalRequest extends Request
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
        $rules = [
            'approvalStatus' => 'required',
        ];
        return ($rules);
    }

    public function messages()
    {
        $messages = [
            'approvalStatus.required'    => 'You must either approve or decline between lesson first',
        ];
        return $messages;
    }
}
