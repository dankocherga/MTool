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
 * @category  Bundle
 * @package   Module
 * @author    Daniel Kocherga <dan.kocherga@gmail.com>
 * @copyright 2013 Daniel Kocherga (dan.kocherga@gmail.com)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/dankocherga/MTool
 */

namespace Bundle\Module;

/**
 * Module creator
 *
 * @category Bundle
 * @package  Module
 * @author   Daniel Kocherga <dan@oggettoweb.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://github.com/dankocherga/MTool
 */
class Creator
{
    /**
     * Filesystem 
     * 
     * @var \Core\IFilesystem
     */
    private $_fs;

    /**
     * Environment
     *
     * @var \Core\IEnvironment
     */
    private $_env;

    /**
     * Init the creator 
     * 
     * @param \Core\IFilesystem  $filesystem Filesystem
     * @param \Core\IEnvironment $env        Environment
     *
     * @return void
     */
    public function __construct(\Core\IFilesystem $filesystem, \Core\IEnvironment $env)
    {
        $this->_fs = $filesystem;
        $this->_env = $env;
    }

    /**
     * Create module 
     * 
     * @param \Core\Module $module Module
     *
     * @return void
     */
    public function create(\Core\Module $module)
    {
        $this->_fs->mkdir(
            "{$this->_env->getWorkingDir()}/app/code/local/{$module->getCompany()}/{$module->getName()}/etc"
        );
    }
}
