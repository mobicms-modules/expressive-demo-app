<?php

declare(strict_types=1);

namespace Mobicms\Modules\ExpressiveDemoApp\Handler;

use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

use function get_class;

class HomePageHandlerFactory
{
    public function __invoke(ContainerInterface $container) : RequestHandlerInterface
    {
        return new HomePageHandler($container->get(TemplateRendererInterface::class));
    }
}
