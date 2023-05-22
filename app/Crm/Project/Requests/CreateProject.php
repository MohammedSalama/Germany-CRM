<?php

declare(strict_types=1);

namespace Crm\Project\Requests;

use Crm\Base\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateProject extends ApiRequest
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
            'project_name' => 'required|min:3',
            'status' => 'required|numeric',
//            'customer_id' => 'required',
            'project_cost' => 'required|numeric'
        ];
    }
}
