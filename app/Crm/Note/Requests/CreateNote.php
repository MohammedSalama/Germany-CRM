<?php

declare(strict_types=1);

namespace Crm\Note\Requests;

use Crm\Base\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateNote extends ApiRequest
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
