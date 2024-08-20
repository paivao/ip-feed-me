<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ErrorController extends BaseController
{
    public const ERROR_CODES = [
        'not_found' => 404,
        'unauthorized' => 401,
        'forbidden' => 403,
        'bad_request' => 400,
    ];

    public function showError(?string $error)
    {
        $code = self::ERROR_CODES[$error] ?? 400;
        $this->response->setStatusCode($code);
        $message = $this->request->getPostGet('reason') ?? 'Bad Request';
        return view('errors/error', ['message' => $message]);
    }
}
