<?php

/**
 * Abstract code generator
 *
 * @category   Mtool
 * @package    Codegen
 * @author     Kocherga Daniel @ oggetto web
 */
abstract class Mtool_Codegen_Entity_Abstract
{
    /**
     * Config file name
     */
    const CONFIG_FILE_NAME = '.mtool.ini';

    /**
     * Entity folder name
     * @var string
     */
    protected $_folderName;
    /**
     * Create template name
     * @var string
     */
    protected $_createTemplate;
    /**
     * Rewrite template name
     * @var string
     */
    protected $_rewriteTemplate;
    /**
     * Entity name
     * @var string
     */
    protected $_entityName;
    /**
     * Namespace in config file
     * @var string
     */
    protected $_configNamespace;

    /**
     * Get params from config file
     *
     * @throws Mtool_Codegen_Exception_Filesystem
     * @return array
     */
    private function _getConfig()
    {
        $configFile = Mtool_Magento::$homeDir . DIRECTORY_SEPARATOR . self::CONFIG_FILE_NAME;
        // create config file if it's not exists
        if (!file_exists($configFile)) {
            if (!$handle = fopen($configFile, 'a+')) {
                throw new Mtool_Codegen_Exception_Filesystem(
                    "Cannot create config file {$configFile}.  Maybe permissions problem?"
                );
            }
            fclose($handle);
        }

        $iniConfig = new Zend_Config_Ini($configFile, null, array('allowModifications' => true));
        if (is_null($iniConfig->projects)) {
            // @todo ask user about configs and create config file
            // no 'projects' in the config file
            throw new Mtool_Codegen_Exception_Filesystem(
                "Cannot find config data for this project in the {$configFile}"
            );
        } else {
            $projectConfigId = null;
            // find id of current project
            foreach ($iniConfig->projects->toArray() as $key => $_projectConfig) {
                if (is_array($_projectConfig)) {
                    if ((isset($_projectConfig['path']))
                         && ($_projectConfig['path'] == Mtool_Magento::$staticRoot)
                    ) {
                        $projectConfigId = $key;
                        break;
                    }
                }
            }

            if (!is_null($projectConfigId)) {
                $configs = $iniConfig->projects->{$projectConfigId}->toArray();
            } else {
                // @todo ask user about configs and create config file
                // no config for the current project
                throw new Mtool_Codegen_Exception_Filesystem(
                    "Cannot find config data for this project in the {$configFile}"
                );
            }
        }
        if (!isset($configs['license_path'])) {
            $configs['license_path'] = '';
        }
        list($configs['license'], $configs['license_short']) = $this->_getLicenseStrings($configs['license_path']);
        return $configs;
    }

    /**
     * Retrurns License text with the asterisk before each string
     *
     * @return string
     */
    protected function _getLicenseStrings($filename = '')
    {
        if (is_readable($filename)) {
            $strings = file($filename);
        } else {
            $strings = file(Mtool_Magento::$mtoolDir . DIRECTORY_SEPARATOR . 'var' . DIRECTORY_SEPARATOR . 'license');
        }

        for ($i = 0; $i < count($strings); $i++) {
            if (preg_match('/^@license\s+(.*)/', $strings[$i], $matchs)) {
                $licenseShort = $matchs[1];
                unset($strings[$i]);
            }
        }

        return array(' * ' . implode(' * ', $strings), $licenseShort);
    }

    /**
     * Get entity config namespace
     * @return string
     */
    public function getConfigNamespace()
    {
        return $this->_configNamespace;
    }

    /**
     * Create new entity
     * 
     * @param string $namespace 
     * @param string $path 
     * @param Mtool_Codegen_Entity_Module $module
     */
    public function create($namespace, $path, Mtool_Codegen_Entity_Module $module)
    {
        // Create class file
        $this->createClass($path, $this->_createTemplate, $module);

        // Create namespace in config if not exist
        $config = new Mtool_Codegen_Config($module->getConfigPath('config.xml'));
        $configPath = "global/{$this->_configNamespace}/{$namespace}/class";
        if (!$config->get($configPath)) {
            $config->set($configPath, "{$module->getName()}_{$this->_entityName}");
        }
    }

    /**
     * Rewrite entity
     * 
     * @param string $originNamespace 
     * @param string $originPath 
     * @param string $path 
     * @param Mtool_Codegen_Entity_Module $module
     */
    public function rewrite($originNamespace, $originPath, $path, Mtool_Codegen_Entity_Module $module)
    {
        // Find origin class prefix
        $classPrefix = $this->lookupOriginEntityClass($originNamespace, $module->findThroughModules('config.xml'));

        // Create own class
        $originPathSteps = $this->_ucPath(explode('_', $originPath));
        $originClassName = implode('_', $originPathSteps);
        $params = array(
            'original_class_name' => "{$classPrefix}_{$originClassName}"
        );
        $className = $this->createClass($path, $this->_rewriteTemplate, $module, $params);

        //Register rewrite in config
        $config = new Mtool_Codegen_Config($module->getConfigPath('config.xml'));
        $config->set("global/{$this->_configNamespace}/{$originNamespace}/rewrite/{$originPath}", $className);
    }

    /**
     * Lookup the class definition among the project
     * modules
     *
     * @param string $namespace
     * @param RegexIterator $configs
     * @param string $field
     * @return string (like Mage_Catalog_Model)
     */
    public function lookupOriginEntityClass($namespace, $configs, $field = 'class')
    {
        foreach ($configs as $_config) {
            try {
                $config = new Mtool_Codegen_Config(@$_config[0]);
                if ($prefix = $config->get("global/{$this->_configNamespace}/{$namespace}/{$field}")) return $prefix;
            } catch (Exception $e) {

            }
        }

        throw new Mtool_Codegen_Exception_Entity("Module with namespace {$namespace} not found");
    }

    /**
     * Create class file
     * 
     * @param string $path in format: class_path_string 
     * @param string $template 
     * @param Mtool_Codegen_Entity_Module $module
     * @param array $params 
     * @return resulting class name
     */
    public function createClass($path, $template, $module, $params = array())
    {
        $pathSteps = $this->_ucPath(explode('_', $path));
        $className = implode('_', $pathSteps);
        $classFilename = array_pop($pathSteps) . '.php';

        // Create class dir under module
        $classDir = Mtool_Codegen_Filesystem::slash($module->getDir()) . $this->_folderName .
                DIRECTORY_SEPARATOR .
                implode(DIRECTORY_SEPARATOR, $pathSteps);
        Mtool_Codegen_Filesystem::mkdir($classDir);

        // Move class template file
        $classTemplate = new Mtool_Codegen_Template($template);
        $resultingClassName = "{$module->getName()}_{$this->_entityName}_{$className}";
        $defaultParams = array(
            'company_name' => $module->getCompanyName(),
            'module_name' => $module->getModuleName(),
            'class_name' => $resultingClassName,
            'year' => date('Y'),
            'license' => $this->_getLicenseStrings(),
        );

        $iniParams = $this->_getConfig();

        $classTemplate->setParams(array_merge($defaultParams, $params, $iniParams));
        $classTemplate
                ->move($classDir, $classFilename);

        return $resultingClassName;
    }

    /**
     * Uppercase path steps
     * 
     * @param array $steps 
     * @return array
     */
    protected function _ucPath($steps)
    {
        $result = array();
        foreach ($steps as $_step) {
            $result[] = ucfirst($_step);
        }
        return $result;
    }

}
