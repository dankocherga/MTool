<?php 
/**
 * Helper code generator
 *
 * @category   Mtool
 * @package    Codegen
 * @author     Kocherga Daniel @ oggetto web
 */
class Mtool_Codegen_Entity_Helper extends Mtool_Codegen_Entity_Abstract
{
    /**
     * Entity folder name
     * @var string
     */
    protected $_folderName = 'Helper';

    /**
     * Create template name
     * @var string
     */
    protected $_createTemplate = 'helper_blank';

    /**
     * Rewrite template name
     * @var string
     */
    protected $_rewriteTemplate = 'helper_rewrite';

    /**
     * Entity name
     * @var string
     */
    protected $_entityName = 'Helper';

    /**
     * Namespace in config file
     * @var string
     */
    protected $_configNamespace = 'helpers';

    /**
     * Rewrite Magento entity. Helpers have specific behavior - no alias in core configs.
     *
     * @param string $originNamespace
     * @param string $originPath
     * @param string $path
     * @param Mtool_Codegen_Entity_Module $module
     */
    public function rewrite($originNamespace, $originPath, $path, Mtool_Codegen_Entity_Module $module)
    {
        // Create own class
        $originPathSteps = $this->_ucPath(explode('_', $originPath));
        $originModuleName = ucfirst($originNamespace);
        $originClassName = implode('_', $originPathSteps);
        $params = array(
            'original_class_name' => "Mage_{$originModuleName}_{$this->_entityName}_{$originClassName}"
        );
        $className = $this->createClass($path, $this->_rewriteTemplate, $module, $params);

        // Register rewrite in config
        $config = new Mtool_Codegen_Config($module->getConfigPath('config.xml'));
        $config->set("global/{$this->_configNamespace}/{$originNamespace}/rewrite/{$originPath}", $className);
    }
}
