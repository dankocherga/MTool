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
 * @package   Core
 * @author    Daniel Kocherga <dan.kocherga@gmail.com>
 * @copyright 2013 Daniel Kocherga (dan.kocherga@gmail.com)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/dankocherga/MTool
 */

namespace Core\Template;

/**
 * Storage template loader test case
 *
 * @category Tests
 * @package  Core
 * @author   Daniel Kocherga <dan@oggettoweb.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://github.com/dankocherga/MTool
 */
class StorageTemplateLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Load reads content from storage 
     * 
     * @return void
     * @test
     */
    public function loadReadsContentFromStorage()
    {
        $storage = $this->getMock('\Core\Storage\IStorage');
        $storage->expects($this->once())->method('read')
            ->with($this->equalTo('/foo/bar/template_name.tpl'))
            ->will($this->returnValue('content'));
        $loader = new StorageTemplateLoader($storage, '/foo/bar');

        $this->assertEquals('content', $loader->load('template_name'));
    }
}
