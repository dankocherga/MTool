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

namespace Core\Template;

/**
 * Template interface
 *
 * @category Core
 * @package  Template
 * @author   Daniel Kocherga <dan@oggettoweb.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://github.com/dankocherga/MTool
 */
interface ITemplate
{
    /**
     * Parse the template 
     * 
     * @return string
     */
    public function parse();

    /**
     * Set content 
     * 
     * @param string $content Content
     *
     * @return ITemplate
     */
    public function setContent($content);

    /**
     * Set params 
     * 
     * @param array $params Params
     *
     * @return ITemplate
     */
    public function setParams(array $params);
}