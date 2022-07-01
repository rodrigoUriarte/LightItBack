<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    public function alive()
    {
        $data = [
            'is_alive' => true,
            'status' => 200,
        ];

        return new JsonResponse(['data' => $data], $data['status']);
    }
}
