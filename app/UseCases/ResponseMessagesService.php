<?php

namespace App\UseCases;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class ResponseMessagesService
{
    public function errorMessage(string $message):array
    {
        return [
            'success' => false,
            'message' => $message
        ];
    }

}