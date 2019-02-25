<?php
/**
 * This file is part of mobiCMS Content Management System.
 *
 * @copyright   Oleg Kasyanov <dev@mobicms.net>
 * @license     https://opensource.org/licenses/GPL-3.0 GPL-3.0 (see the LICENSE.md file)
 * @link        http://mobicms.org mobiCMS Project
 */

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
