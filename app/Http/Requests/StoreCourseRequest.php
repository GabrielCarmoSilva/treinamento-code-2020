<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'name' => 'required|max:255|string|unique:courses,name',
            'description' => 'required|string',
            'slug' => 'required|string|unique:courses,slug',
            'image_link' => 'nullable|file|max:512',
            'video' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nome',
            'description' => 'descrição',
            'slug' => 'slug',
            'image_link' => 'imagem',
            'video' => 'vídeo',
            'category_id' => 'categoria',
        ];
    }
}
