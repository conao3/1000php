<?php

namespace conao3\Mypsr\Http\Handler;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DateAction implements RequestHandlerInterface
{
    /**
     * Handles a request and produces a response.
     *
     * May call other collaborating code to generate the response.
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $psr17Factory = new \Nyholm\Psr7\Factory\Psr17Factory();
        $response = $psr17Factory->createResponse(200)
            ->withBody(
                $psr17Factory->createStream(date('Y-m-d H:i:s'))
            );

        return $response;
    }
}
