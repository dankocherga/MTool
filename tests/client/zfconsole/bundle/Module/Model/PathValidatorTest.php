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
 * @package   Client
 * @author    Daniel Kocherga <dan.kocherga@gmail.com>
 * @copyright 2013 Daniel Kocherga (dan.kocherga@gmail.com)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/dankocherga/MTool
 */

namespace MTool\Client\ZFConsole\Bundle\Module\Model;
use MTool\Client\ZFConsole\Bundle\Module\Exception;

/**
 * Path validator test case
 *
 * @category Tests
 * @package  Client
 * @author   Daniel Kocherga <dan@oggettoweb.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://github.com/dankocherga/MTool
 */
class PathValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Validator 
     * 
     * @var PathValidator
     */
    private $_validator;

    /**
     * Set up 
     * 
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->_validator = new PathValidator;
    }

    /**
     * Validate throws exception for incorrect path 
     *
     * @param string $path Path
     * 
     * @return void
     * @test
     * @dataProvider incorrectPathProvider
     */
    public function validateThrowsExceptionForIncorrectPath($path)
    {
        try {
            $this->_validator->validate($path);
            $this->fail('Validation exception not thrown');
        } catch (Exception $e) {
            $this->assertEquals(
                "Path `{$path}` is wrong, try something like `mycompany/mymodule`",
                $e->getMessage()
            );
        }
    }

    /**
     * Incorrect path provider 
     * 
     * @return array
     */
    public function incorrectPathProvider()
    {
        return array(
            array('foobar'),
            array('foo/'),
            array('/bar'),
            array('/')
        );
    }

    /**
     * Validate returns true for correct path 
     *
     * @param string $path Path
     * 
     * @return void
     * @test
     * @dataProvider correctPathProvider
     */
    public function validateReturnsTrueForCorrectPath($path)
    {
        $this->assertTrue($this->_validator->validate($path));
    }

    /**
     * Correct path provider 
     * 
     * @return array
     */
    public function correctPathProvider()
    {
        return array(
            array('foo/bar'),
            array('Foo/Bar'),
            array('MyFoo/MyBar')
        );
    }
}
