<?php

namespace Crm\Base;

use Illuminate\Http\JsonResponse;

class ResponseBuilder
{
    /**
     * @var int
     */
    private int $statusCode = 200;
    private $data = null;
    private array $errors = [];
    private string $status = 'success';
    private array $meta = [];

    const STATUS_SUCCESS = 'success';
    const STATUS_ERROR = 'error';


    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return $this
     */
    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @return null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $data
     * @return $this
     */
    public function setData($data): self
    {
        $this->data = $data;
        return $this;

    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     * @return $this
     */
    public function setErrors(array $errors): self
    {
        $this->errors = $errors;
        return $this;

    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return array
     */
    public function getMeta(): array
    {
        return $this->meta;
    }

    /**
     * @param array $meta
     * @return $this
     */
    public function setMeta(array $meta): self
    {
        $this->meta = $meta;
        return $this;
    }

    /**
     * @return JsonResponse
     */
    public function response()
    {
        $response = [];

        if ($this->getStatus() !== JsonResponse::HTTP_OK && !empty($this->getErrors())) {
            $response['errors'] = $this->getErrors();
        }
        $response['status'] = $this->getStatus();

        if ($this->getStatus() === self::STATUS_SUCCESS) {
            $response['data'] = $this->getData();
        }

        return response()->json($response , $this->getStatusCode());
    }
}
