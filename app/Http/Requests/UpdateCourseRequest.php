<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
    public function authorize()
    {
        // solo propietario (instructor) puede actualizar
        $course = $this->route('course');
        return $this->user() && $this->user()->is_instructor && $course && $course->user_id === $this->user()->id;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:150',
            'description' => 'nullable|string|max:2000',
        ];
    }
}
