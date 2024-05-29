<?php

use Tnapf\Router\Routing\Methods;
use Tnapf\Router\Routing\RouteRunner;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Tnapf\Router\Routing\Route;
use Tnapf\Router\Exceptions\HttpNotFound;
use App\Http\Controller\Controller;
use App\Http\Controller\DiscordImageTranceiverController;
use App\Http\Controller\IndexController;
use App\Http\Controller\Mp3GetterController;
use React\Http\Message\Response;

$router = new \Tnapf\Router\Router();

$router->get(
    "/",
    Closure::fromCallable([IndexController::class, 'index'])
);

$router->post("tranceiver", Closure::fromCallable([DiscordImageTranceiverController::class, "get"]));


$router->catch(
    HttpNotFound::class,
    static function (
      ServerRequestInterface $request,
      ResponseInterface $response,
      RouteRunner $route
    ) {
      $response = new Response(Response::STATUS_NOT_FOUND, [
        "Content-Type" => "text/html"
    ], "{$request->getUri()->getPath()} does not exist");
    return $response;
    }
  );

return $router;