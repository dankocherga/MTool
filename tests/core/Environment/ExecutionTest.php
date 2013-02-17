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

namespace Core\Environment;

require_once 'core/Environment/Execution.php';

/**
 * Execution environment test case
 *
 * @category Tests
 * @package  Core
 * @author   Daniel Kocherga <dan@oggettoweb.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://github.com/dankocherga/MTool
 */
class ExecutionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Returns current dir as working dir 
     * 
     * @return void
     * @test
     */
    public function returnsCurrentDirAsWorkingDir()
    {
        $env = new Execution;
        $this->assertEquals(getcwd(), $env->getWorkingDir());
    }
}
