<?php

require __DIR__ . '/../vendor/autoload.php';

$whoops = new \Whoops\Run();
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
$whoops->register();

$psr17Factory = new \Nyholm\Psr7\Factory\Psr17Factory();

$creator = new \Nyholm\Psr7Server\ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

$serverRequest = $creator->fromGlobals();

$path = $serverRequest->getUri()->getPath();

if ($path === '/now') {
    $handler = new \conao3\MyPsr\Http\Handler\DateAction();
    $response = $handler->handle($serverRequest);
} else {
    $response = $psr17Factory->createResponse(404)
                             ->withBody(
                                 $psr17Factory->createStream('Page not found')
                             );
}

(new \Laminas\HttpHandlerRunner\Emitter\SapiEmitter())->emit($response);
