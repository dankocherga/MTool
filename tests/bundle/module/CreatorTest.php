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
     * Mock module 
     * 
     * @param string $company Company
     * @param string $name    Name
     *
     * @return \Core\Module
     */
    private function _mockModule($company, $name)
    {
        $module = $this->getMock('\Core\Module');
        $module->expects($this->any())->method('getCompany')
            ->will($this->returnValue($company));
        $module->expects($this->any())->method('getName')
            ->will($this->returnValue($name));
        return $module;
    }

    /**
     * Mock environment 
     * 
     * @param string $workingDir Working dir
     *
     * @return \Core\IEnvironment
     */
    private function _mockEnvironment($workingDir)
    {
        $env = $this->getMock('\Core\IEnvironment');
        $env->expects($this->any())->method('getWorkingDir')
            ->will($this->returnValue($workingDir));
        return $env;
    }

    /**
     * Create adds module etc directory to local pool 
     * 
     * @return void
     * @test
     */
    public function createAddsModuleEtcDirectoryToLocalPool()
    {
        $module = $this->_mockModule('MyCompany', 'MyModule');
        $env = $this->_mockEnvironment('/foo/bar');

        $filesystem = $this->getMock('\Core\IFilesystem');
        $filesystem->expects($this->once())->method('mkdir')
            ->with($this->equalTo('/foo/bar/app/code/local/MyCompany/MyModule/etc'));


        $templateFactory = $this->getMock('\Bundle\Module\ITemplateFactory');
        $templateFactory->expects($this->any())->method('getModuleConfig')
            ->will($this->returnValue($this->getMock('\Core\ITemplate')));

        $creator = new Creator($filesystem, $env, $templateFactory);
        $creator->create($module);
    }

    /**
     * Create writes parsed template content to module config file
     * 
     * @return void
     * @test
     */
    public function createWritesParsedTemplateContentToModuleConfigFile()
    {
        $module = $this->_mockModule('MyCompany', 'MyModule');
        $env = $this->_mockEnvironment('/foo/bar');

        $template = $this->getMock('\Core\ITemplate');
        $template->expects($this->any())->method('parse')
            ->will($this->returnValue('content'));
        $templateFactory = $this->getMock('\Bundle\Module\ITemplateFactory');
        $templateFactory->expects($this->any())->method('getModuleConfig')
            ->will($this->returnValue($template));

        $filesystem = $this->getMock('\Core\IFilesystem');
        $filesystem->expects($this->once())->method('write')->with(
            $this->equalTo('/foo/bar/app/code/local/MyCompany/MyModule/etc/config.xml'),
            $this->equalTo('content')
        );

        $creator = new Creator($filesystem, $env, $templateFactory);
        $creator->create($module);
    }
}
