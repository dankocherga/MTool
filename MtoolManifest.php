<?php
/**
 * Mage tool manifest
 *
 * @category   Mtool
 * @package    Manifest
 * @author     Kocherga Daniel @ oggetto web
 */
class MtoolManifest implements Zend_Tool_Framework_Manifest_ProviderManifestable
{
    /**
     * Register autoload for the tool
     */
    public function __construct()
    {
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace('Mtool_');
    }

    /**
     * Get available providers
     * @return array
     */
    public function getProviders()
    {
        return array(
            new Mtool_Providers_Mtool(),
            new Mtool_Providers_Module(),
            new Mtool_Providers_Model(),
            new Mtool_Providers_Rmodel(),
            new Mtool_Providers_Helper(),
            new Mtool_Providers_Block(),
        );
    }
}
