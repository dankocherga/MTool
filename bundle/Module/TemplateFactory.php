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
use \Core\Template\ITemplate;
use \Core\Template\ITemplateLoader;
use \Core\Module;

/**
 * Module creator template factory
 *
 * @category Bundle
 * @package  Module
 * @author   Daniel Kocherga <dan@oggettoweb.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://github.com/dankocherga/MTool
 */
class TemplateFactory
{
    /**
     * Template 
     * 
     * @var ITemplate
     */
    private $_template;

    /**
     * Template loader
     * 
     * @var ITemplateLoader
     */
    private $_loader;

    /**
     * Construct 
     * 
     * @param ITemplate       $template Template prototype
     * @param ITemplateLoader $loader   Template loader
     *
     * @return void
     */
    public function __construct(ITemplate $template, ITemplateLoader $loader)
    {
        $this->_template = $template;
        $this->_loader = $loader;
    }

    /**
     * Get module config template
     *
     * @param Module $module Module
     * 
     * @return ITemplate
     */
    public function getModuleConfig(Module $module)
    {
        $this->_template
            ->setContent($this->_loader->load('module_config'));
        $this->_template
            ->setParams(array('module' => $module));
        return $this->_template;
    }

    /**
     * Get module global config template
     * 
     * @param Module $module Module
     *
     * @return \Core\Template\ITemplate
     */
    public function getModuleGlobalConfig(Module $module)
    {
        $this->_template
            ->setContent($this->_loader->load('module_global_config'));
        $this->_template
            ->setParams(array('module' => $module));
        return $this->_template;
    }
}
