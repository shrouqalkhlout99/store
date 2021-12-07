<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name'=>'required|string|max:255|min:3',
            'parent_id'=>'nullable|int|min:3|',
            'description'=>'nullable|min:5',
            'image'=>'image|max:512000|dimension:min_width=360,min_height=300',
            'status'=>'required|in:active,draft',
        ];
    }
    public function messages()
    {
        return [
            'required'=>' الحقل attribute: هذا',
        ];
    }

}
