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

namespace Client\ZFConsole\Bundle\Module\Controller;

use \Zend\Mvc\Controller\AbstractActionController;
use \Zend\Console\ColorInterface as Color;
use \Client\ZFConsole\Bundle\Module\Exception;

/**
 * Module creator controller
 *
 * @category Client
 * @package  ZFConsole
 * @author   Daniel Kocherga <dan@oggettoweb.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://github.com/dankocherga/MTool
 */
class CreatorController extends AbstractActionController
{
    /**
     * Create action 
     * 
     * @return void
     */
    public function createAction()
    {
        $console = $this->getServiceLocator()->get('console');
        try {
            $modulePath = $this->getRequest()->getParam('module');
            $this->getServiceLocator()->get('Module\PathValidator')
                ->validate($modulePath);

            list($company, $name) = explode('/', $modulePath);
            $module = $this->getServiceLocator()->get('Module');
            $module->init($company, $name);

            $this->getServiceLocator()->get('ModuleCreator')
                ->create($module);

            $console->writeLine(
                "Module {$module->getCompany()}_{$module->getName()} successfully created",
                Color::GREEN
            );
        } catch (Exception $e) {
            $console->writeLine($e->getMessage(), Color::RED);
        }
    }
}
