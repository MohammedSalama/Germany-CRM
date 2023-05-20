<?php

declare(strict_types=1);

namespace Crm\Customer\Requests;

use Crm\Base\Requests\ApiRequest;

class CreateCustomer extends ApiRequest
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
            'name' => 'required|min:3'
        ];
    }
}
