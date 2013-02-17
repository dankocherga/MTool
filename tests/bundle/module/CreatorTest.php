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
 * @category  Tests
 * @package   Module
 * @author    Daniel Kocherga <dan.kocherga@gmail.com>
 * @copyright 2013 Daniel Kocherga (dan.kocherga@gmail.com)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/dankocherga/MTool
 */

namespace Bundle\Module;

require_once 'bundle/module/Creator.php';
require_once 'core/IEnvironment.php';

/**
 * Module creator test case
 *
 * @category Tests
 * @package  Module
 * @author   Daniel Kocherga <dan@oggettoweb.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://github.com/dankocherga/MTool
 */
class CreatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Create adds module etc directory to local pool 
     * 
     * @return void
     * @test
     */
    public function createAddsModuleEtcDirectoryToLocalPool()
    {
        $module = $this->getMock('\Core\Module');
        $module->expects($this->any())->method('getCompany')
            ->will($this->returnValue('MyCompany'));
        $module->expects($this->any())->method('getName')
            ->will($this->returnValue('MyModule'));

        $env = $this->getMock('\Core\IEnvironment');
        $env->expects($this->any())->method('getWorkingDir')
            ->will($this->returnValue('/foo/bar'));

        $filesystem = $this->getMock('\Core\IFilesystem');
        $filesystem->expects($this->once())->method('mkdir')
            ->with($this->equalTo('/foo/bar/app/code/local/MyCompany/MyModule/etc'));

        $creator = new Creator($filesystem, $env);
        $creator->create($module);
    }
}
