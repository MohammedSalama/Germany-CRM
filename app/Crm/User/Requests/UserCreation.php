<?php

declare(strict_types=1);

namespace Crm\User\Requests;

use Crm\Base\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class UserCreation extends ApiRequest
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
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ];
    }
}
