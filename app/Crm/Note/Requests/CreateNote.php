<?php

declare(strict_types=1);

namespace Crm\Note\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateNote extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'note' => 'required|unique'
        ];
    }
}
