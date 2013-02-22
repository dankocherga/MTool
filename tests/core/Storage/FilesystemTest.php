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

namespace Core\Storage;
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

        $this->assertEquals(
            0755, $dir->getPermissions(),
            'Actual: ' . decoct($dir->getPermissions())
        );
    }

    /**
     * Mkdir throws exception if directory cannot be created 
     * 
     * @return void
     * @test
     */
    public function mkdirThrowsExceptionIfDirectoryCannotBeCreated()
    {
        $file = vfsStream::newDirectory('foo', 0000)
            ->at($this->_root);
        try {
            $this->_fs->mkdir(vfsStream::url('root/foo/bar'));
            $this->fail('Excepected exception has not been thrown.');
        } catch (Exception $e) {
            $this->assertContains('Cannot create directory', $e->getMessage());
        }
    }

    /**
     * Write creates file 
     * 
     * @return void
     * @test
     */
    public function writeCreatesFile()
    {
        $this->_fs->write(vfsStream::url('root/file.txt'), 'foo');
        $this->assertTrue($this->_root->hasChild('file.txt'));
    }

    /**
     * Write puts content into file 
     * 
     * @return void
     * @test
     */
    public function writePutsContentIntoFile()
    {
        $this->_fs->write(vfsStream::url('root/file.txt'), 'foo');
        $this->assertEquals('foo', $this->_root->getChild('file.txt')->getContent());
    }

    /**
     * Write sets read permissions to file 
     * 
     * @return void
     * @test
     */
    public function writeSetsReadPermissionsToFile()
    {
        // This test cannot run on PHP < 5.4 since it does
        // not support chmod() on stream wrappers
        if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
            $this->_fs->write(vfsStream::url('root/file.txt'), 'foo');
            $file = $this->_root->getChild('file.txt');
            $this->assertEquals(
                0644, $file->getPermissions(),
                'Actual: ' . decoct($file->getPermissions())
            );
        }
    }
}
