<?php

namespace App\Src\Request;

use App\Traits\ValidationErr;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateCatRequest extends FormRequest
{
    use ValidationErr;
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
        return [
            'name'=>'required|max:120',
            'type'=>'required|max:120',
            'Eyes'=>'required|max:120'
        ];
    }

    public function attributes()
    {
        return [
            'name.required'=>'Имя обязательно для заполнения',
            'type'=>'Значение поля порода не валидна'
        ];
    }


}
