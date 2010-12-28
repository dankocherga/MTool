<?php
require_once 'Mtool/Providers/Entity.php';
require_once 'Mtool/Providers/Mtool.php';
require_once 'Mtool/Providers/Module.php';
require_once 'Mtool/Providers/Model.php';
require_once 'Mtool/Providers/Block.php';
require_once 'Mtool/Providers/Helper.php';
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
     * Get available providers
     * @return array
     */
    public function getProviders()
    {
		return array(
		    new Mtool_Providers_Mtool(),
		    new Mtool_Providers_Module(),
		    new Mtool_Providers_Model(),
		    new Mtool_Providers_Helper(),
		    new Mtool_Providers_Block(),
		);
    }
}
