<?php
/**
 * Magento code generator
 *
 * PHP version 5.3
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category  Client
 * @package   ZFConsole
 * @author    Daniel Kocherga <dan.kocherga@gmail.com>
 * @copyright 2013 Daniel Kocherga (dan.kocherga@gmail.com)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/dankocherga/MTool
 */

namespace Module;

use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Console\Adapter\AdapterInterface as ConsoleAdapterInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface; 

use MTool\Bundle\Module\Creator as ModuleCreator;
use MTool\Bundle\Module\TemplateFactory;

use MTool\Core\Storage\Filesystem;
use MTool\Core\Environment\ExecutionEnvironment;
use MTool\Core\Template\TwigTemplate;
use MTool\Core\Template\StorageTemplateLoader;

/**
 * Path validator test case
 *
 * @category Client
 * @package  ZFConsole
 * @author   Daniel Kocherga <dan@oggettoweb.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://github.com/dankocherga/MTool
 */
class Module implements 
    ConsoleUsageProviderInterface, 
    ConfigProviderInterface, 
    AutoloaderProviderInterface,
    ServiceProviderInterface
{
    /**
     * Get console usage 
     * 
     * @param ConsoleAdapterInterface $console Console
     *
     * @return array
     */
    public function getConsoleUsage(ConsoleAdapterInterface $console)
    {
        return array(
            'Working with modules',
            'create module <module>' => 'Create new module in local pool',
            array('<module>', 'Module name in format of mycompany/mymodule')
        );
    }

    /**
     * Get config 
     * 
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * Get autoloader config 
     * 
     * @return array
     */
    public function getAutoloaderConfig()
    {
        $root = dirname(dirname(dirname(dirname(__DIR__))));
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    'MTool\Client\ZFConsole\Bundle\Module' => __DIR__,
                    'MTool\Core' => "{$root}/core",
                    'MTool\Bundle' => "{$root}/bundle"
                ),
            ),
        );
    }

    /**
     * Get service config 
     * 
     * @return array
     */
    public function getServiceConfig()
    {
        $module = $this;
        return array(
            'invokables' => array(
                'Module\PathValidator' => 'MTool\Client\ZFConsole\Bundle\Module\Model\PathValidator',
                'Module' => 'MTool\Core\Module'
            ),
            'factories' => array(
                'ModuleCreator' => function () use ($module) {
                    $filesystem = new Filesystem;
                    $templateLoader = new StorageTemplateLoader(
                        $filesystem, __DIR__ . '/tpl'
                    );
                    $templates = new TemplateFactory(new TwigTemplate, $templateLoader);
                    return new ModuleCreator($filesystem, new ExecutionEnvironment, $templates);
                }
            )
        );
    }
}
