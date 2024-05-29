<?php

namespace App\Http\Controller;

use App\Helper\Discord;
use HttpSoft\Response\EmptyResponse;
use Psr\Http\Message\ServerRequestInterface;
use Tnapf\Router\Routing\RouteRunner;
use Psr\Http\Message\ResponseInterface;
use Tnapf\Router\Interfaces\ControllerInterface;
use HttpSoft\Response\JsonResponse;
use React\EventLoop\Loop;
use React\Http\Message\Response;
use Tnapf\Router\Exceptions\HttpNotFound;
use function vierbergenlars\SemVer\Internal\valid;

class DiscordImageTranceiverController
{
    public static function get(ServerRequestInterface $request, ResponseInterface $response, RouteRunner $route): ResponseInterface
    {
        $files = $request->getUploadedFiles();

        if (isset($files['source'])) {
            /** @var UploadedFile $file */
            $file = $files['source'];

            if ($file->getError() === UPLOAD_ERR_OK) {
                $stream = $file->getStream();
                $path = 'storage/' . $file->getClientFilename();
                
                $stream->rewind(); // Make sure to rewind the stream before reading it
                file_put_contents($path, $stream->getContents());
                
                $imageUrl = Discord::SendImage($path);

                unlink($path);

                return new JsonResponse(
                    ['status' => '200', 'image-url' => $imageUrl],
                    200
                );
            } else {
                return new JsonResponse(
                    ['status' => '400', 'error' => 'Failed to upload file. Error code: ' . $file->getError()],
                    400
                );
            }
        }

        return new JsonResponse(
            ['status' => '400', 'error' => 'No file uploaded.'],
            400
        );
    }
}
