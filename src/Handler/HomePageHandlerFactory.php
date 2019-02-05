<?php

declare(strict_types=1);

namespace Mobicms\Modules\ExpressiveDemoApp\Handler;

use PDO;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class HomePageHandlerFactory
{
    public function __invoke(ContainerInterface $container) : RequestHandlerInterface
    {
        $db = $container->get(PDO::class);
        $template = $container->get(TemplateRendererInterface::class);

        return new HomePageHandler($db, $template);
    }
}
