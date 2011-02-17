<?php

/**
 * Abstract provider
 *
 * @category   Mtool
 * @package    Providers
 * @author     Kocherga Daniel @ oggetto web
 */
abstract class Mtool_Providers_Abstract extends Zend_Tool_Framework_Provider_Abstract
{
    /**
     * Config file name
     */
    const CONFIG_FILE_NAME = '.mtool.ini';

    /**
     * Create configs for project
     *
     * Configs will be created by asking user to answer some questions
     * and saved in the config file (~/.mtool.ini)
     *
     * @param  string $configFileName config file name, basically it's ~/.mtool.ini
     * @return null
     */
    protected function _createConfig($configFileName)
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
        $iniConfig = new Zend_Config_Ini($configFileName, null, array(
                    'skipExtends' => true,
                    'allowModifications' => true
                ));

        if (!is_null($iniConfig->projects)) {
            $projects = $iniConfig->projects->toArray();
            $maxProjectId = max(array_keys($projects));
        }

        // access to _ask()/_anwer() methods
        $author = $this->_ask("Please, enter data for the @autor stirng\n"
                        . "For example, Dan Kocherga <vsushkov@oggettoweb.com>"
        );

        $copyright = $this->_ask("Please, enter data for the copyright owner\n"
                        . "For example, Oggetto Web ltd (http://oggettoweb.com/)"
        );

        $licensePath = $this->_ask("Please, enter path to the license file\n"
                        . "For example, /home/user/project/license.lic\n"
                        . "Or press Enter to use the same as in the Magento"
        );

        $projectId = $maxProjectId + 1;

        $newProject = array($projectId => array(
                'copyright_company' => $copyright,
                'path' => Mtool_Magento::getRoot(),
                'author' => $author,
                ));

        if ($licensePath) {
            $newProject[$projectId]['license_path'] = $licensePath;
        }

        if (!isset($projects) || !is_array($projects)) {
            $projects = array();
        }

        $iniConfig->projects = array_merge($projects, $newProject);

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
    protected function _getConfig()
    {
        $configFile = Mtool_Magento::getHomeDir() . DIRECTORY_SEPARATOR . self::CONFIG_FILE_NAME;

        try {
            $iniConfig = new Zend_Config_Ini($configFile);
        } catch (Zend_Config_Exception $e) {
            $iniConfig = $this->_createConfig($configFile);
        }

        if ((is_null($iniConfig->projects))
            || !($iniConfig->projects instanceof Zend_Config)
        ) {
            // no 'projects' in the config file
            $iniConfig = $this->_createConfig($configFile);
        } else {
            $projectConfigId = null;
            // find id of current project
            foreach ($iniConfig->projects->toArray() as $key => $_projectConfig) {
                if (is_array($_projectConfig)) {
                    if ((isset($_projectConfig['path']))
                            && ($_projectConfig['path'] == Mtool_Magento::getRoot())
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
            $strings = file(Mtool_Magento::getMtoolDir() . DIRECTORY_SEPARATOR . 'var' . DIRECTORY_SEPARATOR . 'license',
                            FILE_IGNORE_NEW_LINES);
        }

        for ($i = 0; $i < count($strings); $i++) {
            if (preg_match('/^@license\s+(.*)/', $strings[$i], $matchs)) {
                $licenseShort = $matchs[1];
                unset($strings[$i]);
                continue;
            }
            if (strlen($strings[$i])) {
                $text[] = $strings[$i] . "\n";
            }
        }

        return array(rtrim(' * ' . implode(' * ', $text), "\n"), $licenseShort);
    }

    /**
     * Ask user about
     * 
     * @param string $question
     * @return string
     */
    protected function _ask($question)
    {
        $response = $this->_registry
                        ->getClient()
                        ->promptInteractiveInput($question);
        return $response->getContent();
    }

    /**
     * Pass answer to the output
     * @param string $text
     */
    protected function _answer($text)
    {
        $this->_registry->getResponse()
                ->appendContent($text);
    }

}

