<?php

namespace Src\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GoodsController extends Controller
{
    public function index(RequestInterface $request, ResponseInterface $response, $args)
    {
        return $this->renderer->render($response, 'index.php');
    }
}