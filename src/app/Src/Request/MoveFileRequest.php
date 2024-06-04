<?php

namespace App\Src\Request;

use App\Traits\ValidationErr;
use Illuminate\Foundation\Http\FormRequest;


/**
 * @property int new_folder_id
 */
class MoveFileRequest extends FormRequest
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
            'new_folder_id' => 'required|numeric|exists:folders,id',
        ];
    }
}
