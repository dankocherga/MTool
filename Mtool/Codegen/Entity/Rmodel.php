<?php 
/**
 * Resource model code generator
 *
 * @category   Mtool
 * @package    Codegen
 * @author     Kocherga Daniel @ oggetto web
 */
class Mtool_Codegen_Entity_Rmodel extends Mtool_Codegen_Entity_Model
{
    /**
     * Rewrite resource model
     *
     * @param string $originNamespace
     * @param string $originPath
     * @param string $path
     * @param Mtool_Codegen_Entity_Module $module
     */
    public function rewrite($originNamespace, $originPath, $path, Mtool_Codegen_Entity_Module $module)
    {
        // Find origin class prefix
        $resourceModel = $this->lookupOriginEntityClass($originNamespace, $module->findThroughModules('config.xml'), 'resourceModel');
        $classPrefix = $this->lookupOriginEntityClass($resourceModel, $module->findThroughModules('config.xml'));

        // Create own class
        $originPathSteps = $this->_ucPath(explode('_', $originPath));
        $originClassName = implode('_', $originPathSteps);
        $params = array(
            'original_class_name' => "{$classPrefix}_{$originClassName}"
        );
        $className = $this->createClass($path, $this->_rewriteTemplate, $module, $params);

        //Register rewrite in config
        $config = new Mtool_Codegen_Config($module->getConfigPath('config.xml'));
        $config->set("global/{$this->_configNamespace}/{$resourceModel}/rewrite/{$originPath}", $className);
    }
}
