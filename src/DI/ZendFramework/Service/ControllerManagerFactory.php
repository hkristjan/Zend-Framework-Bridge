<?php
/**
 * PHP-DI
 *
 * @link http://mnapoli.github.io/PHP-DI/
 * @copyright Matthieu Napoli (http://mnapoli.fr/)
 * @license http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

namespace DI\ZendFramework\Service;

use DI\Container;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;

/**
 * Factory responsible for creating the serviceManager responsible for creating controllers
 *
 * @author Marco Pivetta <ocramius@gmail.com>
 * @license MIT
 * @see \Zend\Mvc\Service\ControllerManagerFactory
 */
final class ControllerManagerFactory implements FactoryInterface
{
    /**
     * Create the controller loader service
     *
     * Creates and returns an instance of Controller\ControllerManager. The
     * only controllers this manager will allow are those defined in the
     * application configuration's "controllers" array. If a controller is
     * matched, the scoped manager will attempt to load the controller.
     * Finally, it will attempt to inject the controller plugin manager
     * if the controller implements a setPluginManager() method.
     *
     * This plugin manager is _not_ peered against DI, and as such, will
     * not load unknown classes.
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     * @return ControllerManager
     *
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /* @var \DI\Container $container */
        $diContainer = $container->get(Container::class);

        return new ControllerManager($diContainer, $container);
    }
}
