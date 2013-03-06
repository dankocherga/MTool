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
 * @category  Core
 * @package   Template
 * @author    Daniel Kocherga <dan.kocherga@gmail.com>
 * @copyright 2013 Daniel Kocherga (dan.kocherga@gmail.com)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/dankocherga/MTool
 */

namespace MTool\Core\Template;

/**
 * Twig-based template
 *
 * @category Core
 * @package  Template
 * @author   Daniel Kocherga <dan@oggettoweb.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://github.com/dankocherga/MTool
 */
class TwigTemplate implements ITemplate
{
    /**
     * Content 
     * 
     * @var string
     */
    private $_content;

    /**
     * Params 
     * 
     * @var mixed
     */
    private $_params;

    /**
     * Twig instance
     * 
     * @var \Twig_Environment
     */
    private $_twig;

    /**
     * Init the template
     * 
     * @return void
     */
    public function __construct()
    {
        $loader = new \Twig_Loader_String();
        $this->_twig = new \Twig_Environment($loader);
    }

    /**
     * Parse the template 
     * 
     * @return string
     */
    public function parse()
    {
        return $this->_twig->render($this->_content, $this->_params);
    }

    /**
     * Set content 
     * 
     * @param string $content Content
     *
     * @return TwigTemplate
     */
    public function setContent($content)
    {
        $this->_content = $content;
        return $this;
    }

    /**
     * Set params 
     * 
     * @param array $params Params
     *
     * @return TwigTemplate
     */
    public function setParams(array $params)
    {
        $this->_params = $params;
        return $this;
    }
}
