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

use Mobicms\System\Http\IpAddressMiddleware;
use Mobicms\System\Http\UserAgentMiddleware;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;

class HomePageHandler implements RequestHandlerInterface
{
    /** @var PDO */
    private $pdo;

    /** @var null|TemplateRendererInterface */
    private $template;

    public function __construct(PDO $pdo, TemplateRendererInterface $template)
    {
        $this->pdo = $pdo;
        $this->template = $template;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $data = [];
        $data['containerName'] = 'Laminas Servicemanager';
        $data['containerDocs'] = 'https://docs.laminas.dev/laminas-servicemanager';
        $data['routerName'] = 'FastRoute';
        $data['routerDocs'] = 'https://github.com/nikic/FastRoute';
        $data['templateName'] = 'mobicms/render';
        $data['templateDocs'] = 'https://github.com/mobicms/render';
        $data['ipRemote'] = $request->getAttribute(IpAddressMiddleware::IP_REMOTE_ADDR_ATTRIBUTE, '0.0.0.0');
        $data['ipViaProxy'] = $request->getAttribute(IpAddressMiddleware::IP_VIA_PROXY_ATTRIBUTE, 'not used');
        $data['userAgent'] = $request->getAttribute(UserAgentMiddleware::USER_AGENT_ATTRIBUTE, 'not recognized');

        $query = $this->pdo->query('SELECT * FROM `test` LIMIT 10');

        while ($result = $query->fetch()) {
            $data['pdoDemo'][] = $result['name'];
        }

        return new HtmlResponse($this->template->render('app::home-page', $data));
    }
}
