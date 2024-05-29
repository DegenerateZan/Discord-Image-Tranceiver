<?php

namespace App\Http\Controller;

use HttpSoft\Response\EmptyResponse;
use Psr\Http\Message\ServerRequestInterface;
use Tnapf\Router\Routing\RouteRunner;
use Psr\Http\Message\ResponseInterface;

use Tnapf\Router\Interfaces\ControllerInterface;

use HttpSoft\Response\JsonResponse;
use HttpSoft\Response\TextResponse;
use React\Http\Message\Response;
use Tnapf\Router\Exceptions\HttpNotFound;

class IndexController
{
    public static function index(ServerRequestInterface $request, ResponseInterface $response, RouteRunner $route): ResponseInterface
    {
        return new TextResponse("sorry you have to provide the param :P");
    }
}