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
     * Create configs for project
     * 
     * Configs will be created by asking user to answer some questions
     * and saved in the config file (~/.mtool.ini)
     *
     * @param  string $configFileName config file name, basically it's ~/.mtool.ini
     * @return null
     */
    public function _createConfig($configFileName)
    {
        // id of the last project
        $maxProjectId = 0;

        // create config file if it's not exists
        if (!file_exists($configFileName)) {
            if (!$configFileHandle = fopen($configFileName, 'a+')) {
                throw new Mtool_Codegen_Exception_Filesystem(
                        "Cannot create config file {$configFileName}.  Maybe permissions problem?"
                );
            } else {
                fclose($configFileHandle);
            }
        }

        // if file already exists, try to find other projects configs
        $iniConfig = new Zend_Config_Ini($configFileName, 
                                         null,
                                         array(
                                            'skipExtends' => true,
                                            'allowModifications' => true
                                         )
        );

        if (!is_null($iniConfig->projects)) {
            $maxProjectId = max(array_keys($iniConfig->projects->toArray()));
        }

        // access to _ask()/_anwer() methods
        $cli = new Mtool_Client_Console();

        $author = $cli->ask("Please, enter data for the @autor stirng\n"
                        . "For example, Dan Kocherga <vsushkov@oggettoweb.com>"
        );

        $copyright = $cli->ask("Please, enter data for the copyright owner\n"
                        . "For example, Oggetto Web ltd (http://oggettoweb.com/)"
        );

        $licensePath = $cli->ask("Please, enter path to the license file\n"
                        . "For example, /home/user/project/license.lic\n"
                        . "Or press Enter to use the same as in the Magento"
        );

        $projectId = $maxProjectId + 1;

        $projects = array($projectId => array(
                'copyright_company' => $copyright,
                'path' => Mtool_Magento::$staticRoot,
                'author' => $author,
                ));

        if ($licensePath) {
            $projects[$projectId]['license_path'] = $licensePath;
        }

        $iniConfig->projects = $projects;

        // save configurations to the config file
        $options = array(
            'config' => $iniConfig,
            'filename' => $configFileName,
        );
        $writer = new Zend_Config_Writer_Ini($options);
        $writer->write();

        return $iniConfig;
    }

    /**
     * Get params from config file
     *
     * @throws Mtool_Codegen_Exception_Filesystem
     * @return array
     */
    private function _getConfig()
    {
        $configFile = Mtool_Magento::$homeDir . DIRECTORY_SEPARATOR . self::CONFIG_FILE_NAME;

        try {
            $iniConfig = new Zend_Config_Ini($configFile);
        } catch (Zend_Config_Exception $e) {
            $iniConfig = $this->_createConfig($configFile);
        }

        if (is_null($iniConfig->projects)) {
            // no 'projects' in the config file
            $iniConfig = $this->_createConfig($configFile);
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
                // no config for the current project
                $iniConfig = $this->_createConfig($configFile);
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

        array_unshift($strings, '');
        array_push($strings, '');

        return array(implode(' * ', $strings), $licenseShort);
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
