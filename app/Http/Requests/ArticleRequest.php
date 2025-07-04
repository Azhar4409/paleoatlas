<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
        $rules = [
            'category_id'   => 'required',
            'title'         => 'required',
            'desc'          => 'required',
            'img'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status'        => 'required',
            'publish_date'  => 'required',
        ];

        if ($this->isMethod('post')) {
            $rules['img'] = 'required|image|mimes:jpeg,png,jpg,webp|max:2048';
        }

        return $rules;
    }
}
