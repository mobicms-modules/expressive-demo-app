<?php

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
    /** @var null|TemplateRendererInterface */
    private $template;

    public function __construct(TemplateRendererInterface $template)
    {
        $this->template = $template;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        /** @var PDO $db */
        $db = $request->getAttribute(PDO::class);

        $data = [];
        $data['containerName'] = 'Zend Servicemanager';
        $data['containerDocs'] = 'https://docs.zendframework.com/zend-servicemanager/';
        $data['routerName'] = 'FastRoute';
        $data['routerDocs'] = 'https://github.com/nikic/FastRoute';
        $data['templateName'] = 'Plates';
        $data['templateDocs'] = 'http://platesphp.com/';

        $query = $db->query('SELECT * FROM `test` LIMIT 10');

        while ($result = $query->fetch()) {
            $data['pdoDemo'][] = $result['name'];
        }

        return new HtmlResponse($this->template->render('app::home-page', $data));
    }
}
