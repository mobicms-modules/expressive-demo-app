<?php

declare(strict_types=1);

namespace Mobicms\Modules\ExpressiveDemoApp\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class HomePageHandler implements RequestHandlerInterface
{
    /** @var null|TemplateRendererInterface */
    private $template;

    public function __construct(TemplateRendererInterface $template = null)
    {
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

        return new HtmlResponse($this->template->render('app::home-page', $data));
    }
}
