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

use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

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
        $data['containerName'] = 'Zend Servicemanager';
        $data['containerDocs'] = 'https://docs.zendframework.com/zend-servicemanager/';
        $data['routerName'] = 'FastRoute';
        $data['routerDocs'] = 'https://github.com/nikic/FastRoute';
        $data['templateName'] = 'Plates';
        $data['templateDocs'] = 'http://platesphp.com/';

        $query = $this->pdo->query('SELECT * FROM `test` LIMIT 10');

        while ($result = $query->fetch()) {
            $data['pdoDemo'][] = $result['name'];
        }

        return new HtmlResponse($this->template->render('app::home-page', $data));
    }
}
