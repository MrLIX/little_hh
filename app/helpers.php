<?php

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Models\BaseModel as Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

if (!function_exists('success_out')) {
    /**
     * @param Collection|LengthAwarePaginator|array|Model|Authenticatable|bool $data
     * @param null|bool|array $links
     * @param null|array $errors
     * @return ResponseFactory|\Illuminate\Http\Response
     */
    function success_out($data, $links = null, $errors = null)
    {
        if ($links) {
            $links = [
                'count' => $data->count(),
                'current_page' => $data->currentPage(),
                'from' => $data->firstItem(),
                'to' => $data->lastItem(),
                'last_page' => $data->lastPage(),
                'per_page' => $data->perPage()
            ];
            $data = $data->getCollection();
        }
        return response([
            'success' => true,
            'data' => $data,
            'links' => $links,
            'errors' => $errors
        ]);
    }
}

if (!function_exists('error_out')) {
    /**
     * @param $errors
     * @param int $code
     * @param null $message
     * @return ResponseFactory|\Illuminate\Http\Response
     */
    function error_out($errors, $code = 422, $message = null)
    {
        return response([
            'success' => false,
            'data' => [],
            'message' => $message,
            'errors' => $errors
        ], $code);
    }
}
if (!function_exists('clearPhone')) {

    /**
     * @param $phone
     * @return array|string|string[]
     */
    function clearPhone($phone)
    {
        $phone = str_replace(" ", "", $phone);
        $phone = str_replace("-", "", $phone);
        $phone = str_replace("+", "", $phone);

        return $phone;
    }
}
