<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class productRequest extends FormRequest
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
        return
            [
                'name_first'=>'required',
                'category_id'=>'required|int|exists:categories,id',
                'description'=>'nullable',
                'price'=>'nullable|numeric',
                'sale_price'=>'nullable|numeric',
                'quantity'=>'nullable|int',
                ' sku'=>'nullable|unique:products,sku',
                'weight'=>'nullable|numeric',
                'width'=>'nullable|numeric',
                'height'=>'nullable|numeric',
                'length'=>'nullable|numeric',
               'image_path'=>'image|max:512000|dimension:min_width=360,min_height=300',
                'status'=>'required|in:active,draft',
            ];
    }
}
