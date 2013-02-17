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

namespace Core;
use org\bovigo\vfs\vfsStream;

/**
 * Filesystem test case
 *
 * @category Tests
 * @package  Core
 * @author   Daniel Kocherga <dan@oggettoweb.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://github.com/dankocherga/MTool
 */
class FilesystemTest extends \PHPUnit_Framework_TestCase
{
    /**
     * VFS root 
     * 
     * @var vfsStreamDirectory
     */
    private $_root;

    /**
     * Filesystem 
     * 
     * @var File
     */
    private $_fs;

    /**
     * Set up 
     * 
     * @return void
     */
    public function setUp()
    {
        $this->_root = vfsStream::setup('root');
        $this->_fs = new Filesystem;
    }

    /**
     * Mkdir creates directory recursive
     * 
     * @return void
     * @test
     */
    public function mkdirCreatesDirectoryRecursive()
    {
        $this->_fs->mkdir(vfsStream::url('root/foo/bar'));

        $this->assertTrue($this->_root->hasChild('foo'));
        $this->assertTrue($this->_root->getChild('foo')->hasChild('bar'));
    }

    /**
     * Mkdir creates directory with read permissions 
     * 
     * @return void
     * @test
     */
    public function mkdirCreatesDirectoryWithReadPermissions()
    {
        $this->_fs->mkdir(vfsStream::url('root/foo'));
        $dir = $this->_root->getChild('foo');

        $this->assertEquals(0755, $dir->getPermissions());
    }

    /**
     * Throws exception if directory could not be created 
     * 
     * @return void
     * @test
     * @expectedException Core\Filesystem\Exception
     */
    public function throwsExceptionIfDirectoryCouldNotBeCreated()
    {
        $file = vfsStream::newDirectory('foo', 0000)
            ->at($this->_root);
        $this->_fs->mkdir(vfsStream::url('root/foo/bar'));
    }
}
