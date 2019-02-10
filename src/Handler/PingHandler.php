<?php

declare(strict_types=1);

namespace Mobicms\Modules\ExpressiveDemoApp\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

use function time;
use Zend\Expressive\Session\SessionInterface;

class PingHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        /** @var SessionInterface $session */
        $session = $request->getAttribute('session');

        if($session->has('test')){
            $test = $session->get('test');
        } else {
            $test = '---';
            $session->set('test', 'session-test-value');
        }

        return new JsonResponse(['ack' => time(), 'session' => $test]);
    }
}
