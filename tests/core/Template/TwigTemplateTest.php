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
 * Twig-based template test case
 *
 * @category Tests
 * @package  Core
 * @author   Daniel Kocherga <dan@oggettoweb.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://github.com/dankocherga/MTool
 */
class TwigTemplateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Template 
     * 
     * @var \Twig_Environment
     */
    private $_template;

    /**
     * Set up 
     * 
     * @return void
     */
    public function setUp()
    {
        $this->_template = new TwigTemplate;
    }

    /**
     * Parses parameter fields
     * 
     * @return void
     * @test
     */
    public function parsesParameterFields()
    {
        $this->_template
            ->setContent('My name is {{name}}')
            ->setParams(array('name' => 'John Doe'));

        $this->assertEquals('My name is John Doe', $this->_template->parse());
    }

    /**
     * Parses object methods
     * 
     * @return void
     * @test
     */
    public function parsesParameterObjectMethods()
    {
        $person = $this->getMock('stdClass', array('getName'));
        $person->expects($this->any())->method('getName')
            ->will($this->returnValue('John Doe'));

        $this->_template
            ->setContent('My name is {{person.getName()}}')
            ->setParams(array('person' => $person));

        $this->assertEquals('My name is John Doe', $this->_template->parse());
    }
}
