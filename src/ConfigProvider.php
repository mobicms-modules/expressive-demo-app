<?php
/**
 * This file is part of mobiCMS Content Management System.
 *
 * @copyright   Oleg Kasyanov <dev@mobicms.net>
 * @license     https://opensource.org/licenses/GPL-3.0 GPL-3.0 (see the LICENSE.md file)
 * @link        http://mobicms.org mobiCMS Project
 */

declare(strict_types=1);

namespace Mobicms\Modules\ExpressiveDemoApp;

/**
 * The configuration provider for the Demo module
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
                Handler\PingHandler::class => Handler\PingHandler::class,
            ],

            'factories' => [
                Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'app' => [dirname(__DIR__) . '/templates/app'],
            ],
        ];
    }
}
