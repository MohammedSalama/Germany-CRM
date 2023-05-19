<?php

namespace Crm\Base\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use function response;

abstract class ApiRequest extends FormRequest
{
    /**
     * @return mixed
     */
    abstract public function authorize();


    /**
     * @return mixed
     */
    abstract public function rules();


    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        if( !empty($errors) ) {
            $transformedErrors = [];
            foreach ($errors as $field => $message) {
                $transformedErrors[] = [
                    $field => $message[0]
                ];
            }

            throw new HttpResponseException(
                response()->json(
                    [
                        'status' => 'error',
                        'errors' => $transformedErrors
                    ],
                    JsonResponse::HTTP_BAD_REQUEST
                )
            );
        }
    }
}
