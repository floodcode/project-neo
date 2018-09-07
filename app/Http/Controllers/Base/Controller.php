<?php

namespace App\Http\Controllers\Base;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function renderData(): array
    {
        return [];
    }

    protected function render(?string $view = null, array $data = [], array $mergeData = [])
    {
        $data = array_merge($data, $this->renderData());
        return view($view, $data, $mergeData);
    }

    protected function jsonSuccess(array $data = []): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    protected function jsonError(string $message = 'Unexpected error occured'): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ])->setStatusCode(400);
    }
}
