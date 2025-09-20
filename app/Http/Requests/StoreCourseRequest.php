<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user() && $this->user()->is_instructor;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:150',
            'description' => 'nullable|string|max:2000',
        ];
    }
}

