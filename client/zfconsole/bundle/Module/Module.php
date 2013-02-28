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

use Bundle\Module\Creator as ModuleCreator;
use Bundle\Module\TemplateFactory;

use Core\Storage\Filesystem;
use Core\Environment\ExecutionEnvironment;
use Core\Template\TwigTemplate;
use Core\Template\StorageTemplateLoader;

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
     * Get app root 
     * 
     * @return string
     */
    public function getAppRoot()
    {
        return dirname(dirname(dirname(dirname(__DIR__))));
    }

    /**
     * Get autoloader config 
     * 
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    'Client\ZFConsole\Bundle\Module' => __DIR__,
                    'Core' => "{$this->getAppRoot()}/core",
                    'Bundle' => "{$this->getAppRoot()}/bundle"
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
                'Module\PathValidator' => 'Client\ZFConsole\Bundle\Module\Model\PathValidator',
                'Module' => 'Core\Module'
            ),
            'factories' => array(
                'ModuleCreator' => function () use ($module) {
                    $filesystem = new Filesystem;
                    $templateLoader = new StorageTemplateLoader(
                        $filesystem, "{$module->getAppRoot()}/bundle/Module/tpl"
                    );
                    $templates = new TemplateFactory(new TwigTemplate, $templateLoader);
                    return new ModuleCreator($filesystem, new ExecutionEnvironment, $templates);
                }
            )
        );
    }
}
