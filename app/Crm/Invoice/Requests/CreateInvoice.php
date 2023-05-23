<?php

declare(strict_types=1);

namespace Crm\Invoice\Requests;

use Crm\Base\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateInvoice extends ApiRequest
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
            'total' => 'required',
            'items' => 'required',
            'status' => 'required'
        ];
    }
}
